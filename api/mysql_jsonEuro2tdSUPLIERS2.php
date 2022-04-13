

<?php
 $legacy = $_GET['legacy'];
 $lang  = $_GET['lang'];

// WHERE article_links.linkageid='15587' and article_links.linkagetypeid='2' AND prd.assemblygroupdescription = 'Mixing' AND prd.normalizeddescription = 'Sensor' AND prd.description = 'Air flow meter' group by article_links.productid order by prd.description asc");


$dsn = 'mysql:host=localhost; dbname=td2q2019; charset=UTF8';
$pdo=new PDO($dsn,"root","",array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
  ));


//SELECT DISTINCT criteriaDescription, formattedValue,criteriaUnitDescription FROM `articlecriteria` where legacyArticleId=83980546 and lang='es';



$statement=$pdo->prepare("SELECT DISTINCT 
criteriaDescription as criteria, formattedValue as value ,criteriaUnitDescription as unit 
FROM `articlecriteria` where legacyArticleId=$legacy and lang='$lang'");






$statement->execute();
if (!$statement){


    echo 'Error al ejecutar la consulta';
 }else {

	$arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
  header("HTTP/1.1 200 OK");
  
 }
echo json_encode($arreglo, JSON_UNESCAPED_UNICODE );

?>



