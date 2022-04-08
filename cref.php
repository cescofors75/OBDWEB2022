

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


<div id="langSelect">
<a href="index2.php?la=esp"><img class='circle' src="flags/esp.png" alt="<?=$lang['lang-esp'];?>" title="<?=$lang['lang-esp'];?>" /></a>  
<a href="index2.php?la=eng"><img class='circle' src="flags/eng.png" alt="<?=$lang['lang-eng'];?>" title="<?=$lang['lang-eng'];?>" /></a>
<a href="index2.php?la=fre"><img class='circle' src="flags/fra.png" alt="<?=$lang['lang-fre'];?>" title="<?=$lang['lang-fre'];?>" /></a>
<a href="index2.php?la=ger"><img class='circle' src="flags/ger.png" alt="<?=$lang['lang-ger'];?>" title="<?=$lang['lang-ger'];?>" /></a>
</div>
<div class="loader-wrapper">
      <span class="loader"><span class="loader-inner"></span></span>
    </div>
    <script>
        $(window).on("load",function(){
          $(".loader-wrapper").fadeOut("slow");
        });
    </script>
<div class="honeycomb">
  
  <div class="ibws-fix">
    <div class="hexagon">
      <div class="hexagontent">
        <h1>OBD2</h1>
      </div>
    </div>
    <div class="hexagon">
      <div class="hexagontent"><h1>Solution</h1></div>
    </div>
    <div class="hexanone">
      <div class="hexagontent"></div>
    </div>
    
    <div class="hexagon">
      <div class="hexagontent"><h1></H1></div>
    </div>
    <div class="hexagon">
      <div class="hexagontent"><h1>ALL</H1></div>
    </div>
    <div class="hexanone">
      <div class="hexagontent"></div>
    </div>
    <div class="hexagon">
      <div class="hexagontent"><h1>PARTS</H1></div>
    </div>
  </div>
</div>
<br><br><br><br>
<br><br><br><br>
<div class='container2'>
<?php


$html = '';

$conexion = new mysqli('localhost', 'root','' , 'td2q2019');

$carid = $_GET['carid'];

$conexion->query("SET CHARACTER SET utf8");
$conexion->query("SET NAMES utf8");
$result = $conexion->query("SELECT manuName,modelName,typeName,yearOfConstrFrom,yearOfConstrTo, manuId FROM vehicledetails WHERE carId=$carid  LIMIT 1");


if ($result->num_rows > 0) {
  $html .="<div class='info'>";
    $html .="<h2>INFO</h2>";
    
    while ($row = $result->fetch_assoc()) { 
        $html .=  "<img src='../images/makes_logos/".$row['manuId'].".png' width='50' height='50'>&nbsp;";                 
        $html .=  $row['manuName'] . " / ". $row['modelName'] .  " / ". $row['typeName'] . "*" ; 
        $html .=  $row['yearOfConstrFrom'] . " / ". $row['yearOfConstrTo'] . "<br>" ; 
    }
    $html .= "</div>";
} 

////////////////////////////////////////////////////////////////
$html .="<div></br>";
$html .="<button type='button' onclick='referencesEuro()' class='btn btn-primary btn-lg'>References Euro4x4</button>&nbsp;";
$html .="<button type='button' onclick='Clear()' class='btn btn-primary btn-lg'>Clear</button>";
$html .="</div>";
$html .="<div id='refEuro'></div> ";




///////////////////////////////////////////////////////////////////

echo $html;



?>

<br><br>

<?php
 /* 
  $name=$_GET['name'];

  
  echo "<div class='retro'>". $name."</div>";
 
  


  $html = '';
 $conexion = new mysqli('localhost', 'root','' , 'td2q2019');

 $id_group = $_GET['grupo'];
$carid = $_GET['carid'];
$conexion->query("SET CHARACTER SET utf8");
$conexion->query("SET NAMES utf8");

$result = $conexion->query("Select DISTINCT   GROUP_CONCAT(DISTINCT eurocrossref.REF_EURO  ,' : ', europroducts.prixeuroht ,'€ ') as dades
                                             
From articlesvehicletrees
INNER JOIN articles
ON articlesvehicletrees.articleId = articles.legacyArticleId
INNER JOIN articlecrosses
ON articlecrosses.articleNumber=articles.articleNumber and articlecrosses.dataSupplierId= articles.dataSupplierId
INNER JOIN ambrand
on ambrand.brandId=articles.dataSupplierId
INNER JOIN articlecriteria
on articlecriteria.legacyArticleId=articles.legacyArticleId
INNER JOIN manufacturers
on manufacturers.manuId=articlecrosses.mfrId
INNER JOIN eurocrossref
on  eurocrossref.REF_FRN=  articlecrosses.oemNumber 
INNER JOIN europroducts
on europroducts.reference= eurocrossref.REF_EURO 
where articlesvehicletrees.linkingTargetId=$carid and articlesvehicletrees.assemblyGroupNodeId=$id_group 
order by dades"); // and articlesvehicletrees.linkingTargetType='P'

if ($result->num_rows > 0) {
  $html .="<div align='left' style='color:white;background-color:#0A1F47' >";
  $html .="<h2><b>REFERENCES EURO4X4PARTS </b></h2></div>";   
    
    while ($row = $result->fetch_assoc()) {  
             
        $html .= "<div style='color:#0A1F47;background-color:white'>". $row['dades'] .  "</div>" ; 
        
    }
   
} 
$html .="</div>";
echo $html;


  
  
*/
  ?>
 







<?php

  $id_group = $_GET['grupo'];
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

             where genericarticlesgroups.lang='$langV' and articlesvehicletrees.linkingTargetType='P' and articlesvehicletrees.linkingTargetId=$carid and articlesvehicletrees.assemblyGroupNodeId=$id_group 
             order by articles.genericArticleDescription, ambrand.brandName";// 



             $stmt = $pdo->prepare($sql);
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

              $sql2="SELECT criteriaDescription as description , rawValue as value FROM `articlecriteria` where articlecriteria.lang = '$langV' and legacyArticleId=$pivot and assemblyGroupNodeId=$id_group order by description";
              $stmt2 = $pdo2->prepare($sql2);
              $stmt2->execute(); 
              $criteria="";
              while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                $criteria .= $row2['description']." = ".$row2['value']."<br>";
              }
                //echo "<tr><td class='p5'><img class='circle' src='../images/images_supplier_logos/".$row['logo'].".png' ";
                echo "<tr><td class='p5'><img class='circle' src='../images/images_supplier_logos/".$row['su_id'].".png' ";

                
                ?>
                onerror="this.onerror=null;this.src='no_image.jpg';" /></a></td>
                <?php


                echo "</td><td>". $row['descri']."</td><td>". $row['name'] . "</td><td class='barcode' >". $row['number'] ."</td><td class='criteria' >". $criteria ."</td><td class='criteria' >". $criteria2 ."</td>";
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
                onerror="this.onerror=null;this.src='no_image.jpg';" /></a></td>
                <?php
                
                
                
                
                //////////////////// links
              $pdo4 = getPdo();
              $su_id= $row['su_id'];
              $num=$row['number'];
              $sql4="SELECT DISTINCT articlelinks.url as link  FROM `articlelinks` INNER JOIN articles ON articles.legacyArticleId=articlelinks.legacyArticleId where articles.dataSupplierId=$su_id and articles.articleNumber='$num'";
              $stmt4 = $pdo4->prepare($sql4);
              
              $stmt4->execute(); 
              //echo "<tr>";
              while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {

                echo "<td><iframe src='".$row4['link']."' height='120' width='150'></iframe></td>";
               
              }
              
              //echo "<td>"; echo $row['REF_EURO']; echo "</td>";
              //echo "<td>"; echo $row['descrieuro']; echo "</td>";
              //echo "<td style='padding: 15px;'>"; echo $row['prix']; echo "€ </td>";
             
              echo "</tr>";
             } 

             echo "</table></div>";    
        } catch (Exception $e) {
            echo $e->getMessage();

           
        }

    


    ?>
</div>

</body>

<script>
function Clear() {
      document.getElementById("refEuro").innerHTML ="";
  
    }


function referencesEuro(){
/*
let params = new URLSearchParams(location.search);
let carid = params.get('carid')*/
<?php  $carid = $_GET['carid'];?>
<?php  $grupo= $_GET['grupo'];?>
let url = "./api/mysql_jsonESP_EURO.php?carid="+<?php echo $carid; ?>+"&grupo="+<?php echo $grupo; ?>+""
$('#refEuro').html("<br/> <div class='loading'><img src='images/loader.gif' /><br/> <br/>"+"<?php echo $lang['grupos-loading'];?>"+"</div>").show();

      fetch(url)
          .then( response => response.json() )
          .then( data => mostrarData(data) )
          .catch( error => console.log(error) )

      const mostrarData = (data) => {
          console.log(data)
          if (data[0].dades !== null){
          let body = "<table>"
          for (var i = 0; i < data.length; i++) {   
             
             body+="<tr><td  class='p5'>"+data[0].dades+"</td></tr>"  
          
            }
          body+="</table>"
          document.getElementById('refEuro').innerHTML = body
          }else{
            $('#refEuro').html("<div class='error'>"+"<?php echo $lang['grupos-notparts']?>"+"</div>")

          }
          
          //console.log(body)
      }

   
}


</script>
</html>
