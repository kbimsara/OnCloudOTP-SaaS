<?php
require './sql-reader.php';
class otp{
    var $otp;

    function gen(){
        $n = rand(1, 999999999);
        return $n;
    }
}

$obj = new otp;
$sql=new otp1;

$quary1="SELECT * FROM `otp` WHERE `otp`=".$obj->gen()."";
// $quary1="SELECT * FROM `otp`";
$txt=$sql->search($quary1);
// $txt2=$sql->otp;
echo "$quary1+";
// echo count($txt+);
echo $sql->tbcount($sql->search($quary1));