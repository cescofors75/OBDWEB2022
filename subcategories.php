
<?php

$html = '';
$conexion = new mysqli('localhost', 'root','' , 'td2q2019');

$id_category = $_POST['id_category'];


echo $id_category; 
$conexion->query("SET CHARACTER SET utf8");
$conexion->query("SET NAMES utf8");
$result = $conexion->query(
    "SELECT DISTINCT modelId,modelName, yearOfConstrFrom, yearOfConstrTo FROM modelSeries Where   manuId = '".$id_category."'  and linkingTargetType='P' order by modelName"
);


if ($result->num_rows > 0) {
     $html .= '<option value="0">Select...</option>';
    while ($row = $result->fetch_assoc()) {   
        $begin=   substr($row['yearOfConstrFrom'],0,4);    
        $end=    substr($row['yearOfConstrTo'],0,4);               
        $html .= '<option value="'.$row['modelId'].'">'.$row['modelName'].'('.$begin.'-'.$end.')</option>';
    }
    
} 
echo $html;

?>