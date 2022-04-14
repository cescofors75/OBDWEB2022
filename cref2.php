

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>OBD2SOLUTION<</title>


<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<link rel="stylesheet" href="./css/estilos_wp.css">

<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</head>


<body>

<?php 
session_start();
if(isset($_GET['la'])){
$_SESSION['la'] = $_GET['la'];
header('Location:'.$_SERVER['PHP_SELF']);
exit();
}
if(isset($_SESSION['la']))
{
switch($_SESSION['la']){
case "eng":
require('lang/eng.php'); 
break;
case "fre":
require('lang/fre.php'); 
break;
case "ger":
require('lang/ger.php'); 
break; 
case "esp":
require('lang/esp.php'); 
break; 
default: 
require('lang/esp.php'); 
}

}else{
require('lang/esp.php');
}
?>



<div class='container2'>






<?php

  $refEuro = $_GET['grupo'];
  $carid=$_GET['carid'];
  $name=$_GET['name'];

  set_time_limit(300);



  
    function getPdo(){

        try {

            $db_name     = 'td2q2019';
            $db_user     = 'root';
            $db_password = '';
            $db_host     = 'localhost';

            $pdo = new PDO('mysql:host=' . $db_host . '; dbname=' . $db_name, $db_user, $db_password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $pdo;

           } catch (PDOException $e) {
               echo $e->getMessage();
           }
    }






    try {
             $pdo = getPdo();
       
            $langV =$lang['grupos-lang'] ;

             $sql="Select DISTINCT  ambrand.brandName as name , genericarticlesgroups.designation as descri ,articles.articleNumber  as number, articles.legacyArticleId as pivot , articles.dataSupplierId as su_id 
             From articlesvehicletrees
             INNER JOIN articles
             ON articlesvehicletrees.articleId = articles.legacyArticleId
            
             INNER JOIN ambrand
             on ambrand.brandId=articles.dataSupplierId
             

              INNER JOIN genericarticlesgroups
              on genericarticlesgroups.genericArticleId=articlesvehicletrees.genericArticleId

             
              INNER JOIN euro2td
              on euro2td.code=articlesvehicletrees.genericArticleId
              
              
               


             where genericarticlesgroups.lang='$langV' and articlesvehicletrees.linkingTargetType='P' and articlesvehicletrees.linkingTargetId=$carid and euro2td.refEuro='$refEuro'
             order by articles.genericArticleDescription, ambrand.brandName";// 



             $stmt = $pdo->prepare($sql);//
             $stmt->execute(); 

             $data = [];

            
             
             echo "<div  class='container2'> <table>";//style='color:#0000ff;background-color:white'
             echo "<div class='b' >";
             echo "<h2><b>CROSS-REFERENCES  </b></h2></div>";
             while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              /////////////////////////////////////////           References OEM
              $pdo3 = getPdo();
              $su_id= $row['su_id'];
              $num=$row['number'];
              $sql3="SELECT DISTINCT manufacturers.manuName as name, articlecrosses.oemNumber  as oem FROM `articlecrosses` INNER JOIN manufacturers ON articlecrosses.mfrId=manufacturers.manuId where dataSupplierId=$su_id and articleNumber='$num' LIMIT 10";
              $stmt3 = $pdo3->prepare($sql3);
              
              $stmt3->execute(); 
              $criteria2="";
              while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)) {
                $criteria2 .= $row3['name']." : ".$row3['oem']."<br>";
              }
               


              ///////////////////////////////////  foto
              $pdo2 = getPdo();
              $pivot= $row['pivot'];
              $langV= $lang['grupos-lang'] ;

              $sql2="SELECT DISTINCT criteriaDescription as description , formattedValue as value FROM `articlecriteria` where articlecriteria.lang = '$langV' and legacyArticleId=$pivot  and formattedValue is not null "; //order by description
              $stmt2 = $pdo2->prepare($sql2);
              $stmt2->execute(); 
              $criteria="";
              while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                $criteria .= $row2['description']." = ".$row2['value']."<br>";
              }
                //echo "<tr><td class='p5'><img class='circle' src='../images/images_supplier_logos/".$row['logo'].".png' ";
                echo "<tr><td class='p5'><img class='circle' src='../images/images_supplier_logos/".$row['su_id'].".png' ";

                
                ?>
                onerror="this.onerror=null;this.src='./images/no_image.jpg';" /></a></td>
                <?php


                echo "</td><td class='criteria'>". $row['descri']."</td><td class='criteria'>". $row['name'] . "</td><td class='barcode' >". $row['number'] ."</td><td class='criteria' >". $criteria ."</td><td class='criteria' >". $criteria2 ."</td>";
                $num=str_replace(" ", "", $row['number']);
                $num=str_replace("-", "", $num);
                $num=str_replace(".", "", $num);
                $num=str_replace("/", "", $num);
                $supli=str_replace(" ", "", $row['name']);
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
                ///////////////////////
               
                echo " <td class='p35'><a  href='../images/imgSorted/" ; echo $supli; echo "/"; echo $num; echo "/"; echo $num; echo ".jpg' >";
               
               
                /*
                echo "<img  src= 'http://images.localhost/imgSorted/"; echo $supli; echo "/";
                echo $num; echo "/"; echo $num; echo ".jpg' width='120'   /></td>";*/
                
                echo '<img class="shadow" src="../images/imgSorted/' ; echo $supli; echo "/";
                echo $num; echo "/"; echo $num; echo '.jpg"  width="150"';  
                ?>
                onerror="this.onerror=null;this.src='./images/no_image.jpg';" /></a></td>
                <?php
                
                
                
                
                //////////////////// links
             /* $pdo4 = getPdo();
              $su_id= $row['su_id'];
              $num=$row['number'];
              $sql4="SELECT DISTINCT articlelinks.url as link  FROM `articlelinks` INNER JOIN articles ON articles.legacyArticleId=articlelinks.legacyArticleId where articles.dataSupplierId=$su_id and articles.articleNumber='$num'";
              $stmt4 = $pdo4->prepare($sql4);
              
              $stmt4->execute(); 
              //echo "<tr>";
              while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {

                echo "<td><iframe src='".$row4['link']."' height='120' width='150'></iframe></td>";
               
              }*/
              
             
             
              echo "</tr>";
             } 

             echo "</table></div>";    
        } catch (Exception $e) {
            echo $e->getMessage();

           
        }

    


    ?>
</div>

</body>



</html>
