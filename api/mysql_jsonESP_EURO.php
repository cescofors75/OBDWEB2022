

<?php
 $id_group = $_GET['grupo'];
 $carid = $_GET['carid'];


 if (!isset($_GET['lim'])){
     $limite =1;

 } else{

  $limite = $_GET['lim'];

 }
$dsn = 'mysql:host=localhost; dbname=td2q2019; charset=UTF8';
$pdo=new PDO($dsn,"root","",array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
  ));

$statement=$pdo->prepare("Select DISTINCT   GROUP_CONCAT(DISTINCT eurocrossref.REF_EURO ,': ',europroducts.prixeuroht,'€ ') as dades
                                             
From articlesvehicletrees
INNER JOIN articles
ON articlesvehicletrees.articleId = articles.legacyArticleId
INNER JOIN articlecrosses
ON articlecrosses.articleNumber=articles.articleNumber and articlecrosses.dataSupplierId= articles.dataSupplierId

INNER JOIN eurocrossref
on  eurocrossref.REF_FRN=  articlecrosses.oemNumber 
INNER JOIN europroducts
on europroducts.reference= eurocrossref.REF_EURO 
where articlesvehicletrees.linkingTargetId=$carid and articlesvehicletrees.assemblyGroupNodeId=$id_group  and articlesvehicletrees.linkingTargetType='P'
order by dades"); // and articlesvehicletrees.linkingTargetType='P' ASC LIMIT $limite");
$statement->execute();
if (!$statement){


    echo 'Error al ejecutar la consulta';
 }else {

	$arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
 }
echo json_encode($arreglo, JSON_UNESCAPED_UNICODE );
$statement->closeCursor();
?>



