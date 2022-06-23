
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>OBD2SOLUTION</title>

<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">-->
<link rel="stylesheet" href="./css/estilos_wp.css">
<!-- Latest compiled and minified CSS -->

<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>


   <!-- Including CSS file. -->


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
<a href="refSearch.php?la=esp"><img class='circle' src="flags/esp.png" alt="<?=$lang['lang-esp'];?>" title="<?=$lang['lang-esp'];?>" /></a>  
<a href="refSearch.php?la=eng"><img class='circle' src="flags/eng.png" alt="<?=$lang['lang-eng'];?>" title="<?=$lang['lang-eng'];?>" /></a>
<a href="refSearch.php?la=fre"><img class='circle' src="flags/fra.png" alt="<?=$lang['lang-fre'];?>" title="<?=$lang['lang-fre'];?>" /></a>
<a href="refSearch.php?la=ger"><img class='circle' src="flags/ger.png" alt="<?=$lang['lang-ger'];?>" title="<?=$lang['lang-ger'];?>" /></a>
</div>



<div class="honeycomb">
  
  <div class="ibws-fix">
    <div class="hexagon">
      <div class="hexagontent">
        <h1>REF</h1>
      </div>
    </div>
    <div class="hexagon">
      <div class="hexagontent"><h1>Search</h1></div>
    </div>
    <div class="hexanone">
      <div class="hexagontent"></div>
    </div>
    
    <div class="hexagon">
      <div class="hexagontent"><h1></H1></div>
    </div>
    <div class="hexagon">
      <div class="hexagontent"><h1>OME</H1></div>
    </div>
    <div class="hexanone">
      <div class="hexagontent"></div>
    </div>
    <div class="hexagon">
      <div class="hexagontent"><h1>PARTS</H1></div>
    </div>
  </div>
</div>
<div class="space"> </div>

<div class='space2'> </div>

<div class='container'>

 




<div class="row">
    <div class="col-sm">
    <div  name="solution3" id="" class='b' >
                    <label class="text, b" for="category"><?php echo $lang['index-make'];?></label>
                    <select name="category" id="make" class="form-control">
                        <?php
                          $conexion = new mysqli('localhost', 'root','' , 'td2q2019');
                          $conexion->query("SET CHARACTER SET utf8"); 
                          $conexion->query("SET NAMES utf8");
                          $result = $conexion->query(
                            "SELECT DISTINCT manuId, manuName FROM `manufacturers` 
                             where  linkingTargetType='P' and
                              manuName NOT LIKE '%MOTO%'
                             and manuName NOT LIKE '%SCOOTER%'
                             order by manuName"
                        );
  
                          
  
                          if ($result->num_rows > 0) {



                       
                          echo '<option >'; echo $lang['index-select'] ; echo'</option>';
                          echo '<option disabled class="bold-option">'; echo $lang['index-most-popular-makes']; echo'</option>';
                          echo '<option value="111">Toyota</option>';
                          echo '<option disabled class="bold-option">'; echo $lang['index-other-makes']; echo'</option>';
                          while ($row = $result->fetch_assoc()) {                
                            echo '<option value="'.$row['manuId'].'">'.$row['manuName'].'</option>';
                        }
                        mysqli_free_result($result); 
                    }
                    mysqli_close($conexion);
                        ?>
                    </select>
                </div>
      
    </div>
    
    <div class="col-sm">
    
    <div  name="solution3" id="" class='b' >
       <?php echo $lang['index-search'];?>&nbsp;&nbsp;
       <input type="text" id="refome" value="4755060120" />&nbsp;<br />
       <button type="button" onclick="critereSearch();" class="btn btn-success btn-lg"><?php echo $lang['index-b-search'];?></button>&nbsp;&nbsp;

       <button type="button" onclick="Clear();" class="btn btn-danger btn-lg"><?php echo $lang['index-b-clear'];?></button></div>
       


    </div>

    
    
  

</div>


<br /><br />




<div id="display"></div> <!--resultados busqueda referencias -->





</body>

<script>



function critereSearch(){
  var refome = $("#refome").val();
  var make = $("#make").val();
  if (make == '<?php echo $lang['index-select']?>') {
    alert("<?php echo $lang['please-select']?>");
    return;
  }
  document.getElementById('display').innerHTML ="";

  $('#display').html('<br/> <div class="loading"><img src="images/loader.gif" alt="loading" /><br/> <br/>Read info, One moment, please ...</div>').show()

  //document.getElementById('display').innerHTML ="refome: "+refome+" make: "+make;

  $.post("view2.php", {refome: refome,make: make}, function(data) {
    document.getElementById('display').innerHTML ="";
             document.getElementById('display').innerHTML +=data;
})
};

function Clear() {
          document.getElementById("display").innerHTML ="";
          
        }  






</script>

</html>
