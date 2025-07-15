<?php
$serverName="localhost";
$userName = "root";
$password ="";
$databaseName = "otp-cloud";

//connect database to variable
$Connector = new mysqli($serverName, $userName, $password, $databaseName);

//check database cpnnect or not
if($Connector->connect_error){
    die("Connection is failed" . $dbConnector->connect_error);
}