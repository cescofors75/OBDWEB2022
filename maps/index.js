






function xy(){



    var loca = [];
   let url  = "../api/mysql_jsonAmbrand.php";
   
       // fetch(url,{mode: 'cors', headers: {'Access-Control-Allow-Origin': '*'}})
       fetch(url)
            .then( response => response.json() )
            .then( data => mostrarData(data) )
            .catch( error => console.log(error) )
   
        const mostrarData = (data) => {
            //console.log(data)
            if (data.length >0){
                
            // body+="<?php echo $lang['grupos-trecomended'];?>";
            for (var i = 0; i < data.length; i++) {   
              let name =data[i].name
              //$street=data[i].street+','+data[i].city
              let street=data[i].city

             let url=data[i].wwwURL
              //$prix=data[i].prix
              //$familia=$ref_euro.substring(0,3).toLowerCase()
              //$ref_euro2=$ref_euro.toLowerCase()
              //$partes=data[i].partes
              loca.push([name, street,  url]);


              }
              console.log(loca)
              //
           
            }
            
            
        }
         
        locations2(loca)     
   }



function x(){
/*
    var loca = [
        ['Location 1 Name', 'C.so Matteotti 13,	Luserna San Giovanni', 'Location 1 URL'],
        ['Location 2 Name', 'lloret de mar', 'Location 2 URL'],
        ['Location 3 Name', 'berlin', 'Location 3 URL']
      ];*/
    var loca = [];
    

      loca.push(['Location 4 Name', 'C.so Matteotti 13,	Luserna San Giovanni', 'Location 4 URL']);
      loca.push(['Location 5 Name', 'Via albertini 36,	Ancona', 'Location 5 URL']);
      loca.push(['HELLA', 'Lippstadt', 'http://www.hella.de']);
      console.log(loca)
      locations2(loca)
}





function locations2(locations){

    
      
      var geocoder;
      var map;
      var bounds = new google.maps.LatLngBounds();
      console.log(locations);
      function initialize() {
        map = new google.maps.Map(
          document.getElementById("map_canvas"), {
            center: new google.maps.LatLng(37.4419, -122.1419),
            zoom: 13,
            mapTypeId: google.maps.MapTypeId.ROADMAP
          });
        geocoder = new google.maps.Geocoder();
      
        for (i = 0; i < locations.length; i++) {
      
      
          geocodeAddress(locations, i);
        }
      }
      google.maps.event.addDomListener(window, "load", initialize);
      
      function geocodeAddress(locations, i) {
        var title = locations[i][0];
        var address = locations[i][1];
       
        var url = locations[i][2];
        geocoder.geocode({
            'address': locations[i][1]
          },
      
          function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
              var marker = new google.maps.Marker({
                icon: 'http://maps.google.com/mapfiles/ms/icons/blue.png',
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

