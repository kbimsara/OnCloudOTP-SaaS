<?php
require_once './config.php';

$email = $_GET['email'];

//get data from otp table
$query_search = "SELECT * FROM `otp` WHERE `email` = '$email' ORDER BY `time` DESC LIMIT 1";
$query_run_search = mysqli_query($Connector, $query_search);
$i = 0;

while ($row = mysqli_fetch_array($query_run_search)) {
    $i++;
    $otp  = $row['otp'];
    $email = $row['email'];
    $time = $row['time'];
    $group = $row['g_id'];
    $status = $row['otp_status'];

    if ($status == "verified") {
        header('location: ./user-interface/home.php?email='.$email.'');
    } else {
        /*Data different */
        // Creating DateTime objects
        $dateTimeObject1 = date_create("$time");
        // $dateTimeObject2 = date_create(date("Y-m-d H:i:s", time()));
        $dateTimeObject2 = date_create(date("Y-m-d H:i:s"));

        // Calculating the difference between DateTime objects
        $interval = date_diff($dateTimeObject1, $dateTimeObject2);
        $minutes = $interval->days * 24 * 60;
        $minutes += $interval->h * 60;
        $minutes += $interval->i;

        // //Printing result in minutes
        // echo ("Difference in minutes is:");
        // echo $minutes . ' minutes';
        if ($minutes <= 5) {
            echo 'You can verify your account';
            header('location: ./verify.php?email='.$email.'');
        } else {
            echo 'You can not verify your account';
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
            //new otp
            $newTime = date("Y-m-d H:i:s");
            $sql = "INSERT INTO `otp` (`otp`, `email`, `time`, `g_id`, `otp_status`) VALUES ($nwotp, '$email', '$newTime', 'user', 'pending');";
            $query = mysqli_query($Connector, $sql);
            if ($query) {
                header('location: ./verify.php?email='.$email.'');
            } else {
                echo '<script>alert("Please contact Admin")</script>';
            }
        }
    }
}
//If this will happend data base were empty
if ($i < 1) {
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
    //new otp
    $newTime = date("Y-m-d H:i:s");
    $sql2 = "INSERT INTO `otp` (`otp`, `email`, `time`, `g_id`, `otp_status`) VALUES ($nwotp, '$email', '$newTime', 'user', 'pending');";
    $query = mysqli_query($Connector, $sql2);
    if ($query) {
        header('location: ./verify.php?email='.$email.'');
    } else {
        echo '<script>alert("Please contact Admin")</script>';
    }
}

