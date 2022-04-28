
<?php
//session_start();
$api_key = 'l1sb4dr7rnng4ftxp41smz54soubg2';
$req_url = 'https://v6.exchangerate-api.com/v6/b1c79e722136aa3fa32e5909/latest/EUR';
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
      
      //$EUR_price = round(($base_price * $response2->conversion_rates->EUR), 2);
      $_SESSION['GBP']=$response2->conversion_rates->GBP;
      $_SESSION['NOK']=$response2->conversion_rates->NOK;
        $_SESSION['SEK']=$response2->conversion_rates->SEK;
        $_SESSION['DKK']=$response2->conversion_rates->DKK;
        $_SESSION['CAD']=$response2->conversion_rates->CAD;
        $_SESSION['USD']=$response2->conversion_rates->USD;
        echo ('<div style="background-color:steelblue; color:white;">');
        echo ('<marquee behavior="scroll" scrollamount="8" width="100%" direction="left" height="20px">');
        
        echo ('GBP '.$_SESSION['GBP'].'€&nbsp;&nbsp;');
        echo ('NOK '.$_SESSION['NOK'].'€&nbsp;&nbsp;');
        echo ('SEK '.$_SESSION['SEK'].'€&nbsp;&nbsp;');
        echo ('DKK '.$_SESSION['DKK'].'€&nbsp;&nbsp;');
        echo ('CAD '.$_SESSION['CAD'].'€&nbsp;&nbsp;');
        echo ('USD '.$_SESSION['USD'].'€&nbsp;&nbsp;');
       
        echo ('</marquee>');
        echo ('</div>');
    }

    }
    catch(Exception $e) {
        // Handle JSON parse error...
    }

}



?>