


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

<div class="honeycomb">
  
  <div class="ibws-fix">
    <div class="hexagon">
      <div class="hexagontent">
        <h1>OBD2</h1>
      </div>
    </div>
    <div class="hexagon">
      <div class="hexagontent"><h1>Solution</h1></div>
    </div>
    <div class="hexanone">
      <div class="hexagontent"></div>
    </div>
    
    <div class="hexagon">
      <div class="hexagontent"><h1></H1></div>
    </div>
    <div class="hexagon">
      <div class="hexagontent"><h1>ALL</H1></div>
    </div>
    <div class="hexanone">
      <div class="hexagontent"></div>
    </div>
    <div class="hexagon">
      <div class="hexagontent"><h1>PARTS</H1></div>
    </div>
  </div>
</div>
<br><br><br><br>
<br><br><br><br>



<div class='container'>


<?php


$html = '';

$conexion = new mysqli('localhost', 'root','' , 'td2q2019');
$carid = $_GET['id_grupos'];


$conexion->query("SET CHARACTER SET utf8");
$conexion->query("SET NAMES utf8");
$result = $conexion->query("SELECT manuName,modelName,typeName,yearOfConstrFrom,yearOfConstrTo FROM vehicledetails WHERE carId=$carid  ");


if ($result->num_rows > 0) {
  $html .="<div align='left' style='background:white'>";
    $html .="<h2><b>INFO</b></h2>";
    
    while ($row = $result->fetch_assoc()) {                
        $html .=  $row['manuName'] . " / ". $row['modelName'] .  " / ". $row['typeName'] . "*" ; 
        $html .=  $row['yearOfConstrFrom'] . " / ". $row['yearOfConstrTo'] . "<br>" ; 
    }
    $html .= "</div>";
} 







?>
<?php


$conexion = new mysqli('localhost', 'root','' , 'td2q2019');
$conexion->query("SET CHARACTER SET utf8");
$conexion->query("SET NAMES utf8");

$result = $conexion->query("SELECT shortCutId,shortCutName FROM `shortcuts` where lang='en' and linkingTargetType='P' order by shortCutName");



if ($result->num_rows > 0) {
  $html .="<div align='left'>";
    $html .="<H2><b>CATALOGUE</b></h2></div><div class='honeycomb'><div class='ibws-fix' align='left'>";
   
    while ($row = $result->fetch_assoc()) {   
        $html .="<div class='hexagon' ><div class='hexagontent' >";              
        $html .= "<a href='recursive2.php?carid=".$carid."&grupo=". $row['shortCutId'] . "'>". $row['shortCutName'] .   "</a></div></div>" ; 
        
    }
    $html .="</div></div>";
} 








echo $html;

?>
</div>
</body>
