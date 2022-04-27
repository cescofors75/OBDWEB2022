<?php
// Fetching JSON
$req_url = 'https://v6.exchangerate-api.com/v6/b1c79e722136aa3fa32e5909/latest/GBP';
$response_json = file_get_contents($req_url);

// Continuing if we got a result
if(false !== $response_json) {

    // Try/catch for json_decode operation
    try {

		// Decoding
		$response = json_decode($response_json);

		// Check for success
		if('success' === $response->result) {

			// YOUR APPLICATION CODE HERE, e.g.
			$base_price = 8.74; // Your price in USD
			$EUR_price = round(($base_price * $response->conversion_rates->EUR), 2);
            echo ($EUR_price);
		}

    }
    catch(Exception $e) {
        // Handle JSON parse error...
    }

}
?>