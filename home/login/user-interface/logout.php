<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// remove all session variables
session_unset();
// destroy the session
session_destroy();

//require_once '../index.php';
header('location: ../../index.php');