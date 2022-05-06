

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">




<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="./css/estilos_wp.css">


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</head>
<body>



<div class='container'> <!-- info car -->
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
$html = '';
set_time_limit(300);
$conexion = new mysqli('localhost', 'root','' , 'td2q2019');
$carid = $_POST['id_grupos'];
$_SESSION['carid'] = $carid;


$conexion->query("SET CHARACTER SET utf8");
$conexion->query("SET NAMES utf8");
$result = $conexion->query("SELECT manuName,modelName,typeName,yearOfConstrFrom,yearOfConstrTo, manuId FROM vehicledetails WHERE carId=$carid  LIMIT 1");


if ($result->num_rows > 0) {
  $html .="<div class='b' >";
    $html .="<h2><b>".$lang['grupos-info']."</b></h2>";
    
    while ($row = $result->fetch_assoc()) {  
        $html .=  "<img src='../images/makes_logos/".$row['manuId'].".png' width='50' height='50'>&nbsp;";             
        $html .=  $row['manuName'] . " / ". $row['modelName'] .  " / ". $row['typeName'] . "*" ; 
        $html .=  $row['yearOfConstrFrom'] . " / ". $row['yearOfConstrTo'] . "<br>" ; 
    }
    $html .= "</div><br>";
    mysqli_free_result($result); 
} 

echo($html);
$html="";

?>





<input type=hidden id=carid value='<?php  echo $carid; ?>'/>   <!-- menu options & solutions -->



  <div class='r'><?php echo $lang['grupos-option'];?>&nbsp; P0201, P0255, P0100 </div>
  <div class='b' ><?php echo $lang['grupos-code'];?>&nbsp; <input type="text" id="code" name="fname" value="P0190" >&nbsp; 
  <button type="button" onclick="solution()" class="btn btn-success btn-lg"><?php echo $lang['grupos-solution'];?></button> &nbsp; <button type="button" onclick="ALLsolution()" class="btn btn-warning btn-lg"><?php echo $lang['grupos-allsolution'];?></button>&nbsp;&nbsp;<button type="button" onclick="Clear_solutions()" class="btn btn-danger btn-lg"><?php echo $lang['grupos-clearsolution'];?></button>
   
  </div>


<div  name="solution2" id="solution2"> </div>
<div class='b2' name="solution5" id="solution5"> </div>
</br>

  <div class="row">
    <div class="col-sm">
      <div class='b'id="t_solution"></div>
    <div  name="solution" id="solution"> </div>
    </div>
    <div class="col-sm">
    <div class='b' id="t_solution3"></div>
    
    <div  name="solution3" id="solution3"> </div>
    </div>
    <div class="col-sm">
    <div class='b' id="t_solution4"></div>
    
    <div  name="solution4" id="solution4"> </div>
    </div>
  </div>




<?php


$conexion = new mysqli('localhost', 'root','' , 'td2q2019');
$conexion->query("SET CHARACTER SET utf8");
$conexion->query("SET NAMES utf8");

$result = $conexion->query("SELECT shortCutId,shortCutName FROM `shortcuts` where lang='".$lang['grupos-lang']."' and linkingTargetType='P' order by shortCutName");




if ($result->num_rows > 0) {
  $html .="</br><div class='b'>";
    $html .=$lang['grupos-catalogue']."</div>";

    $html .="</br><div class='b'><input type='text' id='codeT' name='fname' value='".$lang['grupos-text-Thermostat']."' >&nbsp; ";
    $html .="<button type='button' onclick='solutionT()' class='btn btn-success btn-lg'>".$lang['index-b-search']."</button>";
    $html .="&nbsp;&nbsp;&nbsp;<button type='button' onclick='ClearT()' class='btn btn-danger btn-lg'>".$lang['index-b-clear']."</button></div>";

    $html .="<div >";
    $html .="<div  class='bn' name='solutionT' id='solutionT'> </div>";
    while ($row = $result->fetch_assoc()) {   
       
                      
        $html .= "<a href='./php/recursive.php?carid=".$carid."&grupo=". $row['shortCutId'] . "'><img src='../images/images_sections/". $row['shortCutId'] .".png' width='80' title='". $row['shortCutName'] ."'></a>" ; 
        
      
      }
    
    $html .="</div>";
    mysqli_free_result($result); 
} 





echo $html;
$html="";

?>

<input type=hidden id=carid value='<?php  echo $carid; ?>'/>   <!-- menu euro2td -->



  <div class='r'><?php echo $lang['grupos-option'];?>&nbsp; BET, DAM </div>
  <div class='b' ><?php echo $lang['grupos-code'];?>&nbsp; 
  <select name="category" id="family" class="form-control">
                        <?php
                      
                        $conexion->query("SET CHARACTER SET utf8"); 
                        $conexion->query("SET NAMES utf8");
                        $result = $conexion->query(
                          "SELECT DISTINCT refEuro,code FROM `euro2td` 
                          
                           order by refEuro"
                      );

                        

                        if ($result->num_rows > 0) {
                          echo '<option >'; echo $lang['index-select'] ; echo'</option>';
                         
                            while ($row = $result->fetch_assoc()) {                
                                echo '<option value="'.$row['refEuro'].'">'.$row['refEuro'].'</option>';
                            }
                            mysqli_free_result($result);
                        }
                        mysqli_close($conexion);
                        ?>
                    </select>
  
  
  &nbsp; 
  <button type="button" onclick="euro2td()" class="btn btn-success btn-lg"><?php echo $lang['grupos-solution'];?></button> &nbsp; &nbsp;&nbsp;<button type="button" onclick="ClearEuro2td()" class="btn btn-danger btn-lg"><?php echo $lang['grupos-clearsolution'];?></button>
   
  </div>


<!-- 
<div  name="solution2" id="solution2"> </div>
<div class='b2' name="solution5" id="solution5"> </div>-->
</br>

  <div class="row">
    <div class="col-sm">
      <div class='b'id="t_solution"></div>
    <div   id="euro2td"> </div>
    </div>
    <div class="col-sm">
    <div class='b' id="t_solution3"></div>
    
    <div   id="euro2td2"> </div>
    </div>
    <div class="col-sm">
    <div class='b' id="t_solution4"></div>
    
    <div  id="euro2td3"> </div>
    </div>
  </div>


  <div  id="euro2tdSupliers"> </div>
  <div  id="euro2tdean"> </div>

</body>

</htmnl>
<script>
var $card=""
var $texte=""


function solution(){

 var $partes=""

  document.getElementById('t_solution').innerHTML="<?php echo $lang['grupos-recommended'];?>";
  document.getElementById('t_solution3').innerHTML="OEM" ;
  document.getElementById('t_solution4').innerHTML="<?php echo $lang['grupos-suppliers'];?>";

let url  = "./api/mysql_jsonESP.php?carid="+document.getElementById("carid").value+"&code="+document.getElementById("code").value
$('#solution').html('<br/> <div class="loading"><img src="images/loader.gif" alt="loading" /><br/> <br/>Read database solutions </br>One moment, please ...</div>').show()

     // fetch(url,{mode: 'cors', headers: {'Access-Control-Allow-Origin': '*'}})
     fetch(url)
          .then( response => response.json() )
          .then( data => mostrarData(data) )
          .catch( error => console.log(error) )

      const mostrarData = (data) => {
          console.log(data)
          if (data.length >0){
          let body = ""
          body+="<?php echo $lang['grupos-trecomended'];?>";
          for (var i = 0; i < data.length; i++) {   
            //$oem =data[i].OENbr
            $ref_euro=data[i].reference
            $desc=data[i].libelle
            $prix=data[i].prix
            $familia=$ref_euro.substring(0,3).toLowerCase()
            $ref_euro2=$ref_euro.toLowerCase()
            $partes=data[i].partes
            
             
            body+="<div class='card' style='width:300px'>"
            body+="<img src='http://blog.euro4x4parts.com/photos/"+ $familia + "/" + $ref_euro2 + "z.jpg'  class='card-img-top' style='width:300px'>"
            body +="<div class='card-body'>"
            body+="<h5 class='card-title'>"+$ref_euro+"</h5>"
            body+="<p class='card-text'>"+$desc+"</p>"
            body+="<a href='#' class='btn btn-primary'>+ Buy "+$prix+"€</a></div></div>"
               
          
            }
         
          document.getElementById('solution').innerHTML = body
         
          }else{
            $('#solution').html("<div class='error'>"+"<?php echo $lang['grupos-notparts'];?>"+"</div>")

          }
          
          
      }

 solution_error()     
 solution4_supliers()  
 solution3_OEM()
}





 function solution_error(){

let url  = "./api/mysql_jsonCODE.php?CODIGO='"+document.getElementById("code").value+"'"
$('#solution2').html('<br/> <div class="loading"><img src="images/loader.gif" alt="loading" /><br/> <br/>Read database codes, One moment, please ...</div>').show()
//console.log(x)

      fetch(url)
          .then( response => response.json() )
          .then( data => mostrarData(data) )
          .catch( error => console.log(error) )

      const mostrarData = (data) => {
          console.log(data)
          if (data.length >0){
          let body = "</br><div class='r'>"
          for (var i = 0; i < data.length; i++) {   
          
             body+="Code description:  "+data[i].error+"-"
          
            }
          body+="</div>"
          
          document.getElementById('solution2').innerHTML = body
          }else{
            $('#solution2').html("<div class='error'>"+"<?php echo $lang['grupos-notcode'];?>"+"</div>")

          }
          
         
      }

      
      
}







 

 function solution3_OEM(){


let url  = "./api/mysql_jsonESP_OEM.php?carid="+document.getElementById("carid").value+"&code="+document.getElementById("code").value
$('#solution3').html('<br/> <div class="loading"><img src="images/loader.gif" alt="loading" /><br/> <br/>Read OEM, One moment, please ...</div>').show()

      fetch(url)
          .then( response => response.json() )
          .then( data => mostrarData(data) )
          .catch( error => console.log(error) )

      const mostrarData = (data) => {
          console.log(data)
          if (data.length >0){
          let body = "</br><table>"
          for (var i = 0; i < data.length; i++) {   
           
             body+="<tr><td class='t20'>"+data[i].M2+"&nbsp;&nbsp;&nbsp;&nbsp;"+data[i].OEM+"</td></tr>"  
          
            }
          body+="</table>"
          document.getElementById('solution3').innerHTML = body
          }else{
            $('#solution3').html("<div class='error'>"+"<?php echo $lang['grupos-notreference'];?>"+"</div>")

          }
          
          
      }

    
}




 function solution4_supliers(){


  let url = "./api/mysql_jsonESP_SUPLIERS.php?carid="+document.getElementById("carid").value+"&code="+document.getElementById("code").value
  $('#solution4').html('<br/> <div class="loading"><img src="images/loader.gif" alt="loading" /><br/> <br/>Read suppliers, One moment, please ...</div>').show()

        fetch(url)
            .then( response => response.json() )
            .then( data => mostrarData(data) )
            .catch( error => console.log(error) )

        const mostrarData = (data) => {
            console.log(data)
            if (data.length >0){
            let body = "<table></br>"
            for (var i = 0; i < data.length; i++) {      
               body+="<tr><td class='t100'><img src='../images/images_supplier_logos/"+data[i].logo+".png' width='80' onerror=this.onerror=null;this.src='./images/no_image.jpg';></td><td>"+data[i].number+"</td><td>"+data[i].name+"</td></tr>"
               // body+=`<tr><td>${data[i].id}</td><td>${data[i].name}</td><td>${data[i].email}</td></tr>`
            
              }
            body+="</table>"
            document.getElementById('solution4').innerHTML = body
            }else{
              $('#solution4').html("<div class='error'>"+"<?php echo $lang['grupos-notsuppliers'];?>"+"</div>")

            }
            
            //console.log(body)
        }
 }


function ReadSolution(code){


let url  = "./api/mysql_jsonESP_OEM_ALL.php?carid="+document.getElementById("carid").value+"&code="+code
$('#solution3').html('<br/> <div class="loading"><img src="images/loader.gif" alt="loading" /><br/> <br/>Read solutions, One moment, please ...</div>').show()

      fetch(url)
          .then( response => response.json() )
          .then( data => mostrarData(data) )
          .catch( error => console.log(error) )

      const mostrarData = (data) => {
          console.log(data)
          if (data.length >0){
          let body = ""
          for (var i = 0; i < data.length; i++) {      
            document.getElementById('solution3').innerHTML+="<div class='b'>"+code+"          "+data[i].M2+"    "+data[i].OEM+"</div>"
             // body+=`<tr><td>${data[i].id}</td><td>${data[i].name}</td><td>${data[i].email}</td></tr>`
          
            }
         
          }else{
            document.getElementById('solution3').innerHTML+="<div class='error'>" +code+"  "+"<?php echo $lang['grupos-notreference']; ?>"+"</div>"

          }
          
          
      }
}


 function ALLsolution(){
  //const codes = ["P0100", "P0200", "P0560"];
  const trama_code="P0"
  Clear_solutions()
  $card="<table>"
  for (let z=1; z<10 ; z++){  
     for (let i=0; i<10 ; i++){
        for (let j=0; j<10 ; j++){
            //console.log(trama_code+z+i+j);
               ReadSolution(trama_code+z+i+j) 
            

          }
        }
      }
}


function Clear_solutions() {
      $card=""
      $texte=""
      document.getElementById("solution").innerHTML =""
      document.getElementById("solution2").innerHTML =""
      document.getElementById("solution5").innerHTML =""
      document.getElementById("solution3").innerHTML =""
      document.getElementById("solution4").innerHTML =""
      document.getElementById("t_solution").innerHTML =""
      document.getElementById("t_solution3").innerHTML =""
      document.getElementById("t_solution4").innerHTML =""
     
    }

function ClearT(){
  document.getElementById("solutionT").innerHTML =""

}
function ClearEuro2td(){
  document.getElementById("euro2td").innerHTML =""
  document.getElementById("euro2td2").innerHTML =""
  document.getElementById("euro2td3").innerHTML ="" 
  document.getElementById("euro2tdSupliers").innerHTML =""
  document.getElementById("euro2tdean").innerHTML =""

}



function solutionT(){

  let url = "./api/mysql_jsonESP_T2.php?carid="+document.getElementById("carid").value+"&code="+document.getElementById("codeT").value+"&lang=<?php echo $lang['grupos-lang'] ?>"
  $('#solutionT').html('<br/> <div class="loading"><img src="images/loader.gif" alt="loading" /><br/> <br/>Read suppliers, One moment, please ...</div>').show()

        fetch(url)
            .then( response => response.json() )
            .then( data => mostrarData(data) )
            .catch( error => console.log(error) )

        const mostrarData = (data) => {
            console.log(data)
            if (data.length >0){
              let body ="";
           // let body = "<table></br>"
           
            for (var i = 0; i < data.length; i++) {      
               //body+="<tr><td class='t100'><a id='listDesignation' href='#' onclick='ListDesignation("+data[i].id+");return false;'>"+data[i].designation+"</td></tr>"
               // body+=`<tr><td>${data[i].id}</td><td>${data[i].name}</td><td>${data[i].email}</td></tr>`
               body+="<div class='b'><a id='listDesignation' href='#' onclick='listRefEuro("+data[i].id+");return false;'>"+data[i].designation+"</div>"

              }
            body+="</table>"
            document.getElementById('solutionT').innerHTML = body
            }else{
              $('#solutionT').html("<div class='error'>"+"<?php echo $lang['grupos-notsuppliers'];?>"+"</div>")

            }
            
            //console.log(body)
        }
}

function listRefEuro(designation){

let url = "./api/mysql_jsonESP_T.php?carid="+document.getElementById("carid").value+"&code="+designation+"&lang=<?php echo $lang['grupos-lang'] ?>"
$('#solutionT').html('<br/> <div class="loading"><img src="images/loader.gif" alt="loading" /><br/> <br/>Read database, One moment, please ...</div>').show()

      fetch(url)
          .then( response => response.json() )
          .then( data => mostrarData(data) )
          .catch( error => console.log(error) )

          const mostrarData = (data) => {
          console.log(data)
          if (data.length >0){
          let body = ""
           //body+="<?php echo $lang['grupos-trecomended'];?>";
          for (var i = 0; i < data.length; i++) {   
            //$oem =data[i].OENbr
            $ref_euro=data[i].reference
            $desc=data[i].libelle
            $prix=data[i].prix
            $familia=$ref_euro.substring(0,3).toLowerCase()
            $ref_euro2=$ref_euro.toLowerCase()
            $partes=data[i].partes
            //console.log($partes)

            //body+="<div class='b'>"+$partes+"</div>"
             
            body+="<div class='card' style='width:250px'>"
            body+="<img class='shadow' src='http://blog.euro4x4parts.com/photos/"+ $familia + "/" + $ref_euro2 + "z.jpg'  class='card-img-top' style='width:250px'>"
            body +="<div class='card-body'>"
            body+="<h5 class='card-title'>"+$ref_euro+"</h5>"
            body+="<p class='card-text'>"+$desc+"</p>"
            body+="<a href='#' class='btn btn-primary'>+ Buy "+$prix+"€</a></div></div>"
               
          
            }
          //body+="</table>"
          document.getElementById('solutionT').innerHTML = body
         // document.getElementById('solution5').innerHTML = "Spare part solution: "+$partes
          }else{
            $('#solutionT').html("<div class='error'>"+"<?php echo $lang['grupos-notparts'];?>"+"</div>")

          }
          
          //console.log(body)
      }

}


function euro2td(){


 
 $('#euro2td').html('<br/> <div class="loading"><img src="images/loader.gif" alt="loading" /><br/> <br/>Search Family references, One moment, please ...</div>').show()
 euro2tdOEM() 
 euro2tdall()  
 euro2tdSupliers2()
 euro2tdean()
let url  = "./api/mysql_jsonEuro2td.php?carid="+document.getElementById("carid").value+"&code="+document.getElementById("family").value

    // fetch(url,{mode: 'cors', headers: {'Access-Control-Allow-Origin': '*'}})
    fetch(url)
         .then( response => response.json() )
         .then( data => mostrarData(data) )
         .catch( error => console.log(error) )

     const mostrarData = (data) => {
         console.log(data)
         if (data.length >0){
         let body = ""
         // body+="<?php echo $lang['grupos-trecomended'];?>";
         for (var i = 0; i < data.length; i++) {   
           //$oem =data[i].OENbr
           $ref_euro=data[i].reference
           $desc=data[i].libelle
           $prix=data[i].prix
           $familia=$ref_euro.substring(0,3).toLowerCase()
           $ref_euro2=$ref_euro.toLowerCase()
           //$partes=data[i].partes
           
            
           body+="<div class='card' style='width:300px'>"
           body+="<img src='http://blog.euro4x4parts.com/photos/"+ $familia + "/" + $ref_euro2 + "z.jpg'  class='card-img-top' style='width:300px'>"
           body +="<div class='card-body'>"
           body+="<h5 class='card-title'>"+$ref_euro+"</h5>"
           body+="<p class='card-text'>"+$desc+"</p>"
           body+="<a href='#' class='btn btn-primary'>+ Buy "+$prix+"€</a></div></div>"
              
         
           }
        
         document.getElementById('euro2td').innerHTML = body
        
         }else{
           $('#euro2td').html("<div class='error'>"+"<?php echo $lang['grupos-notparts'];?>"+"</div>")

         }
         
         
     }

   




}


function euro2tdOEM(){

  $('#euro2td2').html('<br/> <div class="loading"><img src="images/loader.gif" alt="loading" /><br/> <br/>Search  OEM references, One moment, please ...</div>').show()

let url  = "./api/mysql_jsonEuro2tdOEM.php?carid="+document.getElementById("carid").value+"&code="+document.getElementById("family").value

      fetch(url)
          .then( response => response.json() )
          .then( data => mostrarData(data) )
          .catch( error => console.log(error) )

      const mostrarData = (data) => {
          console.log(data)
          if (data.length >0){
          let body = "</br><table>"
          for (var i = 0; i < data.length; i++) {   
           
             body+="<tr><td class='t20'>"+data[i].M2+"&nbsp;&nbsp;&nbsp;&nbsp;"+data[i].OEM+"</td></tr>"  
          
            }
          body+="</table>"
          document.getElementById('euro2td2').innerHTML = body
          }else{
            $('#euro2td2').html("<div class='error'>"+"<?php echo $lang['grupos-notreference'];?>"+"</div>")

          }
          
          
      }
      
          
}


function euro2tdall(){



 $('#euro2td3').html('<br/> <div class="loading"><img src="images/loader.gif" alt="loading" /><br/> <br/>Search all Families, One moment, please ...</div>').show()

let url  = "./api/mysql_jsonEuro2td2.php?carid="+document.getElementById("carid").value+"&code="+document.getElementById("family").value

    // fetch(url,{mode: 'cors', headers: {'Access-Control-Allow-Origin': '*'}})
    fetch(url)
         .then( response => response.json() )
         .then( data => mostrarData(data) )
         .catch( error => console.log(error) )

     const mostrarData = (data) => {
         console.log(data)
         if (data.length >0){
         let body = ""
         // body+="<?php echo $lang['grupos-trecomended'];?>";
         for (var i = 0; i < data.length; i++) {   
           //$oem =data[i].OENbr
           $ref_euro=data[i].reference
           $desc=data[i].libelle
           $prix=data[i].prix
           $familia=$ref_euro.substring(0,3).toLowerCase()
           $ref_euro2=$ref_euro.toLowerCase()
           //$partes=data[i].partes
           
            
           body+="<div class='card' style='width:300px'>"
           body+="<img src='http://blog.euro4x4parts.com/photos/"+ $familia + "/" + $ref_euro2 + "z.jpg'  class='card-img-top' style='width:300px'>"
           body +="<div class='card-body'>"
           body+="<h5 class='card-title'>"+$ref_euro+"</h5>"
           body+="<p class='card-text'>"+$desc+"</p>"
           body+="<a href='#' class='btn btn-primary'>+ Buy "+$prix+"€</a></div></div>"
              
         
           }
        
         document.getElementById('euro2td3').innerHTML = body
        
         }else{
           $('#euro2td3').html("<div class='error'>"+"<?php echo $lang['grupos-notparts'];?>"+"</div>")

         }
         
         
     }

     
}
function euro2tdSupliers2(){
  $('#euro2tdSupliers').html('<br/> <div class="loading"><img src="images/loader.gif" alt="loading" /><br/> <br/>Read suppliers, One moment, please ...</div>').show()

            $.get("cref2.php", {grupo:document.getElementById("family").value, carid: document.getElementById("carid").value,name: 'ddd'}, function(data) {
                $("#euro2tdSupliers").html(data);
            });	




}

function euro2tdean(){

  document.getElementById('euro2tdean').innerHTML =""
let url = "./api/mysql_jsonEuro2tdean.php?carid="+document.getElementById("carid").value+"&code="+document.getElementById("family").value
//$('#euro2tdean').html('<br/> <div class="loading"><img src="images/loader.gif" alt="loading" /><br/> <br/>Read suppliers, One moment, please ...</div>').show()

      fetch(url)
          .then( response => response.json() )
          .then( data => mostrarData(data) )
          .catch( error => console.log(error) )

      const mostrarData = (data) => {
          
          if (data.length >0){
          let body = "<table></br>"
          for (var i = 0; i < data.length; i++) {      
             //body+="<tr><td  class='t50'>"+data[i].EAN+"</td></tr>"
             //body+="<tr><td>"+data[i].criteria+"</td><td>"+data[i].value+"</td><td>"+data[i].unit+"</td></tr>"
             //body+=euro2tdSupliersLegacy(data[i].legacy)
             euro2tdean222(data[i].EAN)

            }
          body+="</table>"
          //document.getElementById('euro2tdean').innerHTML = body
          }else{
           // $('#euro2tdean').html("<div class='error'>"+"<?php echo $lang['grupos-notsuppliers'];?>"+"</div>")

          }
          
          //console.log(body)
      }
}



  function euro2tdean222(ean)
  {
    $.post("ean.php", {ean: ean}, function(data) {
                /*body=$("#euro2tdean").html()+data;
                $("#euro2tdean").html(body);*/
                document.getElementById('euro2tdean').innerHTML +=data;


  })
  }


</script>
