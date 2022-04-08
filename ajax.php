<html>
<head>
<title>...</title>

<style type="text/css">

tr.search:hover { background:#545557; }
td a { 
    display: block; 
    padding: 16px; 
   
}

</style>
</head>
<body>
<div class='container'>
<?php




//Including Database configuration file.
include "db.php";
//Getting value of "search" variable from "script.js".
if (isset($_POST['search'])) {
//Search box value assigning to $Name variable.
   $Name = $_POST['search'];
//Search query.
   $Query = "SELECT DISTINCT articles.genericArticleDescription as descripcion,ambrand.brandId as brandid, ambrand.brandName as supli, articles.articleNumber as Num , oemNumber as oem  FROM articlecrosses
   INNER JOIN ambrand
   ON articlecrosses.dataSupplierId = ambrand.brandId
   INNER JOIN articles
   ON articles.articleNumber=articlecrosses.articleNumber and articles.dataSupplierId=articlecrosses.dataSupplierId
   WHERE  oemNumber LIKE '$Name%'   order by supli LIMIT 10";

//Query execution
$con->query("SET CHARACTER SET utf8");
$con->query("SET NAMES utf8");

   $ExecQuery = MySQLi_query($con, $Query);
//Creating unordered list to display result.
   echo "<table style='background-color:#444445; width:700px;'>";
   //Fetching result from database.
  
   while ($Result = MySQLi_fetch_array($ExecQuery)) {
  echo  "  <tr class='search'> ";
  echo " <td style='width:100px'><a href='#'><img src='../images/images_supplier_logos/".$Result['brandid'].".png' width='80'  ></a></td>";
   
       echo " <td style='width:100px'> <a href='#'>"; echo $Result['supli'];echo "</a></td><td style='width:100px'><a href='#'>";echo $Result['Num']; echo "</a> </td><td style='width:100px'><a href='#'> ";echo $Result['descripcion']; echo "</a> </td><td style='width:200px'><a href='#'> OEM: "; echo $Result['oem']; echo"</a></td>"  ; 
       $num=str_replace(" ", "", $Result['Num']);
       $num=str_replace("-", "", $num);
       $num=str_replace(".", "", $num);
       $num=str_replace("/", "", $num);
       $supli=str_replace(" ", "", $Result['supli']);
       $supli=str_replace("-", "", $supli);
       $supli=str_replace(".", "", $supli);
       $supli=str_replace("&", "", $supli);
       $supli=str_replace("+", "", $supli);
       $supli=str_replace("Ü", "", $supli);
       $supli=str_replace("Ä", "", $supli);
       $supli=str_replace("Ö", "", $supli);
       $supli=str_replace("Ò", "", $supli);
       $supli=str_replace("'", "", $supli);
       $supli=str_replace("Ş", "", $supli);
       $supli=str_replace("!", "", $supli);
       $supli=str_replace("®", "", $supli);




       echo " <td style='width:100px'><a href='#'><img src='http:../images/imgSorted/"; echo $supli; echo "/";
       echo $num; echo "/"; echo $num; echo ".jpg' width='80' ";
       
       
      ?>
       onerror="this.onerror=null;this.src='./images/no_image.jpg';" ></a></td></tr>
       <?php
       
     
      
}
echo "</table>";


}

?>



<?php
//Including Database configuration file.
include "db.php";
//Getting value of "search" variable from "script.js".
if (isset($_POST['search'])) {
//Search box value assigning to $Name variable.
   $Name = $_POST['search'];
//Search query.
   $Query = "SELECT DISTINCT articles.genericArticleDescription as descripcion,ambrand.brandName as supli, manufacturers.manuName as manu, articlecrosses.articleNumber as Num , articlecrosses.oemNumber as oem  FROM articlecrosses
   INNER JOIN manufacturers
   ON articlecrosses.mfrId = manufacturers.manuId
   INNER JOIN ambrand
   ON articlecrosses.dataSupplierId = brandId
   INNER JOIN articles
   ON articles.articleNumber=articlecrosses.articleNumber and articles.dataSupplierId=articlecrosses.dataSupplierId
   
     WHERE  articlecrosses.articleNumber LIKE '$Name%' order by manu  LIMIT 10";

   $con->query("SET CHARACTER SET utf8");
   $con->query("SET NAMES utf8");

   
//Query execution

   $ExecQuery = MySQLi_query($con, $Query);
//Creating unordered list to display result.
  echo "<table style='background-color:#444445;width:700px;'>";
   //Fetching result from database.
   while ($Result = MySQLi_fetch_array($ExecQuery)) {
  echo  "  <tr class='search'> "; 
  echo "<td style='width:120px'><img src='../images/images_carbrands/".$Result['manu'].".png'   ></td><td style='width:40px;color:white'>*</td>";
  echo " <td style='width:320px'> "; echo $Result['manu']; echo " REF OEM: ";echo $Result['oem'];  echo " </td> <td style='width:200px'>  "; echo $Result['descripcion']; echo "  </td> <td style='width:220px'> ";echo $Result['supli']; echo " : ";echo $Result['Num']; echo"</td>"  ; 
   

   }
   echo "</table>";

}
?>



<?php
//Including Database configuration file.
include "db.php";
//Getting value of "search" variable from "script.js".
if (isset($_POST['search'])) {
//Search box value assigning to $Name variable.
   $Name = $_POST['search'];
//Search query.

   $Query = "select DISTINCT vehicledetails.manuName as manu, vehicledetails.modelName as model from vehicledetails 
   INNER JOIN articlesvehicletrees on articlesvehicletrees.linkingTargetId = vehicledetails.carId 
   INNER join articles on articles.legacyArticleId=articlesvehicletrees.articleId 
   inner join articlecrosses on articlecrosses.articleNumber=articles.articleNumber and articlecrosses.dataSupplierId= articles.dataSupplierId
   where articlecrosses.oemNumber = '$Name' order by manu, model ";




   $con->query("SET CHARACTER SET utf8");
   $con->query("SET NAMES utf8");


   
//Query execution
   $ExecQuery = MySQLi_query($con, $Query);
//Creating unordered list to display result.
echo "<table style='background-color:#444445;width:700px;'>";
   //Fetching result from database.
   while ($Result = MySQLi_fetch_array($ExecQuery)) {
      echo  "  <tr class='search'> "; 
    
  echo "<td style='width:120px'><img src='../images/images_carbrands/".$Result['manu'].".png'   ></td><td style='width:140px;color:white'> - </td>";
   
       echo " <td style='width:440px'> "; echo $Result['manu']; echo " -  ";echo $Result['model']; ; echo"</td></tr>"  ; 
  
   
}
echo "</table>";

}
?>










</div>
</body>















