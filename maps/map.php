<html>
  <head>
    <title>Geocoding Service</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDH8EOaUJxu-Vy2sjDVAbPh_SL0nNc52WM"> </script>
    <link rel="stylesheet" type="text/css" href="./style.css" />
    <script  src="./index.js"></script>
    <style>

#map_canvas {
  height: 100%;
  width: 100%;
  margin: 0px;
  padding: 0px
}
    </style>
  </head>
  <body>



<div id="map_canvas" style="border: 2px solid #3872ac;"></div>

<?php
$html = '';
set_time_limit(300);
$conexion = new mysqli('localhost', 'root','' , 'td2q2019');



$conexion->query("SET CHARACTER SET utf8");
$conexion->query("SET NAMES utf8");
$result = $conexion->query("Select DISTINCT ambrandsaddress.brandId as brandId, ambrandsaddress.wwwURL as wwwURL, ambrandsaddress.city as city, ambrandsaddress.street as street, ambrandsaddress.name as name from ambrand inner join ambrandsaddress on ambrand.brandId=ambrandsaddress.brandId LIMIT 5");


if ($result->num_rows > 0) {
  ?><script>
    var loca = [];<?php
    
    while ($row = $result->fetch_assoc()) { 
      $str=str_replace("'","",$row['street']).','.$row['city'];
      ?>loca.push(['<?php echo($row['name']) ?>','<?php echo($str)?>','<?php echo($row['wwwURL']) ?>','<?php echo($row['brandId']) ?>']);<?php


    }
    
    mysqli_free_result($result); 
} 

//echo($html);


?>

console.log(loca)
locations2(loca)

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}



function locations2(locations){

    
      
var geocoder;
var map;
var bounds = new google.maps.LatLngBounds();
console.log(locations);
async function initialize() {
  map = new google.maps.Map(
    document.getElementById("map_canvas"), {
      center: new google.maps.LatLng(37.4419, -122.1419),
      zoom: 13,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });
  geocoder = new google.maps.Geocoder();
   
  for (i = 0; i < locations.length; i++) {


    geocodeAddress(locations, i);
    await sleep(1000);
  }
}





google.maps.event.addDomListener(window, "load", initialize);

function geocodeAddress(locations, i) {
  var title = locations[i][0];
  var address = locations[i][1];
  var img = locations[i][3];
  var url = locations[i][2];
  var img = {url:'../admin/suppliers_logos/png/'+locations[i][3]+'.png',
    scaledSize: new google.maps.Size(50, 50),
    
  };
  geocoder.geocode({
      'address': locations[i][1]
    },

    function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        var marker = new google.maps.Marker({
          //icon: 'http://maps.google.com/mapfiles/ms/icons/blue.png',
          icon: img,
          map: map,
          position: results[0].geometry.location,
          title: title,
          animation: google.maps.Animation.DROP,
          address: address,
          url: url
        })
        infoWindow(marker, map, title, address, url);
        bounds.extend(marker.getPosition());
        map.fitBounds(bounds);
      } else {
        alert("geocode of " + address + " failed:" + status);
      }
    });
}

function infoWindow(marker, map, title, address, url) {
  google.maps.event.addListener(marker, 'click', function() {
    var html = "<div><h3>" + title + "</h3><p>" + address + "<br></div><a href='" + url + "'>View location</a></p></div>";
    iw = new google.maps.InfoWindow({
      content: html,
      maxWidth: 350
    });
    iw.open(map, marker);
  });
}

function createMarker(results) {
  var marker = new google.maps.Marker({
    icon: 'http://maps.google.com/mapfiles/ms/icons/blue.png',
    map: map,
    position: results[0].geometry.location,
    title: title,
    animation: google.maps.Animation.DROP,
    address: address,
    url: url
  })
  bounds.extend(marker.getPosition());
  map.fitBounds(bounds);
  infoWindow(marker, map, title, address, url);
  return marker;
}

}

</script>
</body>
</html>




