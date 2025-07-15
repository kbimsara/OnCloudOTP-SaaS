<?php
require_once '../config.php';
$otp = $_GET['otp'];
//get data from otp&user table
$query_search = "SELECT * FROM `otp` WHERE `otp` = '$otp';";
$query_run_search = mysqli_query($Connector, $query_search);

while ($row = mysqli_fetch_array($query_run_search)) {
    $otp  = $row['otp'];
    $email = $row['email'];
    $time = $row['time'];
    $g_id = $row['g_id'];
    $status = $row['otp_status'];
}
$date = date("Y-m-d H:i:s");
//check otp and get new otp
while (true) {
    $nnn = rand(1, 100);
    $nwotp = $nnn . "tp" . rand(1, 10000);
    $query_sh = "SELECT * FROM `otp` WHERE `otp`='$nwotp';";
    $query_run_insert = mysqli_query($Connector, $query_sh);
    if (mysqli_num_rows($query_run_insert) > 0) {
        continue;
    } else {
        break;
    }
}
$sql = "INSERT INTO `otp` (`otp`, `email`, `time`, `g_id`, `otp_status`) VALUES ('$nwotp', '$email', '$date', '$g_id', 'pending');";
$query = mysqli_query($Connector, $sql);

//delete data from otp table
$query_del = "DELETE FROM otp WHERE email='$email2' AND otp_status='pending' AND NOT `otp`=$nwotp;";
$query_del_run = mysqli_query($Connector, $query_del);

require_once '../mail/sender.php';
// require './mail/PHPMailer/src/Exception.php';
// require './mail/PHPMailer/src/PHPMailer.php';
// require './mail/PHPMailer/src/SMTP.php';

$send = new sender;
$send->to = "$email";
$send->otp = "$nwotp";
$send->group_name = "onCloudOTP";
$send->timeStamp = "$date";
$send->subject = "Account Verification";
$send->sendphp();
