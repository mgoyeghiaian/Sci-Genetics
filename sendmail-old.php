<!-- <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
            <img style="position:absolute;" src="http://crm.dis-ae.com/sc/main.jpg" alt="main.jpg" /> 
            <div><p><a href="http://crm.dis-ae.com">click here</a> to Pay your invoice in one click</p>
            <p>Test Name: '.$test.'</p>
            <p>Amount: '.$amount.'</p></div>
</body>
</html> -->
<?php
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
if(isset($_POST['pg'])){

$name = $_POST['clientname'];
$mobile = $_POST['mobile'];
$email = $_POST['email'];
$test = $_POST['test'];
$amount = $_POST['amount'];

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
$url = "https://api-dev02.noqodi.com/v2/payments/preAuth";

// Set the request data
$data = array(
    "serviceType" => "PRE_AUTH",
    "serviceMode" => "NORMAL",
    "merchantInfo" => array(
        "merchantCode" => "MR102991",
        "merchantLandingURL" => "http://crm.dis-ae.com/sc/paid.php?name=".$name."&test=".$test."&response=",
        "merchantRequestId" => guidv4(openssl_random_pseudo_bytes(16)),
        "merchantOrderId" => $merchantOrderId
    ),
    "customerInfo" => array(
        "name" => $name,
        "mobile" => $mobile,
        "email" => $email
    ),
    "paymentInfo" => array(
        "amount" => array(
            "value" => $amount,
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

// Check for errors
if (curl_errno($ch)) {
    echo "Error: ".curl_error($ch);
}

// Close the cURL session
curl_close($ch);
// echo $response;

// die($response);
$data = json_decode($response);
$noqodi = $data->paymentInfo->paymentUrl;

$to = $email;
$from = "Jean <hnehme@in2info.com>";
$subject = "Pay your Invoice in one Click";
// $message = '<div style="background-image: url(\'sc/main.jpg\')">

//             </div>';
$message = '
<!DOCTYPE html>
<html>
<head>
<style>
  a{
    background-color:#808080;
    color:white;
    text-decoration:none;
    padding:10px;
    text-align:center;
    width:100px;
  }
  body{
    font-family: Arial;
  }
  p{
    color:#808080;
  }
</style>
</head>
<body>
<div>
<img style="width:50px;" src="http://crm.dis-ae.com/sc/sci-l.png">
</div>
<div>
<img src="http://crm.dis-ae.com/sc/main2.jpg">
</div>
<p>Dear '.$name.',<br><br>Please pay the amount of '.$amount.' AED <br><span style="font-size:10px">Check attached document for your reference</span></p>
<p>A confirmation will be sent to your email with your payment receipt</p>
<table>
<tr><td><a style="padding:30in;" href="'.$noqodi.'">Click to pay</a></td><tr>
</table><br><br>
<p style="font-size:11px">© 2023 Copyright SCI SMART CELLS INTERNATIONAL All Rights Reserved SITEMANAGER V3.0 <img style="vertical-align:baseline;" src="in2info.png" /></p>
</body>
</html>
';

$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=UTF-8\r\n";
$headers .= "From: $from";

// ************ Message to Applicant

if (@mail($to, $subject, $message, $headers) ){
   header('location:index.php?success=true');
}else{
  header('location:index.php?success=false');
}    

}