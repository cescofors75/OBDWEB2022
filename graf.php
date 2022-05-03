 <?php  
 
 $names = unserialize($_GET['names']);$marks = unserialize($_GET['marks']);
//var_dump($names);

 ?>
<head>                
    <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js'></script>  
                           
            
  </head>
    <body>
   
    <canvas id="densityChart" width="600" ></canvas>
    
    </body>
    
    <script>
    var densityCanvas = document.getElementById("densityChart");
    
    Chart.defaults.global.defaultFontFamily = "Lato";
    Chart.defaults.global.defaultFontSize = 14;
   



    var densityData = {
     
      label: 'Euro4x4parts (€)',
      <?php
        
          
        echo 'data: '.json_encode($marks).','; ?>
      
      backgroundColor: [
        'rgba(0, 99, 132, 0.6)',
      
      <?php
      for ($i=1; $i<count($names); $i++){
        if ($marks[$i]<$marks[0]){
        echo json_encode('rgba(199, 0, 0, 0.6)').',';
        }else{
        echo json_encode('rgba(0, 199, 0, 0.6)').',';
        } 
        
      }
      

      echo json_encode('rgba(0, 255, 0, 0.6)');

       
      ?>
      ],
      borderColor: [
        'rgba(0, 99, 132, 1)',
      <?php
      for ($i=1; $i<count($names); $i++){
        
        echo json_encode('rgba(0, 0, 0, 1)').',';
      }
      echo json_encode('rgba(0, 0, 0, 1)');
      ?>
      ],
      borderWidth: 0,
      hoverBorderWidth: 0,
      
    
   
      };
    
    var chartOptions = {
      scales: {
        yAxes: [{
          barPercentage: 0.5
        }]
      },
      elements: {
        rectangle: {
          borderSkipped: 'left',
        }
      }
    };
    
    var barChart = new Chart(densityCanvas, {
      type: 'bar',
      data: {
        
        <?php
        
          
          echo 'labels: '.json_encode($names).','; ?>
        datasets: [densityData],
      },
      options: chartOptions
    });
    


     </script> 

