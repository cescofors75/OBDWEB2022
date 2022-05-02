<?php  $names = unserialize($_GET['names']);$marks = unserialize($_GET['marks']);
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
    Chart.defaults.global.defaultFontSize = 18;
    const DATA_COUNT = 7;
    const NUMBER_CFG = {count: DATA_COUNT, min: -100, max: 100};



    var densityData = {
     
      label: 'Comparative Price (€)',
      <?php
        
          
        echo 'data: '.json_encode($marks).','; ?>
      
      backgroundColor: 'rgba(0, 99, 132, 0.6)',
      borderColor: 'rgba(0, 99, 132, 1)',
      borderWidth: 2,
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