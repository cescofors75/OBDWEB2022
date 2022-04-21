

<?php
 $carid = $_GET['carid'];
 $refEuro  = $_GET['code'];
$dsn = 'mysql:host=localhost; dbname=td2q2019; charset=UTF8';
$pdo=new PDO($dsn,"root","",array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
  ));
$statement=$pdo->prepare("Select DISTINCT  articleean.eancode as EAN 
From articlesvehicletrees
INNER JOIN articles
ON articlesvehicletrees.articleId = articles.legacyArticleId and articlesvehicletrees.linkingTargetType='P'

INNER JOIN ambrand
on ambrand.brandId=articles.dataSupplierId and ambrand.active=1

 INNER JOIN legacy2generic
 on legacy2generic.legacyArticleId=articles.legacyArticleId
 INNER JOIN euro2td
 on euro2td.code=legacy2generic.genericArticleId
 
 INNER JOIN genericarticlesgroups
 on genericarticlesgroups.genericArticleId=legacy2generic.genericArticleId and genericarticlesgroups.lang='es'
  
 inner join articleean
 on articleean.legacyArticleId=legacy2generic.legacyArticleId

where   articlesvehicletrees.linkingTargetId=$carid and euro2td.refEuro='$refEuro'
order by articles.genericArticleDescription, ambrand.brandName ");
$statement->execute();
if (!$statement){


    echo 'Error al ejecutar la consulta';
 }else {

	$arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
  header("HTTP/1.1 200 OK");
  
 }
echo json_encode($arreglo, JSON_UNESCAPED_UNICODE );
$statement->closeCursor();
?>



