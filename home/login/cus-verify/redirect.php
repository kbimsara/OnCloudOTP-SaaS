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




    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>

</html>