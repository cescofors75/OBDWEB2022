
<?php
 $carid = $_GET['carid'];
 $code  = $_GET['code'];
 $lang  = $_GET['lang'];


$dsn = 'mysql:host=localhost; dbname=td2q2019; charset=UTF8';
$pdo=new PDO($dsn,"root","",array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
  ));




$statement=$pdo->prepare("Select DISTINCT genericarticlesgroups.designation as designation ,genericarticlesgroups.genericArticleId as id from genericarticlesgroups

INNER JOIN articlesvehicletrees
on genericarticlesgroups.genericArticleId=articlesvehicletrees.genericArticleId

where genericarticlesgroups.lang='$lang' and genericarticlesgroups.designation LIKE '%$code%' and articlesvehicletrees.linkingTargetId=$carid order by genericarticlesgroups.designation
");





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



