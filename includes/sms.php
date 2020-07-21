<?php
require 'vendor/autoload.php';


// Set your app credentials
$username   = "sandbox";
$apiKey     = "bbbdd929c2c65e38ddac107fdc6a470bffaba016cab66ba32c3bf201650a9818";

// Initialize the SDK
$AT         = new AfricasTalking($username, $apiKey);

// Get the SMS service
$sms        = $AT->sms();

// Set the numbers you want to send to in international format
$recipients = "+2548064152319";

// Set your message
$message    = "I'm a lumberjack and its ok, I sleep all night and I work all day";

// Set your shortCode or senderId
$from       = "myShortCode or mySenderId";

//try {
//  // Thats it, hit send and we'll take care of the rest
//  $result = $sms->send([
//      'to'      => $recipients,
//      'message' => $message,
//      'from'    => $from
//  ]);
//
//  print_r($result);
//} catch (Exception $e) {
//  echo "Error: ".$e->getMessage();
//}
