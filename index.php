<?php

require_once "./src/Onesignal.php";

$Onesignal = new Onesignal();

// set api key and app id
$api_key = "<api-key>";
$app_id = "<add-id>";
$Onesignal->API_KEY = $api_key;
$Onesignal->APP_ID = $app_id;

// send to all su scribed users
// echo($Onesignal->sendPushToAllSubscribedUsers([
//     "title" => "New messages from rezwan",
//     "body" => "Please check your new message",
//     "url" => "https://www.rightbiz.co.uk/member_secure/my_msg/messages.php",
//     "big_picture" => "https://t4.ftcdn.net/jpg/03/17/25/45/360_F_317254576_lKDALRrvGoBr7gQSa1k4kJBx7O2D15dc.jpg"
// ]));

// send to specfic users
    // echo($Onesignal->SendPushToUser(
    //     ["45390e2a-2d67-47cf-a1be-ae224d73fc96"],
    //     [
    //         "title" => "New messages from rezwan",
    //         "body" => "Please check your new message",
    //         "url" => "https://www.rightbiz.co.uk/member_secure/my_msg/messages.php",
    //         "big_picture" => "https://t4.ftcdn.net/jpg/03/17/25/45/360_F_317254576_lKDALRrvGoBr7gQSa1k4kJBx7O2D15dc.jpg"
    //     ]
    // ));

// get all devices
    // echo "<pre>";
    // print_r(json_decode($Onesignal->getDevices()));

// view specific device info
    // echo ($Onesignal->viewDevice("45390e2a-2d67-47cf-a1be-ae224d73fc96"));
?> 