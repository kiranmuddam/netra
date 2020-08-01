<?php
//post
$url="https://www.way2sms.com/api/v1/sendCampaign";
$message = urlencode("checking way2SMS");// urlencode your message
$curl = curl_init();
curl_setopt($curl, CURLOPT_POST, 1);// set post data to true
curl_setopt($curl, CURLOPT_POSTFIELDS, "apikey=[OZAFZXKDBW81E9HF41EWWZ83Y0H4E51K]&secret=[7ZSDME4SNI68OUKA]&usetype=[String]&phone=[7095275375]&senderid=[Netra_]&message=[$message]");// post data
// query parameter values must be given without squarebrackets.
 // Optional Authentication:
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($curl);
curl_close($curl);
echo $result;
?>
