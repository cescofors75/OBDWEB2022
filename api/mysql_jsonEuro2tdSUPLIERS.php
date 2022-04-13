

<?php
 $carid = $_GET['carid'];
 $code  = $_GET['code'];
 
// WHERE article_links.linkageid='15587' and article_links.linkagetypeid='2' AND prd.assemblygroupdescription = 'Mixing' AND prd.normalizeddescription = 'Sensor' AND prd.description = 'Air flow meter' group by article_links.productid order by prd.description asc");


$dsn = 'mysql:host=localhost; dbname=td2q2019; charset=UTF8';
$pdo=new PDO($dsn,"root","",array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
  ));



//articlecriteria.criteriaDescription as criteria, articlecriteria.rawValue as value, articlecriteria.criteriaUnitDescription as unit


$statement=$pdo->prepare("Select DISTINCT  ambrand.brandId as  logo ,ambrand.brandName as name  ,articles.articleNumber  as number

From articles
INNER JOIN ambrand
on ambrand.brandId=articles.dataSupplierId

INNER JOIN articlesvehicletrees
ON articlesvehicletrees.articleId = articles.legacyArticleId 

INNER JOIN legacy2generic
on legacy2generic.legacyArticleId=articles.legacyArticleId


where legacy2generic.genericArticleId=$code and articlesvehicletrees.linkingTargetId=$carid and articlesvehicletrees.linkingTargetType='P' 
order by  ambrand.brandName ");






$statement->execute();
if (!$statement){


    echo 'Error al ejecutar la consulta';
 }else {

	$arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
  header("HTTP/1.1 200 OK");
  
 }
echo json_encode($arreglo, JSON_UNESCAPED_UNICODE );

?>



