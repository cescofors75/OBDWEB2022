

<?php
 $ref = $_GET['CODIGO'];
$dsn = 'mysql:host=localhost; dbname=td2q2019; charset=UTF8';
$pdo=new PDO($dsn,"root","",array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
    PDO::ATTR_EMULATE_PREPARES => false
  ));
//$pdo->query("SET NAMES 'UTF8' "); from table1 spanish
$statement=$pdo->prepare("Select * from codes_english where Codigo=$ref");
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



