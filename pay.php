<?php

if(isset($_POST['pay'])){
    include_once './payment/service.php';
    $service = new Service();
    $check = $service->check($_POST['username'],$_POST['password']);
    if($check){
        function guidv4($data)
        {
            assert(strlen($data) == 16);

            $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
            $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10

            return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
        }

        // echo guidv4(openssl_random_pseudo_bytes(16)).'<br>';

        // $uuid = uuid_create();
        // echo $uuid;
        // die();


        // Generate a unique identifier for the order
        $merchantOrderId = uniqid();
        // die($merchantOrderId);
        // // Print the generated identifiers
        // echo "Merchant Request ID: " . $merchantRequestId . "<br>";
        // echo "Merchant Order ID: " . $merchantOrderId . "<br>";
        // die();
        // die(print_r($_POST));
        // /*

        $name = $check['client'];

        $mobile = $check['mobile'];

        $email = $check['email'];

        $test = $check['test'];

        $amount = $check['amountusd'];

        $inout = $check['location'];

        $prefix = $check['prefix'];

        $charge = $check['chargeusd'];

        $amountaed = $check['amountaed'];

        $rate = $check['rate'];

        // die($amountaed);


        // Set the endpoint URL and credentials
        $auth_url = 'https://api.noqodi.com/oauth/token/client-credentials';
        //testing credentials
        // $client_id = 'qC9jbcOFAqQsRAFb2cClAhZKu9AVtiDp';
        // $client_secret = '6Yn3RPiBtImDv8rD';

        //real time cred
        $client_id = 'C5GFwVtFp43MLaxAcNF5SMeqtNb9ATrk';
        $client_secret = 'bnG6ZqHhfplclF4F';

        // Set the request parameters
        $data = array(
        'grant_type' => 'client_credentials'
        );

        // Encode the request parameters as a query string
        $query_string = http_build_query($data);

        // Set the cURL options
        $curl_options = array(
        CURLOPT_URL => $auth_url,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $query_string,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Basic '.base64_encode($client_id.':'.$client_secret)
        )
        );

        // Initialize the cURL session
        $ch = curl_init();

        // Set the cURL options
        curl_setopt_array($ch, $curl_options);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // Send the request and get the response
        $response = curl_exec($ch);

        ?>
        <br><br>
        <?php
        $merchantRequestId = guidv4(openssl_random_pseudo_bytes(16));
        // Check for errors
        if(curl_errno($ch)){
            echo 'cURL error: '.curl_error($ch);
        }

        // Close the cURL session
        curl_close($ch);

        // Parse the response as JSON and extract the access token
        $result = json_decode($response, true);

        
        $access_token = $result['access_token'];
        
        // Use the access token in your API requests
        // echo "Access token: ".$access_token;

        // Set the API endpoint URL
        $url = "https://api.noqodi.com/v2/payments/preAuth";

        // Set the request data
        $data = array(
            "serviceType" => "PRE_AUTH",
            "serviceMode" => "NORMAL",

            "merchantInfo" => array(
                "merchantCode" => "MR152574",
                "merchantLandingURL" => "http://www.sci-genetics.com/payment/paid.php?name=".$name."&prefix=".$prefix."&test=".$test."&inout=".$inout."&rate=".$rate."&at=".$access_token."&check=".$check[0]."&response=",
                "merchantRequestId" => $merchantRequestId,
                "merchantOrderId" => $merchantOrderId
            ),
            "customerInfo" => array(
                "name" => $name,
                "mobile" => $mobile,
                "email" => $email
            ),
            "paymentInfo" => array(
                "amount" => array(
                    "value" => $amountaed,
                    "currency" => "AED"
                ),
                "pricingInfo" => array(
                    "paymentTypes" => array(
                        "CCD"
                    )
                )
            )
        );
        // die(print_r($data));
        // Convert the request data to JSON
        $json_data = json_encode($data);

        // Initialize cURL
        $ch = curl_init();

        // Set the cURL options
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer ".$access_token,
            "Content-Type: application/json"
        ));
        
        // Execute the cURL request
        $response = curl_exec($ch);

        // var_dump($response);
        ?>
        <br><br>
        <?php
        // Check for errors
        if (curl_errno($ch)) {
            echo "Error: ".curl_error($ch);
        }

        // Close the cURL session
        curl_close($ch);
        // echo $response;
        $data = json_decode($response);
        // die($response);
        // die(print_r($data));
        $preauthtoken = $data->paymentInfo->preAuthToken;

        // die(print_r($preauthtoken));
        $data = json_decode($response);
        // die(print_r($data));
        $noqodi = $data->paymentInfo->paymentUrl;
        // die(print_r($data));

        //auth


        
        //endauth
        header("Location: ".$noqodi);
    }else{
        header("Location: index.php");
    }
}