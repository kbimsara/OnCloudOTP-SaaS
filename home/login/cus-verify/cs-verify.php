<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Verify</title>
    <!-- Page Title bar -->
    <link rel="icon" type="image/png" href="../src/logo/icon.png" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../style.css">

    <!-- Sweet Alert -->
    <script src="../src/sweetalert2.all.min.js"></script>
</head>

<body>
    <?php
    require_once '../config.php';

    if (isset($_GET['otp'])) {
        $otp = $_GET['otp'];
        //get data from otp&user table
        $query_search = "SELECT * FROM `otp` WHERE `otp` = '$otp';";
        $query_run_search = mysqli_query($Connector, $query_search);

        while ($row = mysqli_fetch_array($query_run_search)) {
            $otp  = $row['otp'];
            $email = $row['email'];
            $time = $row['time'];
            $status = $row['otp_status'];
        }
    }
    if (isset($_GET['email']) && isset($_GET['g_id'])) {
        $email = $_GET['email'];
        $g_id = $_GET['g_id'];
        $date = date("Y-m-d H:i:s");

        //get data from otp&user table
        $query_search = "SELECT * FROM `c-group` WHERE `g_id` = '$g_id';";
        $query_run_search = mysqli_query($Connector, $query_search);

        if (mysqli_num_rows($query_run_search) > 0) {

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
            $otp = $nwotp;
            $sql = "INSERT INTO `otp` (`otp`, `email`, `time`, `g_id`, `otp_status`) VALUES ('$nwotp', '$email', '$date', '$g_id', 'pending');";
            $query = mysqli_query($Connector, $sql);
                require_once './mail/sender.php';

                $send = new sender;
                $send->to = "$email";
                $send->otp = "$nwotp";
                $send->group_name = "onCloudOTP";
                $send->timeStamp = "$date";
                $send->subject = "Account Verification";
                $send->sendphp();
        } else {
            echo "
            <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!'
              })
            </script>
            ";
        }
        // new line break
    }

    if (isset($_POST['verify'])) {

        $number = $_POST["n1"];
        $otp = $number;

        //update data from otp table
        $query_update = "UPDATE `otp` SET `otp_status` = 'verified' WHERE `otp`.`otp` = '$number';";
        $query_run = mysqli_query($Connector, $query_update);

        if ($query_run) {
            //get data from otp&user table
            $query_search = "SELECT * FROM `otp` WHERE `otp` = '$number';";
            $query_run_search = mysqli_query($Connector, $query_search);
            while ($row = mysqli_fetch_array($query_run_search)) {
                $email = $row['email'];
                break;
            }
            //delete data from otp table
            $query_del = "DELETE FROM otp WHERE email='$email' AND otp_status='pending';";
            $query_del_run = mysqli_query($Connector, $query_del);
            // ob_flush();
            echo "
            <script>
            Swal.fire(
                'Account Activated!',
                'You can continue your work',
                'success'
              ).then(function() {
                window.location.href = './redirect.php';
            })
            </script>
            ";
        } else {
            echo "
            <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!'
              })
            </script>
            ";
        }
    }


    ?>

    <div class="container">
        <div class="row justify-content-center" style="margin-top: 40px;">
            <div class="col-12">
                <h3 style="text-align: center;">Account Verification</h3>
            </div>
            <div class="col-11 col-sm-11 col-md-10 col-lg-7 col-xl-6 cs-clr" style="margin-top: 0px;">
                <form method="POST" action="./redirect.php">
                    <div class="form-group">
                        <center>
                            <img src="../src/img/vaerification.png" alt="Banner" class="img-cover">
                        </center>
                    </div>
                    <div class="form-group">
                        <label class="txt-lb" for="exampleInputEmail1">Email address :</label>
                        <span class="txt"><?php echo $email; ?></span>
                    </div>
                    <div class="form-group otp-10" style="text-align: center;">
                        <input type="text" name="n1" id="n1" maxlength="10" class="form-control btn-outline-warning number-10" value="<?php $otp; ?>">
                    </div>
                    <div class="form-group">
                        <p class="txt-vr">This OTP ( One Time Password ) Will Expired in 5 minutes</p>
                        <a href="./resend.php?otp=<?php $otp; ?>">Resend</a><br>
                        <!-- <a href="./index.php">Already Have Account</a> -->
                    </div>
                    <center>
                        <button type="submit" class="btn btn-warning btn-lg" name="verify" id="verify">Verify</button>
                    </center>
                </form>
            </div>
        </div>
    </div>



    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>

</html>