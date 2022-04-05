

<?php
 $carid = $_GET['carid'];
 $code  = $_GET['code'];

// WHERE article_links.linkageid='15587' and article_links.linkagetypeid='2' AND prd.assemblygroupdescription = 'Mixing' AND prd.normalizeddescription = 'Sensor' AND prd.description = 'Air flow meter' group by article_links.productid order by prd.description asc");


$dsn = 'mysql:host=localhost; dbname=td2q2019; charset=UTF8';
$pdo=new PDO($dsn,"root","",array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
  ));

//$pdo->query("SET NAMES 'UTF8' ");
//"Select DISTINCT REF_EURO, REF_FRN from eurocrossref where REF_FRN =$ref");

/*
$statement=$pdo->prepare("SELECT DISTINCT manufacturers.description as  M2,replace( REPLACE(article_oe.OENbr,'-','' ),' ','' )as OEM
FROM article_links
inner JOIN article_oe ON article_oe.supplierid = article_links.supplierid AND article_oe.datasupplierarticlenumber = article_links.datasupplierarticlenumber
inner JOIN crossref ON crossref.REF_FRN=article_oe.OENbr
inner JOIN products ON products.reference=crossref.REF_EURO
inner JOIN prd ON prd.id = article_links.productid

inner JOIN manufacturers ON manufacturers.id = article_oe.manufacturerId
inner JOIN linkagetargets ON linkagetargets.linkageTargetId = article_links.linkageid

WHERE article_links.linkageid=$carid  and manufacturers.Description=linkagetargets.mfrName and article_links.linkagetypeid='2' AND prd.description = (Select parts from solution where solution.code='$code') ");

*/
/*
$statement=$pdo->prepare("Select DISTINCT  manufacturers.manuName as M2 , articlecrosses.oemNumber as OEM
From articles

INNER JOIN articlesvehicletrees
ON articlesvehicletrees.articleId = articles.legacyArticleId 

INNER JOIN articlecrosses
ON articlecrosses.articleNumber=articles.articleNumber and articlecrosses.dataSupplierId= articles.dataSupplierId

INNER JOIN manufacturers
ON manufacturers.manuId=articlecrosses.mfrId

INNER JOIN legacy2generic
on legacy2generic.legacyArticleId=articles.legacyArticleId

INNER JOIN solutionId 
ON solutionId.id = legacy2generic.genericArticleId

where solutionId.code='$code' and articlesvehicletrees.linkingTargetId=$carid and articlesvehicletrees.linkingTargetType='P' and articlecrosses.mfrId=articles.mfrId
order by  manufacturers.manuName ");
*/
$statement=$pdo->prepare("Select DISTINCT  manufacturers.manuName as M2 , articlecrosses.oemNumber as OEM
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

INNER JOIN solutionId 
ON solutionId.id = legacy2generic.genericArticleId

where solutionId.code='$code' and articlesvehicletrees.linkingTargetId=$carid and articlesvehicletrees.linkingTargetType='P'

order by  manufacturers.manuName;");




$statement->execute();
if (!$statement){


    echo 'Error al ejecutar la consulta';
 }else {

	$arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
  header("HTTP/1.1 200 OK");
  
 }
echo json_encode($arreglo, JSON_UNESCAPED_UNICODE );

?>



