



<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>WORLD PARTS</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<link rel="stylesheet" href="estilos_wp.css">
<!-- Latest compiled and minified CSS -->

<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script src="function.js"></script>
<script src="script.js"></script>

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

<?php
$conexion = new mysqli('localhost', 'root','' , 'td2q2019');
?>  
<div id="langSelect">
<a href="index.php?la=esp"><img class='circle' src="flags/esp.png" alt="<?=$lang['lang-esp'];?>" title="<?=$lang['lang-esp'];?>" /></a>  
<a href="index.php?la=eng"><img class='circle' src="flags/eng.png" alt="<?=$lang['lang-eng'];?>" title="<?=$lang['lang-eng'];?>" /></a>
<a href="index.php?la=fre"><img class='circle' src="flags/fra.png" alt="<?=$lang['lang-fre'];?>" title="<?=$lang['lang-fre'];?>" /></a>
<a href="index.php?la=ger"><img class='circle' src="flags/ger.png" alt="<?=$lang['lang-ger'];?>" title="<?=$lang['lang-ger'];?>" /></a>
</div>
<div >


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
<div class="space"> </div>

<div class='container'>

<h2>   
 <div class="inner">
    <div class="row">
        <div id="content" class="col-lg-12">
            <form class="row" action="" method="post">
                <div class="form-group col-lg-3">
                    <label for="category"><?php echo $lang['index-make'];?></label>
                    <select name="category" id="category" class="form-control">
                        <?php
                      
                        $conexion->query("SET CHARACTER SET utf8");
                        $conexion->query("SET NAMES utf8");
                        $result = $conexion->query(
                          "SELECT DISTINCT manuId, manuName FROM `manufacturers` where linkingTargetType='P' order by manuName"
                      );

                        

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {                
                                echo '<option value="'.$row['manuId'].'">'.$row['manuName'].'</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-lg-3">
                    <label for="subcategory"><?php echo $lang['index-model'];?></label>
                    <select name="subcategory" id="subcategory" class="form-control"></select>
                </div>

                <div class="form-group col-lg-3">
                    <label for="ssubcategory"><?php echo $lang['index-motor'];?></label>
                    <select name="ssubcategory" id="ssubcategory" class="form-control"></select>
                </div>
            </form>

            </div>
    </div>
    </div>

 </h2>
 </div>
 <div class='space2'> </div>
 <div class='container'>
   <table class='menuP'>
  <tr> <td class='bold'><div id="texte">
  <form name="form" action="" >
  <label for="fname">VIN</label></td><td>
  <input type="text" id="fname" name="fname" value="JTEBZ29J400070571" >SALLDVA576A725557  JN10KYY60U0872024  JTEAZ99J900006367
  
   </form></td><td class="t20">
                      
   <button type="button" onclick="sub();" class="btn btn-primary btn-lg"><?php echo $lang['index-b-search'];?></button></td></tr>
   <tr><td class='bold'>  
   <?php echo $lang['index-search'];?></td><td>
    <input type="text" id="search" placeholder="4056A026" /><br>43512-0K060, 60626888
  
   

   <!-- Suggestions will be displayed in below div. -->


   </td><td class="t20"><button type="button" onclick="Clear();" class="btn btn-primary btn-lg"><?php echo $lang['index-b-clear'];?></button>
   

   

</td></tr>
</table>
</div>

<br /><br /><br />



<div class='container'>
<!--<div id="elements"></div>  -->

<div id="display"></div> <!--resultados busqueda referencias -->


 <!--<div  name="cars" id="cars"> </div> -->


<div  name="grupos" id="grupos"></div>  
 

</div>           

<div class='space'>  </div>       
       
<div class='foot'>
 
  <div class='silver'>
    <h1>BRANDS</h1>
    <h2>Toyota, Nissan, Mitsubishi</h2>
    <div class='price'>1475</div>
    <p>Begin year</p>
    <span>1956</span>
    <p>End Year</p>
    <span>2019</span>
    <p>Models</p>
    <span>14,39 mil</span>
  </div>
  <div class='gold'>
    <h1>CROSSREF</h1>
    <h2>OEM-After market</h2>
    <div class='price'>80 Mill</div>
    <p>Suppliers</p>
    <span>788</span>
    <p>Updates</p>
    <span>Monthly</span>
    <p>Multi language</p>
    <span>Comming soon..</span>
  </div>
  <div class='plat'>
    <h1>PARTS</h1>
    <h2>Filter, Sensor, Pump</h2>
    <div class='price'>7.5 Mill</div>
    <p>Groups</p>
    <span>118</span>
    <p>Categories</p>
    <span>668</span>
    <p>Amazing</p>
    <span>Easy,Fast, Simply</span>
  </div>
  
</div>

<p>
<a href="http://jigsaw.w3.org/css-validator/check/referer">
    <img style="border:0;width:88px;height:31px"
        src="http://jigsaw.w3.org/css-validator/images/vcss-blue"
        alt="¡CSS Válido!" />
    </a>
</p>
        
</body>


</html>
