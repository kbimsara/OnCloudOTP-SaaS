<?php
$ch=curl_init();
//user email
$userEmail="sample@email.com";

//Curl-for test Validity
$url="http://localhost/cloudApi/".$userEmail;

curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

$resp=curl_exec($ch);

if ($e=curl_error($ch)){
    echo $e;
}else{
    $decord=json_decode($resp,JSON_OBJECT_AS_ARRAY);
    print_r($decord);
}
curl_close($ch);