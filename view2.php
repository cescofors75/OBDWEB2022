
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
$html = '';

$conexion = new mysqli('localhost', 'root','' , 'td2q2019');

$refome= $_POST['refome'];
$make= $_POST['make'];
$langV =$lang['grupos-lang'] ;

$conexion->query("SET CHARACTER SET utf8");
$conexion->query("SET NAMES utf8");
//$result = $conexion->query("SELECT manuName,modelName,typeName,yearOfConstrFrom,yearOfConstrTo FROM vehicledetails WHERE carId=$carid  LIMIT 1");
$result = $conexion->query("SELECT DISTINCT euro2td.refEuro  as familia  FROM `articlecriteria` 
inner join oemnumbers on oemnumbers.legacyArticleId=articlecriteria.legacyArticleId 
inner join genericarticles on genericarticles.legacyArticleId =oemnumbers.legacyArticleId 
inner join genericarticlesgroups on genericarticlesgroups.genericArticleId=genericarticles.genericArticleId 
inner join euro2td on euro2td.code=genericarticles.genericArticleId 

where articlecriteria.lang='$langV' and genericarticlesgroups.lang='$langV'
and oemnumbers.mfrId=$make and oemnumbers.articleNumber = '$refome' order by familia, articlecriteria.criteriaDescription");

if ($result->num_rows > 0) {
  $html .="<div class='info'>";
    $html .="<h2>FAMILY</h2>";
    $html .="<table>";
    while ($row = $result->fetch_assoc()) {                
        $html .= "<tr><td>". $row['familia'] . "</td> </tr> " ; 
    }
    $html .= "</table></div>";
} 













////////////////////////////////////////////////
$result = $conexion->query("SELECT DISTINCT articles.mfrName as name, articles.articleNumber  as number,articles.mfrName  as namei , genericarticlesgroups.assemblyGroup as groupi,genericarticlesgroups.designation as designation,articlecriteria.criteriaDescription as descr, 
REPLACE(articlecriteria.rawValue,',','.') as rawValue, IFNULL(articlecriteria.criteriaUnitDescription,'') as unit, 
IFNULL(articlecriteria.formattedValue,'') as formattedValue  ,genericarticlesgroups.genericArticleId as generic FROM `articlecriteria`
inner join oemnumbers on oemnumbers.legacyArticleId=articlecriteria.legacyArticleId 
inner join genericarticles on genericarticles.legacyArticleId =oemnumbers.legacyArticleId 
inner join genericarticlesgroups on genericarticlesgroups.genericArticleId=genericarticles.genericArticleId 
inner join euro2td on euro2td.code=genericarticles.genericArticleId 
inner join articles on articles.legacyArticleId=articlecriteria.legacyArticleId
inner join eurocrossrefdouble on oemnumbers.articleNumber = eurocrossrefdouble.REF_FRNS 
inner join manufacturers on manufacturers.manuId=oemnumbers.mfrId
where articlecriteria.lang='$langV' and genericarticlesgroups.lang='$langV'
and oemnumbers.mfrId=$make and eurocrossrefdouble.REF_EURO = '$refome'  and manufacturers.manuName= eurocrossrefdouble.MARQUE order by namei, articlecriteria.criteriaDescription");

if ($result->num_rows > 0) {

  


  $html .="<div class='info'>";
    $html .="<h2>INFO</h2>";
    $html .="<table style='background-color:#444445;width:100%;'>";
    $html.="<tr><th>Photo</th><th>Supplier</th><th>GROUP</th><th>DESIGNATION</th><th>DESCRIPTION</th><th>RAW VALUE</th><th>UNIT</th><th>FORMATTED VALUE</th><th>Ref supplier</th><th>Generic ID</th> </tr>";
    while ($row = $result->fetch_assoc()) {  
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
      $html .= " <tr><td class='p35'><a  href='../images/imgSorted/" ; $html .= $supli; $html .= "/"; $html .= $num; $html .= "/"; $html .= $num; $html .= ".jpg' >";
               
      
      
      $html .= '<img class="shadow" src="../images/imgSorted/' ; $html .= $supli; $html .= "/";
      $html .= $num; $html .= "/"; $html .= $num; $html .='.jpg"  width="100" /></a></td>';
     
   
      
 
      
      



        $html .= "<td>". $row['namei'] . " </td><td> ".$row['groupi'] . " </td><td> ". $row['designation'] .  " </td><td>  ". $row['descr'] . "</td><td> " ; 
        $html .=  $row['rawValue'] . " </td><td>  ". $row['unit'] . " </td><td>  ". $row['formattedValue'] ." </td><td>  ". $row['number'] ." </td><td>  ". $row['generic'] ."</td> </tr> " ; 
    }
    $html .= "</table></div>";
} else{

  $html .="<div class='info'>";
    $html .= $lang['Oem-not-found'];
    
}

echo $html;



?>




