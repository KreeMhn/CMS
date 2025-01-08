<?php
    // Check if the total parameter is set in the URL
    if(isset($_GET['total'])){
        // Retrieve the total value from the URL query parameters
        $total = intval($_GET['total'])*100;
        // Now you can use $total in your code
        echo "Total: $total";
    } else {
        echo "Total not provided in the URL.";
    }

    // Ensure $total is defined and within the expected range
    if(isset($total) && $total >= 10 && $total <= 100000) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://a.khalti.com/api/v2/epayment/initiate/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode(array(
                // "return_url" => "https://cart.php",
                "return_url" => "http://localhost/SE/unset_cart.php",
                "website_url" => "https://index.php",
                "amount" => $total, // pass $total directly as an integer
                "purchase_order_id" => "Order01",
                "purchase_order_name" => "test",
                "customer_info" => array(
                    "name" => "Test Bahadur",
                    "email" => "test@khalti.com",
                    "phone" => "9800000001"
                )
            )),
            CURLOPT_HTTPHEADER => array(
                'Authorization: key live_secret_key_68791341fdd94846a146f0457ff7b455',
                'Content-Type: application/json',
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // echo $response;
        
        // Decode the JSON response
        $responseData = json_decode($response, true);

        // Check if payment_url exists in the response
        if (isset($responseData['payment_url'])) {
            // Redirect the user to the payment URL
            header("Location: " . $responseData['payment_url']);
            exit; // Make sure to exit to prevent further execution
        } else {
            echo "Error: Payment URL not found in the response.";
        }
    } 
    else {
        echo "Error: Invalid or missing total amount.";
    }
?>
