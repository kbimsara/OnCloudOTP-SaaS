<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Verify</title>
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

    if (isset($_GET['email'])) {
        $email = $_GET['email'];
        //get data from otp&user table
        $query_search = "SELECT otp.otp AS `otp`,otp.email AS `email`,otp.time AS `time`,otp.otp_status AS `otp_status`,user.name AS `name` FROM `otp` JOIN `user` ON otp.email=user.email WHERE otp.`email` = '$email' ORDER BY `time` DESC LIMIT 1;";
        $query_run_search = mysqli_query($Connector, $query_search);

        while ($row = mysqli_fetch_array($query_run_search)) {
            $otp  = $row['otp'];
            $email2 = $row['email'];
            $time = $row['time'];
            $status = $row['otp_status'];
            $name = $row['name'];
        }
    }

    if (isset($_POST['verify'])) {

        $number = $_POST["n1"];

        //update data from otp table
        $query_update = "UPDATE `otp` SET `otp_status` = 'verified' WHERE `otp`.`otp` = '$number';";
        $query_run = mysqli_query($Connector, $query_update);
        //delete data from otp table
        $query_del = "DELETE FROM otp WHERE email='$email2' AND otp_status='pending';";
        $query_del_run = mysqli_query($Connector, $query_del);

        if ($query_run) {
            echo "
            <script>
            Swal.fire(
                'Account Activated!',
                'You can continue your work',
                'success'
              ).then(function() {
                window.location.href = './user-interface/home.php';
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
                <form method="POST">
                    <div class="form-group">
                        <center>
                            <img src="./src/img/vaerification.png" alt="Banner" class="img-cover">
                        </center>
                    </div>
                    <div class="form-group">
                        <label class="txt-lb">Name :</label>
                        <span class="txt"><?php echo $name; ?></span><br>
                        <label class="txt-lb" for="exampleInputEmail1">Email address :</label>
                        <span class="txt"><?php echo $email; ?></span>
                    </div>
                    <div class="form-group otp-10" style="text-align: center;">
                        <input type="text" name="n1" id="n1" maxlength="10" class="form-control btn-outline-warning number-10">
                        <!-- <input type="text" name="n2" id="n2" maxlength="1" class="number-10">
                        <input type="text" name="n3" id="n3" maxlength="1" class="number-10">
                        <input type="text" name="n4" id="n4" maxlength="1" class="number-10">
                        <input type="text" name="n5" id="n5" maxlength="1" class="number-10">
                        <input type="text" name="n6" id="n6" maxlength="1" class="number-10">
                        <input type="text" name="n7" id="n7" maxlength="1" class="number-10">
                        <input type="text" name="n8" id="n8" maxlength="1" class="number-10">
                        <input type="text" name="n9" id="n9" maxlength="1" class="number-10">
                        <input type="text" name="n10" id="n10" maxlength="1" class="number-10"> -->
                    </div>
                    <!-- <script>
                        var container = document.getElementsByClassName("otp-10")[0];
                        container.onkeyup = function(e) {
                            var target = e.srcElement;
                            var maxLength = parseInt(target.attributes["maxlength"].value, 10);
                            var myLength = target.value.length;
                            if (myLength >= maxLength) {
                                var next = target;
                                while (next = next.nextElementSibling) {
                                    if (next == null)
                                        break;
                                    if (next.tagName.toLowerCase() == "input") {
                                        next.focus();
                                        break;
                                    }
                                }
                            }
                        }
                    </script> -->
                    <div class="form-group">
                        <p class="txt-vr">This OTP ( One Time Password ) Will Expired in 3 minutes</p>
                        <a href="#">Resend</a><br>
                        <!-- <a href="./index.php">Already Have Account</a> -->
                    </div>
                    <center>
                        <a href="./home-pg.php">
                            <button type="submit" class="btn btn-warning btn-lg" name="verify" id="verify">Verify</button>
                        </a>
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