
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
                          inner join articleean on articleean.legacyArticleId=oemnumbers.legacyArticleId WHERE REF_EURO='".$reuro."'");
                      

                        

                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $familia=strtolower(substr($row['ref'],0,3));
                            $ref_euro2=strtolower($row['ref']);
                            echo '<table><tr><td class="menuMR" ><strong>Title Euro4x4:</strong> ' . $row['description'] . '</td></tr>';
                            echo '<tr><td class="menuMR" ><strong>Price Euro4x4:</strong> ' . $row['prix'] . '€</td></tr>';
                            echo "<tr><td class='menuMR' ><img class='shadow' src='http://blog.euro4x4parts.com/photos/". $familia . "/" . $ref_euro2 . "z.jpg'   style='width:150px'"
                            ?>
                            onerror="this.onerror=null;this.src='./images/no_image.jpg';" /></td></tr></table>
                            
                            <?php
                          
                            echo '</br>';
                            

                            while ($row = $result->fetch_assoc()) {                
                               
                           
                              
$url = 'https://api.barcodelookup.com/v3/products?barcode='.$row['ean'].'&formatted=y&key=' . $api_key;

$ch = curl_init(); // Use only one cURL connection for multiple queries

$data = get_data($url, $ch);

$response = array();
$response = json_decode($data);
echo '<table>';
if ($response){
// echo '<strong>Barcode Number:</strong> ' . $response->products[0]->barcode_number . '<br><br>';

echo '<tr><td class="menu"><strong>Product:</strong> ' . $response->products[0]->title . '</td></tr>';
echo '<tr><td class="menu"><strong>Description:</strong> ' . $response->products[0]->description . '</td></tr>';
echo '<tr><td class="menu"><img  src=" ' . $response->products[0]->images[0] . '" width="150px"></td></tr>';
echo '<tr><td class="menuM"><strong>Stores:</strong> ' . count($response->products[0]->stores) . '</td></tr>';

echo '<tr><td>----------------------------------------------------------------------------------------------</td></tr>';

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

array_push($names,'EURO4x4PARTS');
array_push($marks,$prix);

for ($j=0; $j < $i; $j++) {
//
$dif=(float)$prix-(float)$name[$j]['eprice'];
$dif=round($dif,2);
echo '<tr><td class="criteriaM"><strong>Name:</strong> ' . $name[$j]['name']. '</td></tr>';

  array_push($names,$name[$j]['name']);
  array_push($marks,$name[$j]['eprice']);


echo '<tr><td class="criteriaM"><strong>Country:</strong> ' . $name[$j]['country'] . '</td></tr>';
echo '<tr><td class="criteriaM"><strong>Price Store:</strong> ' . $name[$j]['price'] ;
echo     $name[$j]['currency_symbol']. ' === '.(float)$name[$j]['eprice'].'€</td></tr>';
echo '<tr><td class="criteriaM"><strong>Price Euro4x4:</strong> ' . $prix . '€</td></tr>';

if ($dif>0){
echo '<tr><td class="criteriaM r"><strong>DIF: + ' .$dif.'€</strong>&nbsp;&nbsp;<img src="./images/xroja22.png"></td></tr>';
}else{
    echo '<tr><td class="criteriaM v"><strong>DIF:  ' .$dif . '€</strong>&nbsp;&nbsp;<img src="./images/ok2.png"></td></tr>';

}
echo '<tr><td class="criteria"><strong>Link:</strong> <a href=" ' . $name[$j]['link'] . '" >'. $name[$j]['link'] .'</td></tr>';
echo '<tr><td class="criteria"><strong>Update:</strong> ' . $name[$j]['last_update'] . '</td></tr>';
echo '<tr><td>----------------------------------------------------------------------------------------------</td></tr>';

}



echo '</table>'; 
//var_dump ($names);
$names = serialize($names);
$names = urlencode($names);
$marks = serialize($marks);
$marks = urlencode($marks);


echo '<iframe src="graf2.php?names='.$names.'&marks='.$marks.'"  width="100%" height="600px"   frameborder="0" scrolling="no"></iframe>';

echo '<iframe src="graf.php?names='.$names.'&marks='.$marks.'"  width="100%" height="600px"   frameborder="0" scrolling="no"></iframe>';

}
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
  ?> 
   
                    
                               
                           
                           
                           
                           
                           
                           
                           
                          






















