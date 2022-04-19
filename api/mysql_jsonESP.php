<?php
 $carid = $_GET['carid'];
 $code  = $_GET['code'];
$dsn = 'mysql:host=localhost; dbname=td2q2019; charset=UTF8';
$pdo=new PDO($dsn,"root","",array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
  ));
$statement=$pdo->prepare("Select DISTINCT europroducts.reference as reference,   europroducts.libelleproduit as libelle, europroducts.prixeuroht as prix
From articlecrosses
INNER JOIN eurocrossref
ON articlecrosses.oemNumber=eurocrossref.REF_FRN
INNER JOIN europroducts
ON europroducts.reference=eurocrossref.REF_EURO
INNER JOIN articles
ON articlecrosses.articleNumber=articles.articleNumber and articlecrosses.dataSupplierId= articles.dataSupplierId
INNER JOIN articlesvehicletrees
ON articlesvehicletrees.articleId = articles.legacyArticleId 
INNER JOIN legacy2generic
on legacy2generic.legacyArticleId=articles.legacyArticleId
INNER JOIN solutionId 
ON solutionId.id = legacy2generic.genericArticleId
where solutionId.code='$code' and articlesvehicletrees.linkingTargetId=$carid and articlesvehicletrees.linkingTargetType='P'
order by prix LIMIT 3");
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



