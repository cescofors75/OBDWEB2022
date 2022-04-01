
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>WORLD PARTS</title>


<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<link rel="stylesheet" href="estilos_wp.css">

<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>



</head>

<body >
<?php 
session_start();
if(isset($_GET['la'])){
$_SESSION['la'] = $_GET['la'];
header('Location:'.$_SERVER['PHP_SELF']);
exit();
}
if(isset($_SESSION['la']))
{
switch($_SESSION['la']){
case "eng":
require('lang/eng.php'); 
break;
case "fre":
require('lang/fre.php'); 
break;
case "ger":
require('lang/ger.php'); 
break; 
case "esp":
require('lang/esp.php'); 
break; 
default: 
require('lang/esp.php'); 
}

}else{
require('lang/esp.php');
}
?>

<div id="langSelect">
<a href="index.php?la=esp"><img class='circle' src="flags/esp.png" alt="<?=$lang['lang-esp'];?>" title="<?=$lang['lang-esp'];?>" /></a>  
<a href="index.php?la=eng"><img class='circle' src="flags/eng.png" alt="<?=$lang['lang-eng'];?>" title="<?=$lang['lang-eng'];?>" /></a>
<a href="index.php?la=fre"><img class='circle' src="flags/fra.png" alt="<?=$lang['lang-fre'];?>" title="<?=$lang['lang-fre'];?>" /></a>
<a href="index.php?la=ger"><img class='circle' src="flags/ger.png" alt="<?=$lang['lang-ger'];?>" title="<?=$lang['lang-ger'];?>" /></a>
</div>




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
if(isset($_GET['carid'])){
  
  $carid = $_GET['carid'];
  }

$html = '';
$conexion = new mysqli('localhost', 'root','' , 'td2q2019');


$conexion->query("SET CHARACTER SET utf8");
$conexion->query("SET NAMES utf8");
$result = $conexion->query("SELECT manuName,modelName,typeName,yearOfConstrFrom,yearOfConstrTo FROM vehicledetails WHERE carId=$carid LIMIT 1" );



if ($result->num_rows > 0) {
  $html .="<div class='info'>";
    $html .="<h2>".$lang['grupos-info']."</h2>";
    
    while ($row = $result->fetch_assoc()) {                
        $html .=  $row['manuName'] . " / ". $row['modelName'] .  " / ". $row['typeName'] . "*" ; 
        $html .=  $row['yearOfConstrFrom'] . " / ". $row['yearOfConstrTo'] . "<br>" ; 
    }
    $html .= "</div>";
} 

echo $html;



?>
<br><br>

<?php 

if(isset($_GET['carid'])){
  
  $carid = $_GET['carid'];
  }

  if(isset($_GET['grupo'])){
  
    $id_shortcut= $_GET['grupo'];
    }
  
  



    function getPdo(){

        try {

            $db_name     = 'td2q2019';
            $db_user     = 'root';
            $db_password = '';
            $db_host     = 'localhost';

            $pdo = new PDO('mysql:host=' . $db_host . '; dbname=' . $db_name, $db_user, $db_password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->exec("SET CHARACTER SET utf8");
            $pdo->exec("SET NAMES utf8");
            return $pdo;

           } catch (PDOException $e) {
               echo $e->getMessage();
           }
    }

    try {
             $pdo = getPdo();
             
             //$sql  = "select * FROM assemblygroupnodes where  linkingTargetType='P'and shortCutId=4 and  parentNodeId is Null";    
             //$sql  = "select * FROM assemblygroupnodes where shortCutId= $id_shortcut  and linkingTargetType='V'and  parentNodeId is Null order by assemblyGroupName";       
             $sql  = "select distinct assemblyGroupName, assemblygroupnodes.assemblyGroupNodeId FROM assemblygroupnodes 
             
             inner join vehicletrees
             on assemblygroupnodes.assemblyGroupNodeId=vehicletrees.assemblyGroupNodeId
             where shortCutId= $id_shortcut  and assemblygroupnodes.linkingTargetType='P' and lang='".$lang['grupos-lang']."'and  assemblygroupnodes.parentNodeId is Null order by assemblyGroupName";       
             $stmt = $pdo->prepare($sql);
             $stmt->execute(); 

             $data = [];
             echo "<table>"; /*style='text-align: left'*/
             while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr><td class='parent'>". $row['assemblyGroupName'] . "</td></tr>";
                 getSubCategories($row['assemblyGroupNodeId'], 0,$carid,$id_shortcut,$lang['grupos-lang']);
             }    //#0A1F47              
                 
        } catch (Exception $e) {
            echo $e->getMessage();

           echo "</table>";
        }

    function getSubCategories($parent_id, $level,$carid,$id_shortcut,$lang) {
       
        try {

            $pdo = getPdo();

            //$sql = "select * FROM assemblygroupnodes where linkingTargetType='P'and shortCutId=4 and parentNodeId = '$parent_id'";        
            
            
            $sql = "select distinct  assemblyGroupName, assemblygroupnodes.assemblyGroupNodeId, hasChilds FROM assemblygroupnodes 
            inner join vehicletrees
            on assemblygroupnodes.assemblyGroupNodeId=vehicletrees.assemblyGroupNodeId
            where   assemblygroupnodes.parentNodeId = '$parent_id' and assemblygroupnodes.linkingTargetType='P' and lang='$lang' and vehicletrees.carid=$carid and shortCutId= $id_shortcut order by assemblyGroupName";  
            

            /*
               $sql = "select * FROM assemblygroupnodes 
            inner join vehicletrees
            on assemblygroupnodes.assemblyGroupNodeId=vehicletrees.assemblyGroupNodeId
            where assemblygroupnodes.linkingTargetType='V' and  assemblygroupnodes.parentNodeId = '$parent_id'  and vehicletrees.carid=$carid and shortCutId= $id_shortcut order by assemblyGroupName";  
            
            

            */
     
          //  $stmt = $pdo->prepare($sql);
            $stmt = $pdo->prepare($sql);
            $stmt->execute(); 

            $data = [];  

            $level++;                 
            
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

              
               if ($row['hasChilds']===0){
                
                $text=str_repeat("&nbsp;", ($level * 4)).$level."-". $row['assemblyGroupName'] ."-".$row['assemblyGroupNodeId'] ; 
                echo"<tr><td class='child'><a href='cref.php?carid=".$carid."&grupo=". $row['assemblyGroupNodeId'] . "&name=". $row['assemblyGroupName'] ."'>".$text."</td></tr>"; 
               }else{

                $text=str_repeat("&nbsp;", ($level * 4)).$level."-" . $row['assemblyGroupName'] ;//. ' '.$row['assemblyGroupNodeId'] ; 
                echo"<tr><td class='semiparent'>".$text."</td></tr>"; 

               } //#AFBEFC
               
               
               getSubCategories($row['assemblyGroupNodeId'], $level,$carid,$id_shortcut,$lang); 
               
               
                // echo str_repeat("-", ($level * 4)) . $row['assemblyGroupName'] . ' '.$row['assemblyGroupNodeId'] .'<br>';                    
                                                  
            } 
            
                 

        } catch (Exception $e) {
            echo $e->getMessage();
        }                 
    }


    ?>



  </div>
 
</body>
</html>
