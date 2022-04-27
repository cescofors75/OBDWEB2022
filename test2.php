<?php
$reuro=$_POST['reuro'];

$api_key = 'l1sb4dr7rnng4ftxp41smz54soubg2';
$conexion = new mysqli('localhost', 'root','' , 'td2q2019');

$conexion->query("SET CHARACTER SET utf8"); 
                        $conexion->query("SET NAMES utf8");
                        $result = $conexion->query(
                          "SELECT distinct europroducts.libelleproduit AS description, europroducts.prixeuroht as prix , oemnumbers.legacyArticleId as legacy, articleean.eancode as ean 
                          FROM `eurocrossref` INNER JOIN europroducts ON europroducts.reference=eurocrossref.REF_EURO inner join oemnumbers on oemnumbers.articleNumber=eurocrossref.REF_FRN 
                          inner join articleean on articleean.legacyArticleId=oemnumbers.legacyArticleId WHERE REF_EURO='".$reuro."'");
                      

                        

                        if ($result->num_rows > 0) {
                          
                            while ($row = $result->fetch_assoc()) {                
                               
                           
                              
$url = 'https://api.barcodelookup.com/v3/products?barcode='.$row['ean'].'&formatted=y&key=' . $api_key;

$ch = curl_init(); // Use only one cURL connection for multiple queries

$data = get_data($url, $ch);

$response = array();
$response = json_decode($data);
echo '<table>';
if ($response){
// echo '<strong>Barcode Number:</strong> ' . $response->products[0]->barcode_number . '<br><br>';
echo '<tr><td class="menu"><strong>Title Euro4x4:</strong> ' . $row['description'] . '</td></tr>';
echo '<tr><td class="menu"><strong>Price Euro4x4:</strong> ' . $row['prix'] . '€</td></tr>';
echo '<tr><td class="menu"><strong>Title:</strong> ' . $response->products[0]->title . '</td></tr>';
echo '<tr><td class="menu"><strong>Image:</strong><img  src=" ' . $response->products[0]->images[0] . '" width="150px"></td></tr>';
echo '<tr><td class="menu"><strong>Stores:</strong> ' . count($response->products[0]->stores) . '</td></tr>';

echo '<tr><td>----------------------------------------------------------------------------------------------</td></tr>';

$stores=count($response->products[0]->stores);
for ($i=0;$i<$stores;$i++){
$prix=str_replace(",",".",$row['prix']);

//
if ($response->products[0]->stores[$i]->country !='EU'){
     $country='GBP';
    if ($response->products[0]->stores[$i]->country ==='NO'){

      $country='NOK';
    }
    if ($response->products[0]->stores[$i]->country ==='SE'){

        $country='SEK';
      }
      if ($response->products[0]->stores[$i]->country ==='DK'){

        $country='DKK';
      }

      if ($response->products[0]->stores[$i]->country ==='CA'){

        $country='CAD';
      }
      if ($response->products[0]->stores[$i]->country ==='US'){

        $country='USD';
      }




$req_url = 'https://v6.exchangerate-api.com/v6/b1c79e722136aa3fa32e5909/latest/'.$country;
$response_json = file_get_contents($req_url);

// Continuing if we got a result
if(false !== $response_json) {

    // Try/catch for json_decode operation
    try {

		// Decoding
		$response2 = json_decode($response_json);

		// Check for success
		if('success' === $response2->result) {

			// YOUR APPLICATION CODE HERE, e.g.
			$base_price = (float)$response->products[0]->stores[$i]->price; // Your price in USD
			$EUR_price = round(($base_price * $response2->conversion_rates->EUR), 2);
            //echo ($EUR_price);
		}

    }
    catch(Exception $e) {
        // Handle JSON parse error...
    }

}
}else{
    $EUR_price=$response->products[0]->stores[$i]->price;


}

//
$dif=(float)$prix-(float)$EUR_price;
echo '<tr><td class="criteria"><strong>Name:</strong> ' . $response->products[0]->stores[$i]->name . '</td></tr>';
echo '<tr><td class="criteria"><strong>Country:</strong> ' . $response->products[0]->stores[$i]->country . '</td></tr>';
echo '<tr><td class="criteria"><strong>Price Store:</strong> ' . $response->products[0]->stores[$i]->price ;
echo      $response->products[0]->stores[$i]->currency_symbol. ' === '.(float)$EUR_price.'€</td></tr>';
echo '<tr><td class="criteria"><strong>Price Euro4x4:</strong> ' . $row['prix'] . '€</td></tr>';

if ($dif>0){
echo '<tr><td class="criteria r"><strong>DIF: + ' .$dif.'€</strong></td></tr>';
}else{
    echo '<tr><td class="criteria v"><strong>DIF:  ' .$dif . '€</strong></td></tr>';

}
echo '<tr><td class="criteria"><strong>Link:</strong> <a href=" ' . $response->products[0]->stores[$i]->link . '" >'. $response->products[0]->stores[$i]->link .'</td></tr>';
echo '<tr><td class="criteria"><strong>Update:</strong> ' . $response->products[0]->stores[$i]->last_update . '</td></tr>';
echo '<tr><td>----------------------------------------------------------------------------------------------</td></tr>';

}





}else{

    echo '<tr><td class="menu"><strong>No DATA</strong> </td></tr>';


}echo '</table>';

 
}
mysqli_free_result($result); 
}
mysqli_close($conexion);


function get_data($url, $ch) {
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}
                           
                           
                           
                           
                           
                           
                           
                           
                           
                           
                           
                          






















