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
require 'PHPMailer-master/PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


// die();
// die();
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

  include('service.php');
  $service=new Service();
  $changerate = $service->changerate($_POST['rate']);

  

$name = $_POST['firstname'].' '.$_POST['lastname'];

$mobile = $_POST['mobile'];

$email = $_POST['email'];

$test = $_POST['test'];

$amount = $_POST['amount'];

$inout = $_POST['inout'];

$prefix = $_POST['prefix'];

$charge = $_POST['chargeamount'];

$amountaed = $_POST['amountaed'];

$rate = $_POST['rate'];
// die($amountaed);


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
$url = "https://api-dev02.noqodi.com/v2/payments/preAuth";

// Set the request data
$data = array(
    "serviceType" => "PRE_AUTH",
    "serviceMode" => "NORMAL",
    "merchantInfo" => array(
        "merchantCode" => "MR102991",
        "merchantLandingURL" => "http://www.sci-genetics.com/payment/paid.php?name=".$name."&test=".$test."&inout=".$inout."&rate=".$rate."&response=",
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

$preauthtoken = $data->paymentInfo->preAuthToken;

// die(print_r($preauthtoken));
$data = json_decode($response);

$noqodi = $data->paymentInfo->paymentUrl;
// //auth
// $url = "https://api-dev02.noqodi.com/v2/payments/auth";

// // Set the request data
// $data = array(
//   "serviceType" => "AUTH",
//   "serviceMode" => "DIRECT",
//   "customerInfo" => array(
//     "paymentMethod" => array(
//       "type" => "CCD",
//       "creditCardInfo" => array(
//         "creditCardNumber" => "5123456789012346",
//         "cardHolderName" => "ttert",
//         "creditCardExpiryMonth" => "05",
//         "creditCardExpiryYear" => "21",
//         "cvv" => "123",
//         "mobile" => "4634643",
//         "email" => "sds@sdd.er"
//       )
//     )
//   ),
//   "merchantInfo" => array(
//     "merchantCode" => "MR102991",
//     "merchantLandingURL" => "http://crm.dis-ae.com/sc/paid.php?name=".$name."&test=".$test."&response=",
//     "merchantRequestId" => guidv4(openssl_random_pseudo_bytes(16)),
//     "merchantOrderId" => $merchantOrderId
//   ),
//   "paymentInfo" => array(
//     "amount" => array(
//       "value" => $amount,
//       "currency" => "AED"
//     ),
//     "preAuthToken" => $preauthtoken
//   )
// );
// $data_string = json_encode($data);

// // die(print_r($data));
// // Convert the request data to JSON
// $json_data = json_encode($data);

// // Initialize cURL
// $ch = curl_init();

// // Set the cURL options
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// curl_setopt($ch, CURLOPT_URL, $url);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_POST, true);
// curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
// curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//     "Authorization: Bearer ".$access_token,
//     "Content-Type: application/json"
// ));

// // Execute the cURL request
// $response = curl_exec($ch);

// // Check for errors
// if (curl_errno($ch)) {
//     echo "Error: ".curl_error($ch);
// }

// // Close the cURL session
// curl_close($ch);
// end auth
// die($response);
// die($response);


// var_dump($preauthtoken);
//void
// Set API endpoint
// $url = "https://api-dev02.noqodi.com/v2/payments/auth";

// // Set request data
// $data = array(
//     "serviceType" => "AUTH",
//     "serviceMode" => "DIRECT",
//       "customerInfo" => array(
//         "paymentMethod" => array(
//             "type" => "CCD",
//             "creditCardInfo" => array(
//                 "creditCardNumber" => "4440000009900010",
//                 "cardHolderName" => "freddy",
//                 "creditCardExpiryMonth" => "01",
//                 "creditCardExpiryYear" => "39",
//                 "cvv" => "100",
//                 "mobile" => "71661526",
//                 "email" => "ftchakerian@in2info.com"
//             )
//         )
//     ),
//     "merchantInfo" => array(
//         "merchantCode" => "MR102991",
//         "merchantLandingURL" => "http://www.sci-genetics.com/payment/paid.php?name=".$name."&test=".$test."&response=",
//         "merchantRequestId" => $merchantRequestId,
//         "merchantOrderId" => $merchantOrderId
//     ),
//     "paymentInfo" => array(
//         "amount" => array(
//             "value" => $amount,
//             "currency" => "AED"
//         ),
//         "preAuthToken" => $preauthtoken
//     )
// );

// // Initialize cURL
// $curl = curl_init($url);

// // Set cURL options
// curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
// curl_setopt($curl, CURLOPT_POST, true);
// curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
// curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($curl, CURLOPT_HTTPHEADER, array(
//     'Content-Type: application/json',
//     'Content-Length: ' . strlen(json_encode($data))
// ));

// // Send request and get response
// $response = curl_exec($curl);
// // var_dump($response);
// // Close cURL
// curl_close($curl);

// // Handle response
// if ($response === false) {
//     // Request failed
//     echo "cURL error: " . curl_error($curl);
// } else {
//     // Request succeeded
//     $response_data = json_decode($response, true);
//     // var_dump($response_data);
// }
// die();
//end void
// die($_FILES['file']['name']);

if ($_FILES["filename"]['name'] != '') {
  
  $insertinfo = $service->insertinfodoc($_POST,$_FILES);
  // die('her');
  error_reporting(E_ALL^E_NOTICE);ob_start();
  // session_start();
  
    // include_once"encodeHtml.php";
    // include_once"db.php";
    // $conx = new Service;
    
    // $Title1=$_POST['Title1'];
    //   $Title2=$_POST['Title2'];
    $image = pathinfo($_FILES["filename"]["name"]);
    // $Text=$_POST['Text'];
    // $PageId='1';
    /*var_dump($Title1);
    var_dump($Title2);
    var_dump($image);
    var_dump($Text);
    var_dump($PageId);*/
  
    $myval = time();

     $ftp_host = '213.171.193.5';
      $ftp_user_name = 'sci-genetics.com';
      $ftp_user_pass = 'SC!@12345';
      
      $connect_it = ftp_connect( $ftp_host );
      
      $login_result = ftp_login($connect_it, $ftp_user_name, $ftp_user_pass);
      
      $remote_file = 'inv/'.$image['filename'].'_'.$myval.'.'.$image['extension'];
      $image = $_FILES['filename']['tmp_name'];
      $database_image_name = pathinfo($_FILES["filename"]["name"]);
      $database_image_name = $database_image_name['filename'].'_'.$myval.'.'.$database_image_name['extension'];
      ftp_pasv($connect_it, true);
      $bool1_response=ftp_put( $connect_it, $remote_file, $image, FTP_BINARY );
      
  //     if($bool1_response){ 
   
  //     }
  //     else {
  //         echo "error";
  //     }
  //     ftp_close( $connect_it );
  
  //  ob_flush();
    
    if($bool1_response){
      
      
$to = $email;
$subject = "Example email with attachment";
$from = "SCI - Smart Cells International <online@sci-genetics.com>";
$image = pathinfo($_FILES["filename"]["name"]);
// die(print_r($image));
if($inout == 'inside'){
  $message = '
<!DOCTYPE html>
<html>
<head>
<style>
  .a{
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
<a href="http://www.sci-genetics.com"><img style="width:50px;" src="http://www.sci-genetics.com/payment/sci-l.png"></a>
</div>
<div>
<img src="http://www.sci-genetics.com/payment/main2.jpg">
</div>
<p>Dear '.$prefix.' '.$name.',</p>
<br>
<p>An invoice has been generated to you for '.$test.' at sci-genetics.com</p>
<p>Enter your username and password on the website in the payment section.</p>

<p><a href="www.sci-genetics.com/inv/'.$image['filename'].'_'.$myval.'.'.$image['extension'].'">Click here</a> to view, download and print your invoice</p>
<p>Test Amount: '.$amount*$rate.' AED<br>Charges: '.$charge*$rate.' AED<br>Total to pay: '.$amountaed.' AED</p>
<br>
<p style="font-size:12px;">A confirmation will be sent to your email with your payment receipt</p>
<table>
<tr><td style="background-color:#808080;height:50px;"><a class="a" href="'.$noqodi.'">&nbsp;&nbsp;&nbsp;&nbsp;Click to pay&nbsp;&nbsp;&nbsp;&nbsp;</a></td><tr>
</table><br><br>
<p style="font-size:11px">© 2023 Copyright SCI SMART CELLS INTERNATIONAL All Rights Reserved SITEMANAGER V3.0 <img style="vertical-align:middle;" src="http://www.sci-genetics.com/payment/in2info.png" /></p>
</body>
</html>
';
}else{
  $message = '
<!DOCTYPE html>
<html>
<head>
<style>
  .a{
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
<a href="http://www.sci-genetics.com"><img style="width:50px;" src="http://www.sci-genetics.com/payment/sci-l.png"></a>
</div>
<div>
<img src="http://www.sci-genetics.com/payment/main2.jpg">
</div>
<p>Dear '.$name.',<br><br>Please pay the amount of '.$amount.' USD equivalent to '.$amountaed.' AED<br><span style="font-size:12px;">1$ = '.$rate.' AED</span></p>
<p><a href="www.sci-genetics.com/inv/'.$image['filename'].'_'.$myval.'.'.$image['extension'].'">Click here</a> to view, download and print your invoice</p>
<p style="font-size:12px;color:red;">Amount excludes bank and exchange charges</p>
<p style="font-size:12px;">A confirmation will be sent to your email with your payment receipt</p>
<table>
<tr><td style="background-color:#808080;height:50px;"><a class="a" href="'.$noqodi.'">&nbsp;&nbsp;&nbsp;&nbsp;Click to pay&nbsp;&nbsp;&nbsp;&nbsp;</a></td><tr>
</table><br><br>
<p style="font-size:11px">© 2023 Copyright SCI SMART CELLS INTERNATIONAL All Rights Reserved SITEMANAGER V3.0 <img style="vertical-align:middle;" src="http://www.sci-genetics.com/payment/in2info.png" /></p>
</body>
</html>
';
}




// ************ Message to Applicant
$mail = new PHPMailer(true); // Set 'true' for exceptions

$mail->isSMTP(); // Set mailer to use SMTP
$mail->Host = 'mail.smtp2go.com'; // Specify the SMTP server
$mail->Port = 587; // Specify the SMTP port
$mail->SMTPAuth = true; // Enable SMTP authentication
$mail->Username = 'sci-genetics.com'; // Your SMTP username
$mail->Password = 'smtp.sci-genetics'; // Your SMTP password
$mail->SMTPSecure = 'tls'; // Enable TLS encryption, 'ssl' also accepted

$mail->setFrom('online@sci-genetics.com', 'SCI Genetics');
$mail->addAddress($email);
$mail->Subject = $subject;
$mail->isHTML(true);
$mail->Body = $message;

$mail->addCustomHeader("MIME-Version: 1.0");
$mail->addCustomHeader("Content-type: text/html; charset=UTF-8");
// $mail->addCustomHeader("From: $from");

if ($mail->send()) {
  header('location:index.php?success=true');
} else {
  header('location:index.php?success=false');
}

// if (@mail($to, $subject, $message, $headers) ){
//   // $insertcustomer = $service->insertcustomer($_POST['lastname'],$_POST['gpas']);
//    header('location:index.php?success=true');
// }else{
//   header('location:index.php?success=false');
// }    

    }else {
        echo "error";
    }
    ftp_close( $connect_it );

 ob_flush();

  // Do something with the file data here
}else{

$insertinfo = $service->insertinfo($_POST);

$to = $email;
$from = "SCI - Smart Cells International <online@sci-genetics.com>";
$subject = "Pay your Invoice in one Click";
// $message = '<div style="background-image: url(\'sc/main.jpg\')">

//             </div>';

if($inout == 'inside'){
  
$message = '
<!DOCTYPE html>
<html>
<head>
<style>
  .a{
    background-color:#808080;
    color:white;
    text-decoration:none;
    padding:10px;
    text-align:center;
    width:100px;
    height:100em;
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
<a href="http://www.sci-genetics.com"><img style="width:50px;" src="http://www.sci-genetics.com/payment/sci-l.png"></a>
</div>
<div>
<img src="http://www.sci-genetics.com/payment/main2.jpg">
</div>
<p>Dear '.$prefix.' '.$name.',</p>
<br>
<p>An invoice has been generated to you at sci-genetics.com</p>
<p>Test Name: '.$test.'</p>


<p>Test Price: '.$amount*$rate.' AED<br>Charges: '.$charge*$rate.' AED<br>Total to pay: '.$amountaed.' AED</p>
<table>
<tr><td style="background-color:#808080;height:50px;"><a class="a" href="https://www.sci-genetics.com">&nbsp;&nbsp;&nbsp;&nbsp;Click to proceed to payment section on the website&nbsp;&nbsp;&nbsp;&nbsp;</a></td><tr>
</table><br>
<p>Enter your username and password on the website in the payment section.</p>
<p style="font-size:12px;">A confirmation will be sent to your email with your payment receipt</p>

<p style="font-size:11px">© 2023 Copyright SCI SMART CELLS INTERNATIONAL All Rights Reserved SITEMANAGER V3.0 <img style="vertical-align:middle;" src="http://www.sci-genetics.com/payment/in2info.png" /></p>
</body>
</html>
';
}else{
  $message = '
<!DOCTYPE html>
<html>
<head>
<style>
  .a{
    background-color:#808080;
    color:white;
    text-decoration:none;
    padding:10px;
    text-align:center;
    width:100px;
    height:100em;
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
<a href="http://www.sci-genetics.com"><img style="width:50px;" src="http://www.sci-genetics.com/payment/sci-l.png"></a>
</div>
<div>
<img src="http://www.sci-genetics.com/payment/main2.jpg">
</div>
<p>Dear '.$prefix.' '.$name.',</p>
<br>
<p>An invoice has been generated to you for at sci-genetics.com</p>
<p>Test Name: '.$test.'</p>


<p>Test Price: '.$amount.' USD<br>Charges: '.$charge.' USD<br>Total to pay: '.$amount+$charge.' USD equivalent to '.$amountaed.' AED</p>
<table>
<tr><td style="background-color:#808080;height:50px;"><a class="a" href="https://www.sci-genetics.com">&nbsp;&nbsp;&nbsp;&nbsp;Click to proceed to payment section on the website&nbsp;&nbsp;&nbsp;&nbsp;</a></td><tr>
</table><br>
<p>Enter your username and password on the website in the payment section.</p>
<p style="font-size:12px;">A confirmation will be sent to your email with your payment receipt</p>

<p style="font-size:11px">© 2023 Copyright SCI SMART CELLS INTERNATIONAL All Rights Reserved SITEMANAGER V3.0 <img style="vertical-align:middle;" src="http://www.sci-genetics.com/payment/in2info.png" /></p>
</body>
</html>
';
}



// ************ Message to Applicant
$mail = new PHPMailer(true); // Set 'true' for exceptions

$mail->isSMTP(); // Set mailer to use SMTP
$mail->Host = 'mail.smtp2go.com'; // Specify the SMTP server
$mail->Port = 587; // Specify the SMTP port
$mail->SMTPAuth = true; // Enable SMTP authentication
$mail->Username = 'sci-genetics.com'; // Your SMTP username
$mail->Password = 'smtp.sci-genetics'; // Your SMTP password
$mail->SMTPSecure = 'tls'; // Enable TLS encryption, 'ssl' also accepted

$mail->setFrom('online@sci-genetics.com', 'SCI Genetics');
$mail->addAddress($email);
$mail->Subject = $subject;
$mail->isHTML(true);
$mail->Body = $message;


$mail->addCustomHeader("MIME-Version: 1.0");
$mail->addCustomHeader("Content-type: text/html; charset=UTF-8");
// $mail->addCustomHeader("From: $from");

if ($mail->send()) {
  header('location:index.php?success=true');
} else {
  header('location:index.php?success=false');
}
// ************ Message to Applicant

// if (@mail($to, $subject, $message, $headers) ){
//   // $insertcustomer = $service->insertcustomer($_POST['lastname'],$_POST['gpas']);
//    header('location:index.php?success=true');
// }else{
//   header('location:index.php?success=false');
// }    



}
}