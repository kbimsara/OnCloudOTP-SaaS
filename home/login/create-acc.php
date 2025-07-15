<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <!-- Page Title bar -->
    <link rel="icon" type="image/png" href="./src/logo/icon.png" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">

    <!-- Sweet Alert -->
    <script src="./src/sweetalert2.all.min.js"></script>
</head>

<body>
    <?php
    require_once './config.php';
    if (isset($_POST['create'])) {

        // echo '<script>console.log("Hello world!")</script>';

        $name = $_POST["name"];
        $email = $_POST["email"];
        $pw = $_POST["pw"];
        $date = date("Y-m-d H:i:s");

        //Check email exist
        $query_check = "SELECT * FROM `user` WHERE `email`='$email';";
        $query_check_run = mysqli_query($Connector, $query_check);
        if (mysqli_num_rows($query_check_run) < 1) {

            $query_insert = "INSERT INTO `user` (`email`, `pw`, `name`) VALUES ('$email', '$pw', '$name');";
            $query_run = mysqli_query($Connector, $query_insert);

            if ($query_run) {

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
                $sql = "INSERT INTO `otp` (`otp`, `email`, `time`, `g_id`, `otp_status`) VALUES ('$nwotp', '$email', '$date', 'user', 'pending');";
                $query = mysqli_query($Connector, $sql);

                // $query_sh2 = "SELECT * FROM `c-group` WHERE `otp`='$nwotp';";
                // $query_sh2_run = mysqli_query($Connector, $query_sh2);
                // while ($row = mysqli_fetch_array($query_sh2_run)) {
                //     $resuly_email = $row['email'];
                // }

                require_once './mail/sender.php';
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


                echo "
            <script>
            Swal.fire(
                'Account Created!',
                'Please login New Account',
                'success'
              ).then(function() {
                window.location.href = './index.php';
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
        } else {
            echo "
        <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Email Already exist!'
          })
        </script>
        ";
        }
    }
    ?>

    <div class="container">
        <div class="row justify-content-center" style="margin-top: 40px;">
            <div class="col-12">
                <h3 style="text-align: center;">Create Account</h3>
            </div>
            <div class="col-11 col-sm-11 col-md-10 col-lg-7 col-xl-6 cs-clr" style="margin-top: 0px;margin-bottom: 30px;">
                <form method="POST">
                    <div class="form-group">
                        <label class="txt-lb">Name</label>
                        <input type="text" class="form-control btn-outline-dark" id="name" name="name" aria-describedby="emailHelp" placeholder="Name" required>
                        <span class="form-text text-muted validation">Jhone Wick</span>
                    </div>
                    <div class="form-group">
                        <label class="txt-lb" for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control btn-outline-dark" id="email" name="email" aria-describedby="emailHelp" placeholder="Email" required>
                        <span class="form-text text-muted validation">We'll never share your email with anyone else.</span>
                    </div>
                    <div class="form-group">
                        <label class="txt-lb" for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control btn-outline-dark" id="pw" name="pw" placeholder="Password" required>
                        <span class="form-text text-muted validation">SamplePw@12345</span>
                    </div>
                    <div class="form-group">
                        <label class="txt-lb" for="exampleInputPassword1">Re-Password</label>
                        <input type="password" class="form-control btn-outline-dark" id="pw2" name="pw2" placeholder="Re-Enter your password" required>
                        <span class="form-text text-muted validation"></span>
                    </div>
                    <div class="form-group">
                        <a href="./index.php">Already Have Account</a>
                    </div>
                    <center>
                        <a href="./home-pg.php">
                            <button type="submit" class="btn btn-outline-dark btn-lg" name="create" id="create">Create Account</button>
                        </a>
                    </center>
                </form>
            </div>
        </div>
    </div>

    <?php
    require_once '../pg/footer.php';
    ?>

</body>

</html>