


<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">




<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<!--<script src="https://code.jquery.com/jquery-3.2.1.js"></script>-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>-->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="estilos_wp.css">

<style>



</style>
</head>
<body>



<div class='container'> <!-- info car -->


<?php
$html = '';

$conexion = new mysqli('localhost', 'root','' , 'td2q2019');
$carid = $_POST['id_grupos'];


$conexion->query("SET CHARACTER SET utf8");
$conexion->query("SET NAMES utf8");
$result = $conexion->query("SELECT manuName,modelName,typeName,yearOfConstrFrom,yearOfConstrTo FROM vehicledetails WHERE carId=$carid  ");


if ($result->num_rows > 0) {
  $html .="<div class='b' >";
    $html .="<h2><b>INFO</b></h2>";
    
    while ($row = $result->fetch_assoc()) {                
        $html .=  $row['manuName'] . " / ". $row['modelName'] .  " / ". $row['typeName'] . "*" ; 
        $html .=  $row['yearOfConstrFrom'] . " / ". $row['yearOfConstrTo'] . "<br>" ; 
    }
    $html .= "</div><br>";
} 

echo($html);
$html="";
?>





<input type=hidden id=carid value='<?php  echo $carid; ?>'/>   <!-- menu options & solutions -->



  <div class='r'>Options: Example P0201, P0255, P0100 </div>
  <div class='b' >Enter CODE&nbsp; <input type="text" id="code" name="fname" value="P0560" >&nbsp; 
  <button type="button" onclick="solution()" class="btn btn-primary btn-lg">SOLUTION</button> &nbsp; <button type="button" onclick="ALLsolution()" class="btn btn-primary btn-lg">ALL SOLUTION</button>&nbsp;&nbsp;<button type="button" onclick="Clear_solutions()" class="btn btn-primary btn-lg">Clear Solutions</button></td></tr>
   
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

$result = $conexion->query("SELECT shortCutId,shortCutName FROM `shortcuts` where lang='en' and linkingTargetType='P' order by shortCutName");



if ($result->num_rows > 0) {
  $html .="</br><div class='b'>";
    $html .="CATALOGUE</div></br><div class='container'><table><tr>";
    $i=0;
    while ($row = $result->fetch_assoc()) {   
        if ($i < 4){
                      
        $html .= "<td class='menu'><div><img src='../images/images_sections/". $row['shortCutId'] .".png' width='80' ></br><a href='recursive2.php?carid=".$carid."&grupo=". $row['shortCutId'] . "'>". $row['shortCutName'] .   "</a></div></td>" ; 
        $i++;  
      }else {
       $i=0;
       $html .= "<td class='menu'><div><img src='../images/images_sections/". $row['shortCutId'] .".png' width='80' ></br><a href='recursive2.php?carid=".$carid."&grupo=". $row['shortCutId'] . "'>". $row['shortCutName'] .   "</a></td></div></tr><tr>" ; 
      }
    }
    $html .="<td class='menu'></td><td class='menu'></td><td class='menu'></td></tr></div></div>";
} 








echo $html;
$html="";

?>






</body>
<script>
var $card=""
var $texte=""


function solution(){

 var $partes=""

  document.getElementById('t_solution').innerHTML="Solution Euro4x4" 
  document.getElementById('t_solution3').innerHTML="References OEM" 
  document.getElementById('t_solution4').innerHTML="References Suppliers" 

let url  = "http://localhost/mysql_jsonESP.php?carid="+document.getElementById("carid").value+"&code="+document.getElementById("code").value
$('#solution').html('<br/> <div class="loading"><img src="images/loader.gif" alt="loading" /><br/> <br/>Read database solutions </br>One moment, please ...</div>').show()

      fetch(url)
          .then( response => response.json() )
          .then( data => mostrarData(data) )
          .catch( error => console.log(error) )

      const mostrarData = (data) => {
          console.log(data)
          if (data.length >0){
          let body = ""
           body+="</br><div class='b'>Recommended solutions:</div><div class='b'> -Check the electrical wiring and connectors, related to the code</div><div class='b'> -Verify there is no corrosion, or water in the sensor / related spare part</div><div class='b'> -Replace the following spare part:</div></br>"
          for (var i = 0; i < data.length; i++) {   
            $oem =data[i].OENbr
            $ref_euro=data[i].REF_EURO
            $desc=data[i].libelleproduit
            $prix=data[i].prixeuroht
            $familia=$ref_euro.substring(0,3).toLowerCase()
            $ref_euro2=$ref_euro.toLowerCase()
            $partes=data[i].partes
            //console.log($partes)

            body+="<div class='b'>"+$partes+"</div>"
             
            body+="<div class='card' style='width:300px'>"
            body+="<img src='http://blog.euro4x4parts.com/photos/"+ $familia + "/" + $ref_euro2 + "z.jpg'  class='card-img-top' style='width:300px'>"
            body +="<div class='card-body'>"
            body+="<h5 class='card-title'>"+$ref_euro+" - "+$oem+"</h5>"
            body+="<p class='card-text'>"+$desc+"</p>"
            body+="<a href='#' class='btn btn-primary'>+ Buy "+$prix+"€</a></div></div>"
               
          
            }
          //body+="</table>"
          document.getElementById('solution').innerHTML = body
         // document.getElementById('solution5').innerHTML = "Spare part solution: "+$partes
          }else{
            $('#solution').html("<div class='error'>Not Parts !!!!</div>")

          }
          
          //console.log(body)
      }

 solution_error()     
}





 function solution_error(x){

let url  = "http://localhost/mysql_json3.php?CODIGO='"+document.getElementById("code").value+"'"
$('#solution2').html('<br/> <div class="loading"><img src="images/loader.gif" alt="loading" /><br/> <br/>Read database codes, One moment, please ...</div>').show()
console.log(x)

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
            $('#solution2').html("<div class='error'>Not CODE !!!!</div>")

          }
          
          //console.log(body)
      }

      solution3_OEM()   
}







 

 function solution3_OEM(){


let url  = "http://localhost/mysql_jsonESP_OEM.php?carid="+document.getElementById("carid").value+"&code="+document.getElementById("code").value
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
           
             body+="<tr><td class='t100'>"+data[i].M2+"</td><td>"+data[i].OEM+"</td></tr>"  
          
            }
          body+="</table>"
          document.getElementById('solution3').innerHTML = body
          }else{
            $('#solution3').html("<div class='error'>Not reference OEM !!!!</div>")

          }
          
          //console.log(body)
      }

 solution4_supliers()     
}




 function solution4_supliers(){


  let url = "http://localhost/mysql_jsonESP_SUPLIERS.php?carid="+document.getElementById("carid").value+"&code="+document.getElementById("code").value
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
               body+="<tr><td class='t100'><img src='../images/images_supplier_logos/"+data[i].logo+".png' width='80'></td><td>"+data[i].name+"</td><td>"+data[i].number+"</td></tr>"
               // body+=`<tr><td>${data[i].id}</td><td>${data[i].name}</td><td>${data[i].email}</td></tr>`
            
              }
            body+="</table>"
            document.getElementById('solution4').innerHTML = body
            }else{
              $('#solution4').html("<div class='error'>Not reference Supplier !!</div>")

            }
            
            //console.log(body)
        }
 }


function ReadSolution(code){


let url  = "http://localhost/mysql_jsonESP_OEM_ALL.php?carid="+document.getElementById("carid").value+"&code="+code
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
          //body+="</table>"
          //document.getElementById('solution3').innerHTML += body
          }else{
            document.getElementById('solution3').innerHTML+="<div class='error'>" +code+"  "+"Not reference OEM !!</div>"
           // $('#solution3').html(body+"<div style='padding: 5px;background:red; font-size:16px;color:white;'>Not reference OEM !!</div>")

          }
          
          //console.log(body)
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

</script>

