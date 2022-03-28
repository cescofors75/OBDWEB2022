<?php
$html = '';
$conexion = new mysqli('localhost', 'root','' , 'td2q2019');

$id_category = $_POST['id_category'];


echo $id_category;

$conexion->query("SET CHARACTER SET utf8");
$conexion->query("SET NAMES utf8");
$result = $conexion->query(
    "SELECT  modelId,modelName FROM modelSeries Where   manuId = '".$id_category."'  and linkingTargetType='P' order by modelName"
);


if ($result->num_rows > 0) {
     $html .= '<option value="0">Select...</option>';
    while ($row = $result->fetch_assoc()) {                
        $html .= '<option value="'.$row['modelId'].'">'.$row['modelName'].'</option>';
    }
    
} 
echo $html;

?>