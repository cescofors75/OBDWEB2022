<?php
 $carid = $_GET['carid'];
 $code  = $_GET['code'];
$dsn = 'mysql:host=localhost; dbname=bd_oem; charset=UTF8';
$pdo=new PDO($dsn,"root","",array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
  ));
$statement=$pdo->prepare("SELECT DISTINCT manufacturers.description as  M2,replace( REPLACE(article_oe.OENbr,'-','' ),' ','' )as OEM
FROM article_links
inner JOIN article_oe ON article_oe.supplierid = article_links.supplierid AND article_oe.datasupplierarticlenumber = article_links.datasupplierarticlenumber
inner JOIN prd ON prd.id = article_links.productid
inner JOIN manufacturers ON manufacturers.id = article_oe.manufacturerId
inner JOIN linkagetargets ON linkagetargets.linkageTargetId = article_links.linkageid 
WHERE (article_links.linkageid=$carid)  and (manufacturers.description = linkagetargets.mfrName) and (article_links.linkagetypeid='2') AND (prd.description = (Select parts from solution where solution.code='$code')) LIMIT 1");
$statement->execute();
if (!$statement){


    echo 'Error al ejecutar la consulta';
 }else {

	$arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
  header("HTTP/1.1 200 OK");
  
 }
echo json_encode($arreglo, JSON_UNESCAPED_UNICODE );
mysqli_free_result($statement); 
mysqli_close($pdo);
?>



