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
// var_dump($_GET['response']);
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
		die(print_r($result));
  
  ?>
  
  
  
  




<!DOCTYPE html>
<html>
<head>
<style>
body{
    font-family: Arial;
  }
</style>
</head>
<body>
	<div style="width:fit-content;margin: 10% auto;">
  <?php 
  $data = json_decode($_GET['response']);
  $result = $data->statusInfo->status;
    // die(print_r($data));
    if($result == 'SUCCESS'){
  ?>
<div>
<img src="http://sci-genetics.com/payment/sci-l.png">
</div>
<div>
<img src="http://sci-genetics.com/payment/main2.jpg">
</div>
<p>Thank you for paying your invoice!<br>Please check your email for your receipt</p>
<?php

// die(print_r($_POST));
// /*
// die($data->customerInfo->email);
$email = $data->customerInfo->email;
// die($email);
$to = $email;
$from = "SCI - Smart Cells International <online@sci-genetics.com>";
$subject = "Invoice Paid";
// $message = '<div style="background-image: url(\'sc/main.jpg\')">

//             </div>';
if($_GET['inout'] == 'inside'){
	$message = '
		<html>
			<body lang="EN-US" link="blue" vlink="purple" style="font-family: Arial !important;">
				<p class="MsoNormal">
					<o:p>&nbsp;</o:p>
				</p>
				<div align="center">
					<table border="0" cellspacing="0" cellpadding="0" width="600" style="width:6.25in">
						<tr>
							<td style="padding:0in 0in 0in 0in">
								<p class="MsoNormal" align="left" style="text-align:left;margin:0;">
									<span style="font-family:Arial,&quot;sans-serif&quot;">
										<a href="">
											<span style="text-decoration:none">
												<img border="0" width="150" src="http://sci-genetics.com/payment/sci-l.png">
											</span>
										</a>
									</span>
								</p>
							</td>
						</tr>
						<tr style="height:11.25pt">
							<td colspan="2" style="padding:0in 0in 0in 0in;height:11.25pt">
							</td>
						</tr>
						<tr>
							<td style="padding:0in 0in 0in 0in" colspan="4">
								<p class="MsoNormal">
									<b>
										<span style="font-size:18.0pt;">Payment Received</span>
									</b>
								</p>
							</td>
								<td style="padding:0in 0in 0in 0in" colspan="1">
								<p class="MsoNormal" style=" text-align: right;">
									<b>
										<span></span>
									</b>
								</p>
							</td>

						</tr>
						<tr style="height:11.25pt">
							<td colspan="2" style="padding:0in 0in 0in 0in;height:11.25pt">
							</td>
						</tr>
						<tr>
							<td style="padding:0in 0in 0in 0in" colspan="5">
								<p class="MsoNormal" style="margin-bottom:0px;">
									<span style="display:block;height:5pt;"></span>
								</p>
							</td>
						</tr>
						<tr>
							<td style="padding:0in 0in 0in 0in" colspan="5">
								<p class="MsoNormal">
									<span style="font-size:14px;">
										Please print or save a copy of this page, as it is your proof of your order. 
										<o:p></o:p>
									</span>
								</p>
							</td>
						</tr>
						<tr style="height:11.25pt">
							<td style="padding:0in 0in 0in 0in;height:11.25pt" colspan="5"></td>
						</tr>
						<tr style="height:.75pt" >
							<td  colspan="5" style="background:#808080;padding:0in 0in 0in 0in;height:.75pt"></td>
						</tr>
						<tr style="height:11.25pt" colspan="5">
							<td style="padding:0in 0in 0in 0in;height:11.25pt"></td>
						</tr>
					</table>
				</div>
				<div align="center">
					<table class="MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="600" style="width:6.25in">
						<tr>
							<td width="300" style="width:225.0pt;padding:0in 0in 0in 0in">
								<p class="MsoNormal">
									<b><u><span>Smart Cells International:</span></u></b>
									<span>
										<o:p></o:p>
									</span>
								</p>
							</td>
							<td width="300" style="width:225.0pt;padding:0in 0in 0in 0in" >
								<p class="MsoNormal" style="">
									<b><u><span>Billed To:</span></u></b>
									<span>
										<o:p></o:p>
									</span>
								</p>
							</td>
						</tr>
						<tr style="height:11.25pt">
							<td style="padding:0in 0in 0in 0in;height:11.25pt"></td>
						</tr>
						<tr>
							<td>Ajman Free Zone Business Center,</td>
							<td>Name: '.$_GET['name'].'</td>
						</tr>
						<tr>
							<td>AFZ B1, Office 1304449</td>
              <td>Email: '.$data->customerInfo->email.'</td>
							
						</tr>
						<tr>
							<td>Ajman, UAE</td>
							<td>mobile: '.$data->customerInfo->mobile.'</td>
						</tr>
						<tr>
							<td>Phone: +971 50 967 1132</td>
							
						</tr>
						<tr>
							<td>Mobile: +971 50 323 8286</td>
							
						</tr>';
						$message.='
						<tr>
							<td style="padding:0in 0in 0in 0in">
							</td>
							<td style="padding:0in 0in 0in 0in">
								<p class="MsoNormal">
									
								</p>
							</td>
						</tr>
						<tr style="height:11.25pt">
							<td colspan="2" style="padding:0in 0in 0in 0in;height:11.25pt">
							</td>
						</tr>
						<tr style="height:.75pt">
							<td colspan="2" style="background:#808080;padding:0in 0in 0in 0in;height:.75pt"></td>
						</tr>
						<tr style="height:11.25pt">
							<td colspan="2" style="padding:0in 0in 0in 0in;height:11.25pt"></td>
						</tr>
					</table>
				</div>
				<div align="center">
					<table class="MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="600" style="width:6.25in">
						<tr>
							<td style="padding:0in 0in 0in 0in">
								<p class="MsoNormal">
									<span>Dear '.$_GET['name'].',<br>
										<o:p></o:p>
									</span><br>
								</p>
							</td>
						</tr>
						<tr>
							<td style="padding:0in 0in 0in 0in">
								<p class="MsoNormal">
									<span style="font-size:14px;">Thank you for paying your invoice. <br>For any additional enquires, please contact us by email:
										<a href="mailto:online@sci-genetics.com" style="color:#808080;">online@sci-genetics.com</a>
										<o:p></o:p>
									</span>
								</p>
							</td>
						</tr>
						<tr style="height:6.25pt">
							<td style="padding:0in 0in 0in 0in;height:5.25pt"></td>
						</tr>
					</table>
				</div>
				<p class="MsoNormal">
					<span style="display:none">
						<o:p>&nbsp;</o:p>
					</span>
				</p>
				<div align="center">
					<table width="600" style="border-spacing:1px;">
					<thead>
						<tr style="background-color:#808080;">
							<th style="padding:8px;font-weight: bold;border-spacing: 0px;color:white;text-align:left;width:55%">Test Name</th>
							<th style="padding:8px;font-weight: bold;border-spacing: 0px;color:white;text-align:left;width:20%">Price</th>

							<th style="padding:8px;font-weight: bold;border-spacing: 0px;color:white;text-align:left;width:20%">Total</th>
						</tr>
					</thead>
					<tbody>
						<tr>
                <td>'.$_GET['test'].'</td>
                <td>'.$data->paymentInfo->amount->value.' AED</td>
                <td>'.$data->paymentInfo->amount->value.' AED</td>
            </tr>
          </tbody>
          <tr style="height:11.25pt">
            <td style="padding:0in 0in 0in 0in;height:11.25pt"></td>
            <td style="padding:0in 0in 0in 0in;height:11.25pt"></td>
            <td style="padding:0in 0in 0in 0in;height:11.25pt"></td>
          </tr>
          <tr style="height:7.5pt">
            <td colspan="5" style="padding:1in 0in 0in 0in;height:7.5pt">
              <p class="MsoNormal" align="center" style="text-align:center">
                <span style="font-size:8.5pt;">&#169; 2023 Copyright SCI SMART CELLS INTERNATIONAL All Rights Reserved
                    SITE<b>MANAGER</b> V3.0
                    <a href="http://www.in2info.com" target="_blank">
                      <span style="text-decoration:none">
                        <img border="0" width="60" src="http://www.sci-genetics.com/payment/in2info.png" style="width:60px;">
                      </span>
                    </a>
                </span>
              </p>
            </td>
          </tr>
        </table>
      </div>
    </body>
  </html>
	';
}else{
	$message = '
		<html>
			<body lang="EN-US" link="blue" vlink="purple" style="font-family: Arial !important;">
				<p class="MsoNormal">
					<o:p>&nbsp;</o:p>
				</p>
				<div align="center">
					<table border="0" cellspacing="0" cellpadding="0" width="600" style="width:6.25in">
						<tr>
							<td style="padding:0in 0in 0in 0in">
								<p class="MsoNormal" align="left" style="text-align:left;margin:0;">
									<span style="font-family:Arial,&quot;sans-serif&quot;">
										<a href="">
											<span style="text-decoration:none">
												<img border="0" width="150" src="http://sci-genetics.com/payment/sci-l.png">
											</span>
										</a>
									</span>
								</p>
							</td>
						</tr>
						<tr style="height:11.25pt">
							<td colspan="2" style="padding:0in 0in 0in 0in;height:11.25pt">
							</td>
						</tr>
						<tr>
							<td style="padding:0in 0in 0in 0in" colspan="4">
								<p class="MsoNormal">
									<b>
										<span style="font-size:18.0pt;">Payment Received</span>
									</b>
								</p>
							</td>
								<td style="padding:0in 0in 0in 0in" colspan="1">
								<p class="MsoNormal" style=" text-align: right;">
									<b>
										<span></span>
									</b>
								</p>
							</td>

						</tr>
						<tr style="height:11.25pt">
							<td colspan="2" style="padding:0in 0in 0in 0in;height:11.25pt">
							</td>
						</tr>
						<tr>
							<td style="padding:0in 0in 0in 0in" colspan="5">
								<p class="MsoNormal" style="margin-bottom:0px;">
									<span style="display:block;height:5pt;"></span>
								</p>
							</td>
						</tr>
						<tr>
							<td style="padding:0in 0in 0in 0in" colspan="5">
								<p class="MsoNormal">
									<span style="font-size:14px;">
										Please print or save a copy of this page, as it is your proof of your order. 
										<o:p></o:p>
									</span>
								</p>
							</td>
						</tr>
						<tr style="height:11.25pt">
							<td style="padding:0in 0in 0in 0in;height:11.25pt" colspan="5"></td>
						</tr>
						<tr style="height:.75pt" >
							<td  colspan="5" style="background:#808080;padding:0in 0in 0in 0in;height:.75pt"></td>
						</tr>
						<tr style="height:11.25pt" colspan="5">
							<td style="padding:0in 0in 0in 0in;height:11.25pt"></td>
						</tr>
					</table>
				</div>
				<div align="center">
					<table class="MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="600" style="width:6.25in">
						<tr>
							<td width="300" style="width:225.0pt;padding:0in 0in 0in 0in">
								<p class="MsoNormal">
									<b><u><span>Smart Cells International:</span></u></b>
									<span>
										<o:p></o:p>
									</span>
								</p>
							</td>
							<td width="300" style="width:225.0pt;padding:0in 0in 0in 0in" >
								<p class="MsoNormal" style="">
									<b><u><span>Billed To:</span></u></b>
									<span>
										<o:p></o:p>
									</span>
								</p>
							</td>
						</tr>
						<tr style="height:11.25pt">
							<td style="padding:0in 0in 0in 0in;height:11.25pt"></td>
						</tr>
						<tr>
							<td>Ajman Free Zone Business Center,</td>
							<td>Name: '.$_GET['name'].'</td>
						</tr>
						<tr>
							<td>AFZ B1, Office 1304449</td>
              <td>Email: '.$data->customerInfo->email.'</td>
							
						</tr>
						<tr>
							<td>Ajman, UAE</td>
							<td>mobile: '.$data->customerInfo->mobile.'</td>
						</tr>
						<tr>
							<td>Phone: +971 50 967 1132</td>
							
						</tr>
						<tr>
							<td>Mobile: +971 50 323 8286</td>
							
						</tr>';
						$message.='
						<tr>
							<td style="padding:0in 0in 0in 0in">
							</td>
							<td style="padding:0in 0in 0in 0in">
								<p class="MsoNormal">
									
								</p>
							</td>
						</tr>
						<tr style="height:11.25pt">
							<td colspan="2" style="padding:0in 0in 0in 0in;height:11.25pt">
							</td>
						</tr>
						<tr style="height:.75pt">
							<td colspan="2" style="background:#808080;padding:0in 0in 0in 0in;height:.75pt"></td>
						</tr>
						<tr style="height:11.25pt">
							<td colspan="2" style="padding:0in 0in 0in 0in;height:11.25pt"></td>
						</tr>
					</table>
				</div>
				<div align="center">
					<table class="MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="600" style="width:6.25in">
						<tr>
							<td style="padding:0in 0in 0in 0in">
								<p class="MsoNormal">
									<span>Dear '.$_GET['name'].',<br>
										<o:p></o:p>
									</span><br>
								</p>
							</td>
						</tr>
						<tr>
							<td style="padding:0in 0in 0in 0in">
								<p class="MsoNormal">
									<span style="font-size:14px;">Thank you for paying your invoice. <br>For any additional enquires, please contact us by email:
										<a href="mailto:online@sci-genetics.com" style="color:#808080;">online@sci-genetics.com</a>
										<o:p></o:p>
									</span>
								</p>
							</td>
						</tr>
						<tr style="height:6.25pt">
							<td style="padding:0in 0in 0in 0in;height:5.25pt"></td>
						</tr>
					</table>
				</div>
				<p class="MsoNormal">
					<span style="display:none">
						<o:p>&nbsp;</o:p>
					</span>
				</p>
				<div align="center">
					<table width="600" style="border-spacing:1px;">
					<thead>
						<tr style="background-color:#808080;">
							<th style="padding:8px;font-weight: bold;border-spacing: 0px;color:white;text-align:left;width:40%">Test Name</th>
							<th style="padding:8px;font-weight: bold;border-spacing: 0px;color:white;text-align:left;width:20%">Price</th>
							<th style="padding:8px;font-weight: bold;border-spacing: 0px;color:white;text-align:left;width:20%">Rate</th>

							<th style="padding:8px;font-weight: bold;border-spacing: 0px;color:white;text-align:left;width:20%">Total</th>
						</tr>
					</thead>
					<tbody>
						<tr>
                <td>'.$_GET['test'].'</td>
				<td>'.($data->paymentInfo->amount->value)/$_GET['rate'].' USD</td>
				<td>'.$_GET['rate'].' USD</td>
                <td>'.$data->paymentInfo->amount->value.' AED</td>
            </tr>
          </tbody>
          <tr style="height:11.25pt">
            <td style="padding:0in 0in 0in 0in;height:11.25pt"></td>
            <td style="padding:0in 0in 0in 0in;height:11.25pt"></td>
            <td style="padding:0in 0in 0in 0in;height:11.25pt"></td>
          </tr>
          <tr style="height:7.5pt">
            <td colspan="5" style="padding:1in 0in 0in 0in;height:7.5pt">
              <p class="MsoNormal" align="center" style="text-align:center">
                <span style="font-size:8.5pt;">&#169; 2023 Copyright SCI SMART CELLS INTERNATIONAL All Rights Reserved
                    SITE<b>MANAGER</b> V3.0
                    <a href="http://www.in2info.com" target="_blank">
                      <span style="text-decoration:none">
                        <img border="0" width="60" src="http://www.sci-genetics.com/payment/in2info.png" style="width:60px;">
                      </span>
                    </a>
                </span>
              </p>
            </td>
          </tr>
        </table>
      </div>
    </body>
  </html>
	';
}


$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=UTF-8\r\n";
$headers .= "From: $from";
@mail($to, $subject, $message, $headers);
// ************ Message to Applicant

?>
<?php
    }else if($result == 'CANCELLED'){
      ?>
  <div>
<img src="http://sci-genetics.com/payment/sci-l.png">
</div>
<div>
<img src="http://sci-genetics.com/payment/main2.jpg">
</div>
<p>Payment Cancelled</p>
      <?php
    }else{
      ?>
    <div>
<img src="http://sci-genetics.com/payment/sci-l.png">
</div>
<div>
<img src="http://sci-genetics.com/payment/main2.jpg">
</div>
<p>Payment Failed! Please refer to your bank or try again later</p>

      <?php
    }
?>
<p style="margin-top:50px;font-size:11px">© 2023 Copyright SCI SMART CELLS INTERNATIONAL All Rights Reserved SITEMANAGER V3.0 <img style="vertical-align:middle;" src="http://www.sci-genetics.com/payment/in2info.png" /></p>
</div>
</body>
</html>