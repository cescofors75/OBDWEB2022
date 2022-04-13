
<?php 


$html = '';
$conexion = new mysqli('localhost', 'root','' , 'td2q2019');

$id_scategory = $_POST['id_subcategory'];
$id_category = $_POST['id_category'];
//$lang2 = $lang['grupos-lang'];


$conexion->query("SET CHARACTER SET utf8");
$conexion->query("SET NAMES utf8");
//    "SELECT DISTINCT typeName, carId , yearOfConstrFrom, yearOfConstrTo, powerHpFrom, powerKwFrom FROM `vehicledetails` Where   modId = '".$id_scategory."' and manuId = '".$id_category."'    order by typeName"


$result = $conexion->query(
    "SELECT DISTINCT cars.carId, cars.carName, vehicledetails.yearOfConstrFrom, vehicledetails.yearOfConstrTo, vehicledetails.powerHpFrom, vehicledetails.powerKwFrom FROM `cars` 
    inner join vehicledetails on cars.carId = vehicledetails.carId 
    Where cars.firstCountry='be' and cars.modId = '".$id_scategory."' and cars.manuId = '".$id_category."'    order by cars.carName"
);


if ($result->num_rows > 0) {
   $html .= '<option value="0">Select...</option>';
    while ($row = $result->fetch_assoc()) {   
        $begin=   substr($row['yearOfConstrFrom'],0,4);    
        $end=    substr($row['yearOfConstrTo'],0,4);             
        
        $html .= '<option value="'.$row['carId'].'">'.$row['carName'].'('.$begin.'-'.$end.') - '.$row['powerHpFrom'].'cv - '.$row['powerKwFrom'].'hp</option>';
    }
    
} 

echo $html;

?>