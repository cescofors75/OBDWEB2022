var id_category2
$(document).ready(function(){
    $("#category").on('change', function () {
        $("#category option:selected").each(function () {
            var id_category = $(this).val();
             id_category2=$(this).val();
            $.post("subcategories.php", { id_category: id_category}, function(data) {
                $("#subcategory").html(data);
            });			
        });
   });

   $("#subcategory").on('change', function () {
        $("#subcategory option:selected").each(function () {
            var id_subcategory = $(this).val();
            //console.log(id_subcategory)
            $.post("ssubcategories.php", {id_subcategory: id_subcategory, id_category: id_category2}, function(data) {
                $("#ssubcategory").html(data);
            });			
        });
   });

   $("#ssubcategory").on('change', function () {
        $("#ssubcategory option:selected").each(function () {
            var id_grupos = $(this).val();
            $.post("grupos.php", { id_grupos: id_grupos}, function(data) {
                $("#grupos").html(data);
            });			
        });
   });

   

});





function sub_MAT(){


    var xmlhttp = new XMLHttpRequest();
    
    /*var url = "https://partsapi.ru/api?method=VINdecode&key=&vin="+document.getElementById("fname").value+"&lang=en";*/
    
    //var url ="http://localhost/2022/dgt.json";http://85.48.86.108/
    //var url ="http://192.168.1.32/soap/examples/soap-wsa-example.php?mat="+document.getElementById("fname2").value;
    var url ="http://85.48.86.108//soap/examples/soap-wsa-example.php?mat="+document.getElementById("fname2").value;
    $('#display').html('<br/> <div class="loading"><img src="images/loader.gif" alt="loading" /><br/> <br/>Read database plates, One moment, please ...</div>').show();
    
    
    xmlhttp.onreadystatechange = function() {
     if (this.readyState == 4 && this.status == 200) {
     var myArr = JSON.parse(this.responseText);
     console.log(myArr);
    
      myFunction(myArr);  
     }
     };
    
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
     
        
    function myFunction(array) {
    
      
      
    var marca=array.ResultadoInformeReducido.marca;
    var modelo=array.ResultadoInformeReducido.modelo;
    var fecha=array.ResultadoInformeReducido.fechaPrimeraMatricula;
    
    $mar= array.ResultadoInformeReducido.marca;
    //$num.replace(/\s+/g, '');
    $mar2=$mar.split(" ").join("");
    //texto.replace(/\s+/g, '') 
    //$num.trim();
    $modelo=array.ResultadoInformeReducido.modelo;
    $mod2=$modelo.trimEnd();
    
    $mod3= $mod2.substring(0, $mod2.indexOf(' '));
    $info=$mar2 + " - "+$mod2+" - "+fecha+" - "+$mod3;
    //$("#display").html($info);
    //$("#display").html($mod2.length);
    //$.post("grupos4.php", { marca: $mar2, modelo: $mod2, fecha:fecha}, function(data) {
    $.post("cars.php", { marca: $mar2, modelo: $mod3, fecha:fecha}, function(data) {
                $("#cars").html(data);
            });
    
    
    $("#display").html("");
    
    
     
    
    
    }
    
    };
    
    


    function sub_all(){
        //document.getElementById("vin_t").innerHTML = document.getElementById("fname").value;
        
        
        var xmlhttp = new XMLHttpRequest();
        //var url = "https://vpic.nhtsa.dot.gov/api/vehicles/decodevin/"+"1C4HJXEG2KW590992"+"?format=json";
        //https://vindecodervehicle.com/api/v1/?id=cescofors&key=n&vin=
        var url = "https://vpic.nhtsa.dot.gov/api/vehicles/decodevin/ "+ document.getElementById("fname").value + "?format=json";
        
        //var url ="https://vindecodervehicle.com/api/v1/?id=cescofors&key=&vin="+ document.getElementById("fname").value+"&getMoreData";
        
        
        xmlhttp.onreadystatechange = function() {
         if (this.readyState == 4 && this.status == 200) {
         var myArr = JSON.parse(this.responseText);
         console.log(myArr);
         //console.log(myArr.data.array[0].vehicleDetails.manuName);
         
         //console.log(myArr[data][array][0][vehicleDetails]);
          myFunction(myArr);  
         }
         };
        
        xmlhttp.open("GET", url, true);
        xmlhttp.send();
           //console.log (xmlhttp);
            
        function myFunction(array) {
         var salida = "<div class='container'>";
        
         //for(var i = 0; i <= array2.data.array[0].vehicleDetails.length; i++) {
             for(var i = 0; i < array.Results.length; i++) {
             if (array.Results[i].Value != null)  salida += array.Results[i].Variable  +": "+array.Results[i].Value +"<br/>";
             
        
            //console.log(array.Results[i].value);
         }
         salida+="</div>";
         document.getElementById("elements").innerHTML = salida;
        } 
        };   
        
        


    
 

function sub(){


    var xmlhttp = new XMLHttpRequest();
    
    var url = "https://partsapi.ru/api?method=VINdecode&key=&vin="+document.getElementById("fname").value+"&lang=en";
    $('#display').html('<br/><div class="container"> <div class="loading"><img src="images/loader.gif" alt="loading"/><br/> <br/>Decoder VIN. One moment, please ...</div></div>').show();
    
    
    xmlhttp.onreadystatechange = function() {
     if (this.readyState == 4 && this.status == 200) {
     var myArr = JSON.parse(this.responseText);
     //console.log(myArr);
    
      myFunction(myArr);  
     }
     };
    
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
       
        
    function myFunction(array) {
    
     var id_grupos = array.result[0].carId;
            $.post("grupos.php", { id_grupos: id_grupos}, function(data) {
                $("#grupos").html(data);
            });			
    
            $("#display").html("");
    } 
    
    
    
    };  
    
    
    
    
    
       





        function Clear() {
            document.getElementById("display").innerHTML ="";
            /* document.getElementById("grupos").innerHTML =""; 
            document.getElementById("cars").innerHTML =""; */
          } 

         
    
 
