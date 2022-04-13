

<?php
 $carid = $_GET['carid'];
 $code  = $_GET['code'];

// WHERE article_links.linkageid='15587' and article_links.linkagetypeid='2' AND prd.assemblygroupdescription = 'Mixing' AND prd.normalizeddescription = 'Sensor' AND prd.description = 'Air flow meter' group by article_links.productid order by prd.description asc");


$dsn = 'mysql:host=localhost; dbname=td2q2019; charset=UTF8';
$pdo=new PDO($dsn,"root","",array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
  ));


/*

$statement=$pdo->prepare("SELECT DISTINCT article_oe.OENbr, crossref.REF_EURO, products.libelleproduit, products.prixeuroht, solution.parts as partes
FROM article_links
inner JOIN article_oe ON article_oe.supplierid = article_links.supplierid AND article_oe.datasupplierarticlenumber = article_links.datasupplierarticlenumber
inner JOIN crossref ON crossref.REF_FRN=article_oe.OENbr
inner JOIN products ON products.reference=crossref.REF_EURO
inner JOIN prd ON prd.id = article_links.productid

inner JOIN manufacturers ON manufacturers.id = article_oe.manufacturerId
inner JOIN linkagetargets ON linkagetargets.linkageTargetId = article_links.linkageid
inner JOIN solution ON solution.parts=prd.description
WHERE article_links.linkageid=$carid  and manufacturers.Description=linkagetargets.mfrName and article_links.linkagetypeid='2' AND  solution.code='$code' GROUP by crossref.REF_EURO
ORDER BY `products`.`libelleproduit` ASC LIMIT 3");

*/
//europroducts.reference, europroducts.libelleproduit, europroducts.prixeuroht
/*INNER JOIN eurocrossref
ON articlecrosses.oemNumber=eurocrossref.REF_FRN

INNER JOIN europroducts
ON europroducts.reference=eurocrossref.REF_EURO*/

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


where articlesvehicletrees.genericArticleId=$code and articlesvehicletrees.linkingTargetId=$carid and articlesvehicletrees.linkingTargetType='P'

order by prix LIMIT 3");





$statement->execute();
if (!$statement){


    echo 'Error al ejecutar la consulta';
 }else {

	$arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
  header("HTTP/1.1 200 OK");
  
 }
echo json_encode($arreglo, JSON_UNESCAPED_UNICODE );

?>



