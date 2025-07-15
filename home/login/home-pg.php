<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-11 col-sm-11 col-md-10 col-lg-7 col-xl-6 cs-clr">

                <form action="#" method="POST">
                    <div class="form-group">
                        <label class="txt-lb" for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control btn-outline-dark" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label class="txt-lb" for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control btn-outline-dark" id="exampleInputPassword1">
                    </div>
                    <div class="form-group">
                        <a href="#">Create New Account</a>
                    </div>
                    <center>
                        <button type="submit" class="btn btn-outline-dark btn-lg">Login</button>
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