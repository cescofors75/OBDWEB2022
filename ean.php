<?php
session_start();
$ean=$_POST['ean'];
$api_key = '';
$url = 'https://api.barcodelookup.com/v3/products?barcode='.$ean.'&formatted=y&key=' . $api_key;

$ch = curl_init(); // Use only one cURL connection for multiple queries

$data = get_data($url, $ch);

$response = array();
$response = json_decode($data);
echo '<table>';
if ($response){
// echo '<strong>Barcode Number:</strong> ' . $response->products[0]->barcode_number . '<br><br>';

echo '<tr><td class="menu"><strong>Title:</strong> ' . $response->products[0]->title . '</td></tr>';
echo '<tr><td class="menu"><strong></strong><img  src=" ' . $response->products[0]->images[0] . '" width="150px"></td></tr>';
echo '<tr><td class="menuM"><strong>Stores:</strong> ' . count($response->products[0]->stores) . '</td></tr>';

echo '<tr><td>----------------------------------------------------------------------------------------------</td></tr>';

$decoded_json = json_decode($data,true);
$name = $decoded_json['products'][0]['stores'];
/*$stores=count($response->products[0]->stores);
for ($i=0;$i<$stores;$i++){*/
  $i=(count($name));
  for ($j=0; $j < $i; $j++) {

    $base_price = (float)$name[$j]['price'];
    //
    $EUR_price =round($base_price,2);
    if ($name[$j]['country'] !='EU'){
      if ($name[$j]['country'] ==='GB'){
        
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
      for ($j=0; $j < $i; $j++) {
      
      echo '<tr><td class="criteriaM"><strong>Name:</strong> ' . $name[$j]['name']. '</td></tr>';
      echo '<tr><td class="criteriaM"><strong>Country:</strong> ' . $name[$j]['country'] . '</td></tr>';
      echo '<tr><td class="criteriaM"><strong>Price:</strong> ' . $name[$j]['price'] ;
      echo      $name[$j]['currency_symbol']. ' === '.$name[$j]['eprice'].'€</td></tr>';
      echo '<tr><td class="criteriaM"><strong>Link:</strong> <a href=" ' . $name[$j]['link'] . '" >'. $name[$j]['link'] .'</td></tr>';
      echo '<tr><td class="criteria"><strong>Update:</strong> ' . $name[$j]['last_update'] . '</td></tr>';
      echo '<tr><td>----------------------------------------------------------------------------------------------</td></tr>';
      }
      }
      
      echo '</table>';




function get_data($url, $ch) {
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}
