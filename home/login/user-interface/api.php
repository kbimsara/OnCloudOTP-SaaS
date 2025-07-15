<?php
require_once '../src/session.php';
$api = "active" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>onCloudOTP</title>
    <!-- Page Title bar -->
    <link rel="icon" type="image/png" href="../src/logo/icon.png" />

    <!-- Bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../style.css">

    <!-- Sweet Alert -->
    <script src="../src/sweetalert2.all.min.js"></script>
</head>

<body style="background-color: rgba(0, 0, 0, 0.1);">
    <?php
    require_once './config.php';
    if (isset($_GET['email'])) {
        $email = $_GET['email'];
        $_SESSION["email"] = $email;
    } elseif (isset($_SESSION["email"])) {
        $email = $_SESSION["email"];
    } else {
        header('Location: ../index.php');
        ob_end_flush();
    }
    ?>

    <div class="container-fluid" style="margin: 0px;padding: 0px;">
        <!-- navBar -->
        <?php require_once '../src/nav.php'; ?>
        <!-- section 01 -->
        <!-- section 06 -->
        <center>
            <div style="margin-top: 30px; margin-bottom: 60px;">
                <h3 style="font-size: xx-large;">How to use our service ?</h3>
                <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
                    <p class="text-center" style="font-size: medium; margin-top: 20px;">Using an API (Application Programming Interface) involves a few key steps to harness its power and integrate it into your projects effectively. Firstly, familiarize yourself with the API's documentation, which provides detailed information about its endpoints, parameters, and authentication methods. Understand the purpose of the API and its available functionalities. Next, obtain an API key or credentials required for authorization. This step ensures secure access to the API's resources. With the necessary information in hand, you can start making HTTP requests to the API endpoints, specifying the required parameters and headers. Handle the API's response by parsing the data returned in a format like JSON or XML. Extract the relevant information and incorporate it into your application or system. Remember to adhere to the API's rate limits and handle any errors or exceptions gracefully. Regularly test and validate your implementation to ensure it remains functional as the API evolves. Overall, thorough understanding of the API's documentation, proper authentication, and effective request handling are key to successful API utilization.
                    </p>
                    <p class="text-center" style="font-size: medium; margin-top: 20px;">To link a button in HTML, you can use the "a" (anchor) tag along with the `href` attribute. First, create a button element using the "button" tag and give it an appropriate identifier or class.
                    </p>
                </div>
            </div>
        </center>
        <!-- <style>
            div {
                border: 1px red solid;
            }
        </style> -->
        <!-- section 05 -->
        <div class="container-fluid" style="padding-top: 0px;padding-bottom: 20px;">
            <center>
                <div class="row justify-content-center">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
                        <p class="f-c-bolt text-center mp" style="font-size: large; font-weight: bolder;">Load interface</p>
                        <p class="text-center" style="font-size: medium; margin-top: 10px;">This help to user can get otp and verify their account using this site.</p>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 w-100">
                        <img src="./img/btnline.png" alt="banner" class="img-fluid" style="margin-bottom: 10px;">
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
                        <p class="f-c-bolt text-center mp" style="font-size: large; font-weight: bolder; margin-top: 20px;">How to get user Validity</p>
                        <a href="https://testxx1cloud.000webhostapp.com/api/sample@email.com">OnCloudOTP/api/sample@email.com</a> 
                        <p class="text-center" style="font-size: medium; margin-top: 10px;">We develep Curl for return limited infomaion about user validity. Use this Curl link .Try your email after replasing sample@email.com</p>
                    </div>

                    <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 w-100">
                        <img src="./img/api.png" alt="banner" class="img-fluid" style="margin-top: 10px;margin-bottom: 10px;">
                    </div>
                </div>
            </center>
        </div>
    </div>


    <?php
    require_once '../../pg/footer.php';
    ?>
</body>

</html>