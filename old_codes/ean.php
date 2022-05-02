<?php
session_start();
$ean=$_POST['ean'];
$api_key = 'l1sb4dr7rnng4ftxp41smz54soubg2';
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

$stores=count($response->products[0]->stores);
for ($i=0;$i<$stores;$i++){


    $base_price = (float)$response->products[0]->stores[$i]->price;
    //
    $EUR_price =round($base_price,2);
    if ($response->products[0]->stores[$i]->country !='EU'){
      if ($response->products[0]->stores[$i]->country ==='GB'){
        
         $EUR_price = round(($base_price / $_SESSION['GBP']), 2);
      }
        if ($response->products[0]->stores[$i]->country ==='NO'){
    
          
          $EUR_price = round(($base_price / $_SESSION['NOK']), 2);
          
        }
        if ($response->products[0]->stores[$i]->country ==='SE'){
    
            $EUR_price = round(($base_price / $_SESSION['SEK']), 2);
          }
          if ($response->products[0]->stores[$i]->country ==='DK'){
    
            
            $EUR_price = round(($base_price / $_SESSION['DKK']), 2);
          }
    
          if ($response->products[0]->stores[$i]->country ==='CA'){
    
            
            $EUR_price = round(($base_price / $_SESSION['CAD']), 2);
          }
          if ($response->products[0]->stores[$i]->country ==='US'){
    
            
            $EUR_price = round(($base_price / $_SESSION['USD']), 2);
          }
    
           // Your price in USD
                
        }









echo '<tr><td class="criteriaM"><strong>Name:</strong> ' . $response->products[0]->stores[$i]->name . '</td></tr>';
echo '<tr><td class="criteriaM"><strong>Country:</strong> ' . $response->products[0]->stores[$i]->country . '</td></tr>';
echo '<tr><td class="criteriaM"><strong>Price:</strong> ' . $response->products[0]->stores[$i]->price ;
echo      $response->products[0]->stores[$i]->currency_symbol. ' === '.(float)$EUR_price.'€</td></tr>';
echo '<tr><td class="criteriaM"><strong>Link:</strong> <a href=" ' . $response->products[0]->stores[$i]->link . '" >'. $response->products[0]->stores[$i]->link .'</td></tr>';
echo '<tr><td class="criteria"><strong>Update:</strong> ' . $response->products[0]->stores[$i]->last_update . '</td></tr>';
echo '<tr><td>----------------------------------------------------------------------------------------------</td></tr>';

}





}else{

    echo '<tr><td class="menu"><strong>No DATA</strong> </td></tr>';


}echo '</table>';




function get_data($url, $ch) {
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}