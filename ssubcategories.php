

<?php
$html = '';
$conexion = new mysqli('localhost', 'root','' , 'td2q2019');

$id_scategory = $_POST['id_subcategory'];
$id_category = $_POST['id_category'];

$conexion->query("SET CHARACTER SET utf8");
$conexion->query("SET NAMES utf8");


$result = $conexion->query(
    "SELECT DISTINCT typeName, carId , yearOfConstrFrom, yearOfConstrTo FROM `vehicledetails` Where   modId = '".$id_scategory."' and manuId = '".$id_category."'   order by typeName"
);


if ($result->num_rows > 0) {
   $html .= '<option value="0">Select...</option>';
    while ($row = $result->fetch_assoc()) {   
        $begin=   substr($row['yearOfConstrFrom'],0,4);    
        $end=    substr($row['yearOfConstrTo'],0,4);             
        
        $html .= '<option value="'.$row['carId'].'">'.$row['typeName'].'('.$begin.'-'.$end.')</option>';
    }
    
} 

echo $html;

?>