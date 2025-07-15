<?php

class table
{
    var $quary;
}

class otp1 extends table
{
    var $otp = null;
    var $email = null;
    var $time = null;
    var $g_id = null;
    var $otp_status = null;
    var $tbc;
    function search($quary)
    {
        //connection
        require_once '../config.php';
        $query_run = mysqli_query($Connector, $quary);
        $i = 0;

        while ($row = mysqli_fetch_array($query_run)) {
            $i++;
            $otp = $row['otp'];
            $email = $row['email'];
            $time = $row['time'];
            $g_id = $row['g_id'];
            $otp_status = $row['otp_status'];
            return array($otp, $email, $time, $g_id, $otp_status);
        }
    }
    function tbcount($n)
    {
        if (count($n)) {
            return count($n);
        } else {
            $tbc = 0;
        }
    }
}
class user extends table
{
    var $otp;
    var $email;
    var $time;
    var $g_id;
    var $otp_status;
    function search($quary)
    {
        //connection
        require_once '../config.php';
        $query_run = mysqli_query($Connector, $quary);
        $i = 0;

        while ($row = mysqli_fetch_array($query_run)) {
            $i++;
            $otp = $row['otp'];
            $email = $row['email'];
            $time = $row['time'];
            $g_id = $row['g_id'];
            $otp_status = $row['otp_status'];
            return array($otp, $email, $time, $g_id, $otp_status);
        }
    }
}
