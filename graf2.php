 <?php  
 
 $names = unserialize($_GET['names']);$marks = unserialize($_GET['marks']);
//var_dump($names);

 ?>
<head>                
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>                     
            
  </head>
    <body>
    <canvas id="densitydouble" width="600" ></canvas>
   
    
    </body>
    
     



         <script>
        
    const data = {
      <?php
        
          
         // echo 'labels: '.json_encode($names).','; 
         echo 'labels: ['; 
      
         for ($i=1; $i<count($marks)-1; $i++){
           
           echo json_encode($names[$i]).',';
           
           
         }
         
        $i2 = count($marks)-1;
         echo json_encode($names[$i2]).'],';
   
          
         ?>
        






      datasets: [{
        label: 'Stores €',
        backgroundColor: 'rgba(199, 0, 0, 0.6)',
        borderColor: 'rgba(199, 0, 0, 0.6)',
        //data: [0, 10, 5, 2, 20, 30, 45],
        <?php
        
          
        //echo 'data: '.json_encode($marks).','; 
        echo 'data: ['; 
      
      for ($i=1; $i<count($marks)-1; $i++){
        
        echo $marks[$i].',';
        
        
      }
      $i2 = count($marks)-1;

      echo json_encode($marks[$i2]).'],';

       
      ?>
      
        
        order: 1
      },
      {
        label: 'Euro4x4parts €',
        backgroundColor: 'rgba(0, 99, 132, 1)',
        borderColor: 'rgba(0, 99, 132, 1)',
        //data: [10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10],
        <?php
        
          
        echo 'data: ['; 
      
      for ($i=1; $i<count($marks); $i++){
        
        echo $marks[0].',';
        
        
      }
      

      echo json_encode($marks[0]).'],';

       
      ?>
      

        type: 'line',
        order: 0
    }] 
  };    

const config = {
  type: 'bar',
  data: data,
  options: {
    responsive: true,
    plugins: {
      legend: {
        position: 'top',
      },
      title: {
        display: true,
        text: 'Chart comparative Euro4x4parts and Stores'
      }
    }
  },
};  
 
var densityCanvas = document.getElementById("densitydouble");
   
var barChart = new Chart(densityCanvas,config); 
</script>