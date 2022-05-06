
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>OBD2SOLUTION</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<link rel="stylesheet" href="./css/estilos_wp.css">
<!-- Latest compiled and minified CSS -->

<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script src="./js/function.js"></script>
<script src="./js/script.js"></script>

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
<a href="homepage.php?la=esp"><img class='circle' src="flags/esp.png" alt="<?=$lang['lang-esp'];?>" title="<?=$lang['lang-esp'];?>" /></a>  
<a href="homepage.php?la=eng"><img class='circle' src="flags/eng.png" alt="<?=$lang['lang-eng'];?>" title="<?=$lang['lang-eng'];?>" /></a>
<a href="homepage.php?la=fre"><img class='circle' src="flags/fra.png" alt="<?=$lang['lang-fre'];?>" title="<?=$lang['lang-fre'];?>" /></a>
<a href="homepage.php?la=ger"><img class='circle' src="flags/ger.png" alt="<?=$lang['lang-ger'];?>" title="<?=$lang['lang-ger'];?>" /></a>
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
<div class="space"> </div>

<div class='container'>

<h2>   
 <div class="inner">
    <div class="row">
        <div id="content" class="col-lg-12">
            <form class="row" action="" method="post">
                <div class="form-group col-lg-3 t33" >
                    <label class="text" for="category"><?php echo $lang['index-make'];?></label>
                    <select name="category" id="category" class="form-control">
                        <?php
                      
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
                <div class="form-group col-lg-3 t33">
                    <label class="text" for="subcategory"><?php echo $lang['index-model'];?></label>
                    <select name="subcategory" id="subcategory" class="form-control"></select>
                </div>

                <div class="form-group col-lg-3 t33">
                    <label class="text" for="ssubcategory"><?php echo $lang['index-motor'];?></label>
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

  <div class="row">
    <div class="col-sm">
      
      <div  name="solution" id=""  class='b'> VIN&nbsp;&nbsp;
       <input type="text" id="fname" name="fname" value="JTEAZ99J900006367" > &nbsp;
      <button type="button" onclick="sub();" class="btn btn-success btn-lg"><?php echo $lang['index-b-search'];?></button>
      <button type="button" onclick="ClearVin();" class="btn btn-danger btn-lg"><?php echo $lang['index-b-clear'];?></button> 
    </div>
    </div>
    
    <div class="col-sm">
    
    <div  name="solution3" id="" class='b' >
       <?php echo $lang['index-search'];?>&nbsp;&nbsp;
       <input type="text" id="search" placeholder="4056A026" />&nbsp;&nbsp;&nbsp;&nbsp;
       <button type="button" onclick="Clear();" class="btn btn-danger btn-lg"><?php echo $lang['index-b-clear'];?></button>&nbsp;
      </div>
    </div>

    
    
  

  </div>

 

  <div class="row" >
      <div class="col-sm">
      <div  name="solution" id=""  class='b'> REF EURO4x4&nbsp;
      <input type="text" id="refeuro" name="fname" value="PCV1020" > &nbsp;  
      <button type="button" onclick="subrefeuro();" class="btn btn-success btn-lg"><?php echo $lang['index-b-search'];?></button>&nbsp;
      <button type="button" onclick="Clear();" class="btn btn-danger btn-lg"><?php echo $lang['index-b-clear'];?></button> 
      </div>
      </div>
      <div class="col-sm">
      <div class='b'>
      &nbsp;&nbsp; TCP1010 - PER2112 - KPE1613 - GAL1227 - MPR1034 -BMC1703 - KRA1003
      <button type="button" onclick="subrefeuroFamily();" class="btn btn-success btn-lg"><?php echo $lang['index-b-search'];?></button>&nbsp;
  
    </div>
      </div>
      
  
  
  
   </div>


     

</div>









<?php
if(isset($_SESSION['carid']))
{
?>
<script>
var id_grupos = <?php echo $_SESSION['carid'];?>;
            $.post("grupos.php", { id_grupos: id_grupos}, function(data) {
                $("#grupos").html(data);
            });	
</script>
<?php
}


?>






<br /><br />


<div class='container'>

<div id="display"></div> <!--resultados busqueda referencias -->

</div>
 <!--<div  name="cars" id="cars"> </div> -->


<div  name="grupos" id="grupos"></div>  
 

      

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
    <p></p>
    <span></span>
  </div>
  <div class='gold'>
    <h1>CROSSREF</h1>
    <h2>OEM-After market</h2>
    <div class='price'>80 Mill</div>
    <p>Suppliers</p>
    <span>788</span>
    <p></p>
    <span>Updates</span>
    <p>Monthly</p>
    <span>Multi language</span>
  </div>
  <div class='plat'>
    <h1>PARTS</h1>
    <h2>Filter, Sensor, Pump</h2>
    <div class='price'>7.5 Mill</div>
    <p>Groups</p>
    <span>118</span>
    <p>Categories</p>
    <span>668</span>
    <p></p>
    <span></span>
  </div>
  
</div>
<?php include('./currency.php');?>
<br />
<div style='text-align:left;'>
<p>
<a href="http://jigsaw.w3.org/css-validator/check/referer">
    <img style="border:0;width:88px;height:31px"
        src="http://jigsaw.w3.org/css-validator/images/vcss-blue"
        alt="¡CSS Válido!" />
    </a>
</p>
</div>  


</body>
<script>
function ClearVin() {
          document.getElementById("grupos").innerHTML ="";
         
        }
function euro2tdeanHomepage(ean)
{
  document.getElementById('display').innerHTML ="";
  $('#display').html('<br/> <div class="loading"><img src="images/loader.gif" alt="loading" /><br/> <br/>Read info, One moment, please ...</div>').show()

  $.post("ean.php", {ean: ean}, function(data) {
              /*body=$("#euro2tdean").html()+data;
              $("#euro2tdean").html(body);*/
             // document.getElementById('euro2tdean').innerHTML +=data;
             document.getElementById('display').innerHTML ="";
             document.getElementById('display').innerHTML +=data;

})
};

function subbarcode(){

    var barcode = $("#barcode").val();
    euro2tdeanHomepage(barcode);
};


function subrefeuro(){

var reuro = $("#refeuro").val();
document.getElementById('display').innerHTML ="";
$('#display').html('<br/> <div class="loading"><img src="images/loader.gif" alt="loading" /><br/> <br/>Read info, One moment, please ...</div>').show()


$.post("ean2.php", {reuro: reuro}, function(data) {
             
  document.getElementById('display').innerHTML ="";
            document.getElementById('display').innerHTML +=data;

})




};




function subrefeuroFamily(){

//var reuro = $("#refeuro").val();
document.getElementById('display').innerHTML ="";
$('#display').html('<br/> <div class="loading"><img src="images/loader.gif" alt="loading" /><br/> <br/>Read info, One moment, please ...</div>').show()
document.getElementById('display').innerHTML ="";
//$.post("ean3.php", {reuro: reuro}, function(data) {
$.post("ean3.php", {reuro: 'bmc1642'}, function(data) {
             
            
            document.getElementById('display').innerHTML +=data;

})
$.post("ean3.php", {reuro: 'bmc1643'}, function(data) {
             
            
             document.getElementById('display').innerHTML +=data;

})

$.post("ean3.php", {reuro: 'bmc1644'}, function(data) {
             
          
             document.getElementById('display').innerHTML +=data;

})
$.post("ean3.php", {reuro: 'bmc1645'}, function(data) {
             
             
              document.getElementById('display').innerHTML +=data;
 
 })
 $.post("ean3.php", {reuro: 'bmc1646'}, function(data) {
             
             
              document.getElementById('display').innerHTML +=data;
 
 })
 $.post("ean3.php", {reuro: 'bmc1648'}, function(data) {
             
             
              document.getElementById('display').innerHTML +=data;
 
 })
 $.post("ean3.php", {reuro: 'bmc1649'}, function(data) {
             
            
              document.getElementById('display').innerHTML +=data;
 
 })
 $.post("ean3.php", {reuro: 'bmc1650'}, function(data) {
             
            
             document.getElementById('display').innerHTML +=data;

})



};        
</script>

</html>
