<!DOCTYPE html>
<html lang="en">
<?php
ob_start();
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
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

    <header>
        <div id="intro" class="bg-image shadow-2-strong" style="background-image: url(./src/img/What-is-cloud-computing-1.gif); background-repeat: no-repeat; background-size: cover; height: 100%; background-position: center;">
            <div class="mask" style="background-color: rgba(0, 0, 0, 0.8); height: 100vh;">
                <div class="container d-flex align-items-center justify-content-center text-center h-100">
                    <div class="text-white">
                        <img src="./src/logo/LOGO whitepng.png" alt="Banner" style="max-height: 10vh; margin-bottom: 20px;"><br>
                        <!-- <h1 class="mb-3 mt-3">Welcome</h1> -->
                        <a href="#login">
                            <button type="button" class="btn btn-outline-info" style="width: 200px;">Login</button></a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <?php
    require_once './config.php';
    if (isset($_POST['login'])) {

        $email = $_POST["email"];
        $pw = $_POST["pw"];

        $sql = "SELECT * FROM `user` WHERE email='$email';";
        $result = mysqli_query($Connector, $sql);
        $i = 0;

        while ($row = mysqli_fetch_array($result)) {
            $i++;

            $resuly_email = $row['email'];
            $resuly_pw = $row['pw'];

            if ($email === $resuly_email && $pw === $resuly_pw) {
                $url = "redirect.php?email=$email";
                header('location: ./'.$url.'');
                ob_end_flush();
            } else {
                echo "
                <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Invalid Login Details Check Again!'
                  })
                </script>
                ";
            }
        }
        if ($i < 1) {
            echo "
            <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Invalid Login Details Check Again!'
              })
            </script>
            ";
        }
    }
    ?>

    <section>
        <div class="container" style="margin-bottom: 200px;" id="login">
            <div class="row justify-content-center">
                <div class="col-11 col-sm-11 col-md-10 col-lg-7 col-xl-6 cs-clr">

                    <form method="POST">
                        <h3 style="text-align: center;">Login</h3>
                        <div class="form-group">
                            <label class="txt-lb" for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control btn-outline-dark" id="email" name="email" aria-describedby="emailHelp">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                            <label class="txt-lb" for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control btn-outline-dark" id="pw" name="pw">
                        </div>
                        <div class="form-group">
                            <a href="./create-acc.php">Create New Account</a>
                        </div>
                        <center>
                            <button type="submit" class="btn btn-outline-dark btn-lg" name="login">Login</button>
                        </center>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php
    require_once '../pg/footer.php';
    ?>

</body>

</html>