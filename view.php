
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
and oemnumbers.mfrId=$make and oemnumbers.articleNumber='$refome' order by familia, articlecriteria.criteriaDescription");

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
$result = $conexion->query("SELECT DISTINCT articles.mfrName  as namei , genericarticlesgroups.assemblyGroup as groupi,genericarticlesgroups.designation as designation,articlecriteria.criteriaDescription as descr, 
REPLACE(articlecriteria.rawValue,',','.') as rawValue, IFNULL(articlecriteria.criteriaUnitDescription,'') as unit, 
IFNULL(articlecriteria.formattedValue,'') as formattedValue FROM `articlecriteria` 
inner join oemnumbers on oemnumbers.legacyArticleId=articlecriteria.legacyArticleId 
inner join genericarticles on genericarticles.legacyArticleId =oemnumbers.legacyArticleId 
inner join genericarticlesgroups on genericarticlesgroups.genericArticleId=genericarticles.genericArticleId 
inner join euro2td on euro2td.code=genericarticles.genericArticleId 
inner join articles on articles.legacyArticleId=articlecriteria.legacyArticleId
where articlecriteria.lang='$langV' and genericarticlesgroups.lang='$langV'
and oemnumbers.mfrId=$make and oemnumbers.articleNumber='$refome' order by namei, articlecriteria.criteriaDescription");

if ($result->num_rows > 0) {
  $html .="<div class='info'>";
    $html .="<h2>INFO</h2>";
    $html .="<table>";
    while ($row = $result->fetch_assoc()) {                
        $html .= "<tr><td>". $row['namei'] . " </td><td> ".$row['groupi'] . " </td><td> ". $row['designation'] .  " </td><td>  ". $row['descr'] . "</td><td> " ; 
        $html .=  $row['rawValue'] . " </td><td>  ". $row['formattedValue'] . " </td><td>  ". $row['unit'] ."</td> </tr> " ; 
    }
    $html .= "</table></div>";
} else{

  $html .="<div class='info'>";
    $html .= $lang['Oem-not-found'];
    
}

$Query = "select DISTINCT vehicledetails.manuName as manu, vehicledetails.modelName as model,
   yearOfConstrFrom as yearfrom, yearOfConstrTo as yearto, typeName as type,
   powerHPFrom as powerHP, powerKwFrom as powerKW
   from vehicledetails 
   INNER JOIN articlesvehicletrees on articlesvehicletrees.linkingTargetId = vehicledetails.carId 
   INNER join articles on articles.legacyArticleId=articlesvehicletrees.articleId 
   inner join articlecrosses on articlecrosses.articleNumber=articles.articleNumber and articlecrosses.dataSupplierId= articles.dataSupplierId
   where articlecrosses.oemNumber = '$refome' order by manu, model ";




   $conexion->query("SET CHARACTER SET utf8");
   $conexion->query("SET NAMES utf8");


   $html .="<div class='info'><h2>Application</h2>";
   
//Query execution
   $ExecQuery = MySQLi_query($conexion, $Query);
//Creating unordered list to display result.
$html .="<table style='background-color:#444445;width:900px;'>";
   //Fetching result from database.
   while ($Result = MySQLi_fetch_array($ExecQuery)) {
    $html .= "  <tr class='search'> "; 
    
    $html .= "<td style='width:120px'><img src='../images/images_carbrands/".$Result['manu'].".png'   ></td>";
   
    $html .= " <td style='width:440px'> "; $html .= $Result['manu']."-". $Result['model']."-".$Result['yearfrom']."-".$Result['yearto']."-".$Result['type']."(".$Result['powerKW']." Kw / ".$Result['powerHP']." Hp)</td></tr>";
   
  
   
}
$html .= "</table>";






////////////////////////////////////////////////////////////////
/*
$html .="<div></br>";
$html .="<button type='button' onclick='referencesEuro()' class='btn btn-primary btn-lg'>".$refome."References Euro4x4</button>&nbsp;";
$html .="<button type='button' onclick='Clear()' class='btn btn-primary btn-lg'>".$make."Clear</button>";
$html .="</div>";
$html .="<div id='refEuro'></div> ";
*/



///////////////////////////////////////////////////////////////////

echo $html;



?>




