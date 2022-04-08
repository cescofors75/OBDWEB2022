


<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">



<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="estilos_wp.css">
<style>
</style>
</head>
<body>



<div class='container'>



<?php
$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$fecha = $_POST['fecha'];
$f2=substr($fecha,0,7);
$f3=str_replace("-","",$f2);
$conexion = new mysqli('localhost', 'root','' , 'td2q2019');
$conexion->query("SET CHARACTER SET utf8");
$conexion->query("SET NAMES utf8");
echo ($marca);
echo "<br>";
echo ($modelo);
echo "<br>";
echo ($f3);
$result = $conexion->query("SELECT carId, manuName, modelName, typeName, yearOfConstrFrom , yearOfConstrTo FROM `vehicledetails` WHERE manuName='$marca' and modelName LIKE '$modelo%' and yearOfConstrFrom<=$f3 and  yearOfConstrTo>=$f3 order by modelName,typeName");

$html ="";

if ($result->num_rows > 0) {
  $html .="<table><tr><td align='left'>";
    $html .="<H2><b>$marca </b></h2></td></tr>";
   
    while ($row = $result->fetch_assoc()) { 
        $f5=$row['yearOfConstrFrom'];
        $f4=substr($f5,0,4);  
        $html .="<tr ><td align='left'>";              
        $html .= "<a href='grupos5.php?id_grupos=". $row['carId'] .  "'>". $row['modelName'] . "/" . $row['typeName'] .  "/" . $f4 ."--></a></td></tr>" ; 
        
    }
    $html .="</table></br></br>";
} 









echo $html;

?>
</div>
</body>
