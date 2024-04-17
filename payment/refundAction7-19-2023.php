<?php
function guidv4($data)
        {
            assert(strlen($data) == 16);

            $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
            $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10

            return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
        }
include_once 'service.php';
$service = new Service();

$getinfo = $service->getinfoaccinfo($_GET['id']);
// die(print_r($getinfo));

// Set the endpoint URL and credentials
$auth_url = 'https://api-dev02.noqodi.com/oauth/token/client-credentials';
$client_id = 'qC9jbcOFAqQsRAFb2cClAhZKu9AVtiDp';
$client_secret = '6Yn3RPiBtImDv8rD';

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
// $merchantRequestId = guidv4(openssl_random_pseudo_bytes(16));
// Check for errors
if(curl_errno($ch)){
    echo 'cURL error: '.curl_error($ch);
}

// Close the cURL session
curl_close($ch);

// Parse the response as JSON and extract the access token
$result = json_decode($response, true);
$access_token = $result['access_token'];

// die($access_token);


//last Refund thing


$data = array(
    "serviceType" => "REFUND",
    "customerInfo" => array(
        "paymentMethod" => array(
            "type" => "CCD"
        )
    ),
    "merchantInfo" => array(
        "merchantCode" => $getinfo['mcode'],
        "merchantRequestId" => guidv4(openssl_random_pseudo_bytes(16)),
        "merchantOrderId" => $getinfo['morder']
    ),
    "paymentInfo" => array(
        "amount" => array(
            "value" => $getinfo['amount'],
            "currency" => $getinfo['cur']
        ),
        "noqodiOrderId" => $getinfo['noqord'],
        "transactions" => array(
            array(
                "merchantReferenceId" => $getinfo['infoid'],
                "noqodiReferenceId" => $getinfo['noqref'],
                "merchantCode" => $getinfo['mcode'],
                "refundReason" => "FULL_BUSINESS",
                "transactionAmount" => array(
                    "value" => $getinfo['amount'],
                    "currency" => $getinfo['cur']
                ),
                "beneficiaries" => array(
                    array(
                        "beneficiaryAcctNumber" => $getinfo['bennum'],
                        "beneficiaryName" => "Violet",
                        "beneficiaryAmount" => array(
                            "value" => $getinfo['amount'],
                            "currency" => $getinfo['cur']
                        )
                    )
                )
            )
        )
    )
);

$json_data = json_encode($data);
$url = "https://api-dev02.noqodi.com/v2/refunds";
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
		if (curl_errno($ch)) {
            echo "Error: ".curl_error($ch);
        }

        // Close the cURL session
        curl_close($ch);
        // echo $response;
        $data = json_decode($response);

        // die(print_r($data));
        $amount = $data->paymentInfo->amount->value;
        $currency = $data->paymentInfo->amount->currency;
        $result = $data->statusInfo->status;
        // var_dump($data);
        // die();
        // die($result);
        if($result == 'SUCCESS'){
            echo 'Transaction refunded successfully, amount: '.$amount.' '.$currency;
        }else{
            echo 'Transaction already refunded';
        }