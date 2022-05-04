
<?php
session_start();
$reuro=$_POST['reuro'];

$api_key = 'l1sb4dr7rnng4ftxp41smz54soubg2';
$conexion = new mysqli('localhost', 'root','' , 'td2q2019');

$conexion->query("SET CHARACTER SET utf8"); 
                        $conexion->query("SET NAMES utf8");
                        $result = $conexion->query(
                          "SELECT distinct europroducts.reference as ref, europroducts.libelleproduit AS description, europroducts.prixeuroht as prix , oemnumbers.legacyArticleId as legacy, articleean.eancode as ean 
                          FROM `eurocrossref` INNER JOIN europroducts ON europroducts.reference=eurocrossref.REF_EURO inner join oemnumbers on oemnumbers.articleNumber=eurocrossref.REF_FRN 
                          inner join articleean on articleean.legacyArticleId=oemnumbers.legacyArticleId WHERE REF_EURO='".$reuro."' ");
                      

                        

                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $familia=strtolower(substr($row['ref'],0,3));
                            $ref_euro2=strtolower($row['ref']);

                            echo "<table><tr><td style='width:100px;'>".$row['ref']."</td><td style='width:100px;'><div><img class='shadow' src='http://blog.euro4x4parts.com/photos/". $familia . "/" . $ref_euro2 . "z.jpg'   style='width:80px'"
                            ?>
                            onerror="this.onerror=null;this.src='./images/no_image.jpg';" /></div>
                            
                            <?php
                          
                            echo '</td>';
                            echo '<td style="width:200px;">' . $row['description'] . '</td>';
                            echo '<td style="width:100px;"> ' . $row['prix'] . '€</td>';
                          
                            
                            $store_ok=false;
                            while (($row = $result->fetch_assoc())and !$store_ok)  {                
                               
                           
                              
$url = 'https://api.barcodelookup.com/v3/products?barcode='.$row['ean'].'&formatted=y&key=' . $api_key;

$ch = curl_init(); // Use only one cURL connection for multiple queries

$data = get_data($url, $ch);

$response = array();
$response = json_decode($data);

if ($response){
  $store_ok=true;
  echo '<td style="width:100px">';

echo '<strong>Stores:</strong> ' . count($response->products[0]->stores) . '</td>';



//$stores=count($response->products[0]->stores);
$prix_temp=str_replace(".","",$row['prix']);
$prix=str_replace(",",".",$prix_temp);

//for ($i=0;$i<$stores;$i++){

  $decoded_json = json_decode($data,true);
  $name = $decoded_json['products'][0]['stores'];

  $i=(count($name));
  for ($j=0; $j < $i; $j++) {
    $base_price = (float)$name[$j]['price'];
    //
    $EUR_price =round($base_price,2);
    if ($name[$j]['country'] !='EU'){

      if ($name[$j]['country']==='GB'){
        
         $EUR_price = round(($base_price / $_SESSION['GBP']), 2);
         
      }
        if ($name[$j]['country'] ==='NO'){
    
          
          $EUR_price = round(($base_price / $_SESSION['NOK']), 2);
          
        }
        if ($name[$j]['country'] ==='SE'){
    
            $EUR_price = round(($base_price / $_SESSION['SEK']), 2);
          }
          if ($name[$j]['country'] ==='DK'){
    
            
            $EUR_price = round(($base_price / $_SESSION['DKK']), 2);
          }
    
          if ($name[$j]['country'] ==='CA'){
    
            
            $EUR_price = round(($base_price / $_SESSION['CAD']), 2);
          }
          if ($name[$j]['country'] ==='US'){
    
            
            $EUR_price = round(($base_price / $_SESSION['USD']), 2);
          }
          if ($name[$j]['country'] ==='PL'){
    
            
            $EUR_price = round(($base_price / $_SESSION['PLN']), 2);
          }
    
           // Your price in USD
              
        }
        $name[$j]['eprice'] = $EUR_price;    

}

array_multisort(array_column($name, 'eprice'), SORT_ASC, $name);

$names=[];
$marks=[];
$marksC=[];
array_push($names,'E');
array_push($marks,$prix);

for ($j=0; $j < $i; $j++) {

  array_push($names,substr($name[$j]['name'],0,1));
  array_push($marks,$name[$j]['eprice']);



}
for ($j=1; $j < $i; $j++) {

  
  array_push($marksC,$name[$j]['eprice']);



}

$min= min($marksC);
$max= max($marksC);
$avg= array_sum($marksC)/count($marksC);



//var_dump ($names);
$names2 = serialize($names);
$names2 = urlencode($names2);
$marks2 = serialize($marks);
$marks2 = urlencode($marks2);

//echo '<td style="width:50%; background:green;">';

//echo '<iframe src="graf2.php?names='.$names2.'&marks='.$marks2.'"  width="25%" height="250px"   frameborder="0" scrolling="no"></iframe>';
//echo '<iframe src="graf.php?names='.$names2.'&marks='.$marks2.'"  width="70%"  height="250px"  frameborder="0" scrolling="no"></iframe></td>';

if ($prix<$min){
  echo '<td style="width:100px; background:green;"></td>';

}

if($prix>$min and $prix<$avg){
  echo '<td style="width:100px; background:yellow;"></td>';
}

if($prix>$avg and $prix<$max){
  echo '<td style="width:100px; background:orange;"></td>';
}
if($prix>$max){
  echo '<td style="width:100px; background:red;"></td>';
}


echo '<td style="width:400px; background:white;"><iframe src="graf.php?names='.$names2.'&marks='.$marks2.'"  width="90%"  height="200px"  frameborder="0" scrolling="no"></iframe></td>';




}}
mysqli_free_result($result); 
}
mysqli_close($conexion);
echo '</tr></table>'; 


function get_data($url, $ch) {
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}
  ?> 
   
                    
                               
                           
                           
                           
                           
                           
                           
                           
                          






















