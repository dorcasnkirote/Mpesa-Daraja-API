<?php 


include('accessToken.php');

date_default_timezone_set('Africa/Nairobi');
$processrequestUrl = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
$callbackurl = 'https://mydomain.com/path';
$passkey = "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
$BusinessShortCode = '174379';
$Timestamp = date('YmdHis');
$Password = base64_encode($BusinessShortCode . $passkey . $Timestamp);
$phone = $_POST['phone_number'];
$money = '60';
$PartyA = $phone;
$PartyB = '254115626708';
$AccountReference = 'Doro Wa Bass Anainama';
$TransactionDesc = 'stkpush test';
$Amount = $money;
$stkpushheader = ['Content-Type:application/json', 'Authorization:Bearer ' . $access_token];
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $processrequestUrl);
curl_setopt($curl, CURLOPT_HTTPHEADER, $stkpushheader);//setting custom header
$curl_post_data = array(
    
   "BusinessShortCode" => $BusinessShortCode,    
   "Password"=> $Password,    
   "Timestamp"=>$Timestamp,    
   "TransactionType"=> "CustomerPayBillOnline",    
   "Amount"=> $Amount,    
   "PartyA"=>$PartyA,    
   "PartyB"=>$BusinessShortCode,    
   "PhoneNumber"=>$PartyA,    
   "CallBackURL"=> $callbackurl,    
   "AccountReference"=> $AccountReference,    
   "TransactionDesc"=> $TransactionDesc
);

$data_string = json_encode($curl_post_data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
$curl_response = curl_exec($curl);

echo $curl_response;




