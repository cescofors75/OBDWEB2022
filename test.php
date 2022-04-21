<?php
$ean=$_POST['ean'];
$api_key = 'l1sb4dr7rnng4ftxp41smz54soubg2';
$url = 'https://api.barcodelookup.com/v3/products?barcode='.$ean.'&formatted=y&key=' . $api_key;

$ch = curl_init(); // Use only one cURL connection for multiple queries

$data = get_data($url, $ch);

$response = array();
$response = json_decode($data);
if ($response){
echo '<strong>Barcode Number:</strong> ' . $response->products[0]->barcode_number . '<br><br>';
echo '<strong>Stores:</strong> ' . count($response->products[0]->stores) . '<br><br>';
echo '<strong>Title:</strong> ' . $response->products[0]->title . '<br><br>';
echo '----------------------------------------------------------------------------------------------</br>';

$stores=count($response->products[0]->stores);
for ($i=0;$i<$stores;$i++){


echo '<strong>Name:</strong> ' . $response->products[0]->stores[$i]->name . '<br><br>';
echo '<strong>Country:</strong> ' . $response->products[0]->stores[$i]->country . '<br><br>';
echo '<strong>Price:</strong> ' . $response->products[0]->stores[$i]->price ;
echo      $response->products[0]->stores[$i]->currency_symbol. '<br><br>';
echo '<strong>Update:</strong> ' . $response->products[0]->stores[$i]->last_update . '<br><br>';
echo '----------------------------------------------------------------------------------------------</br>';

}
}



function get_data($url, $ch) {
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}