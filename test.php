<?php
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
echo '<tr><td class="menu"><strong>Image:</strong><img  src=" ' . $response->products[0]->images[0] . '" width="150px"></td></tr>';
echo '<tr><td class="menu"><strong>Stores:</strong> ' . count($response->products[0]->stores) . '</td></tr>';

echo '<tr><td>----------------------------------------------------------------------------------------------</td></tr>';

$stores=count($response->products[0]->stores);
for ($i=0;$i<$stores;$i++){


echo '<tr><td class="criteria"><strong>Name:</strong> ' . $response->products[0]->stores[$i]->name . '</td></tr>';
echo '<tr><td class="criteria"><strong>Country:</strong> ' . $response->products[0]->stores[$i]->country . '</td></tr>';
echo '<tr><td class="criteria"><strong>Price:</strong> ' . $response->products[0]->stores[$i]->price ;
echo      $response->products[0]->stores[$i]->currency_symbol. '</td></tr>';
echo '<tr><td class="criteria"><strong>Link:</strong> <a href=" ' . $response->products[0]->stores[$i]->link . '" >'. $response->products[0]->stores[$i]->link .'</td></tr>';
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