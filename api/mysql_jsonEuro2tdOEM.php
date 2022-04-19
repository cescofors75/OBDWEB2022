

<?php
 $carid = $_GET['carid'];
 $refEuro  = $_GET['code'];
$dsn = 'mysql:host=localhost; dbname=td2q2019; charset=UTF8';
$pdo=new PDO($dsn,"root","",array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
  ));
  set_time_limit(300);

$statement=$pdo->prepare("Select DISTINCT  manufacturers.manuName as M2 , replace( REPLACE(articlecrosses.oemNumber,'-','' ),' ','' ) as OEM
From articlecrosses
INNER JOIN articles
ON articlecrosses.articleNumber=articles.articleNumber and articlecrosses.dataSupplierId= articles.dataSupplierId
INNER JOIN articlesvehicletrees
ON articlesvehicletrees.articleId = articles.legacyArticleId 
INNER JOIN vehicledetails
ON vehicledetails.carId=articlesvehicletrees.linkingTargetId
INNER JOIN manufacturers
ON manufacturers.manuId=articlecrosses.mfrId and manufacturers.manuName=vehicledetails.manuName
INNER JOIN legacy2generic
on legacy2generic.legacyArticleId=articles.legacyArticleId
INNER JOIN euro2td
on euro2td.code=articlesvehicletrees.genericArticleId
where euro2td.refEuro='$refEuro' and articlesvehicletrees.linkingTargetId=$carid and articlesvehicletrees.linkingTargetType='P'
order by OEM");
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



