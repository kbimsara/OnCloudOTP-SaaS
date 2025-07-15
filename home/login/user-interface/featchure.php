<?php
require_once '../src/session.php';
$featchure = "active";
?>
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

<body>
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
    //get data from db ->group id
    $quary = "SELECT * FROM `c-group` WHERE `email`='$email';";
    $result = mysqli_query($Connector, $quary);
    $g = 0;
    $u = 0;
    $v = 0;
    while ($row = mysqli_fetch_array($result)) {
        $g++;
        $rsg_id  = $row['g_id'];
        //get data from db ->otp tb
        $quary2 = "SELECT `g_id`,`otp_status` FROM `otp` WHERE `g_id`='$rsg_id';";
        $result2 = mysqli_query($Connector, $quary2);
        while ($row = mysqli_fetch_array($result2)) {
            $u++;
            $g_id2  = $row['g_id'];
            $st  = $row['otp_status'];
            if ($st == "verified") {
                $v++;
            }
        }
    }
    ?>

    <div class="container-fluid" style="margin: 0px;padding: 0px;">
        <!-- navBar -->
        <?php require_once '../src/nav.php'; ?>
        <!-- section 01 -->
        <div class="container-fluid">
            <div class="row justify-content-center" style="margin-top: 20px;">
                <div class="card bg-light col-11 col-sm-11 col-md-4 col-lg-3 col-xl-3 m-4 dash-count">
                    <div class="card-body">
                        <h5 class="card-title">Created Account Count:</h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?php echo "$u" ?></h6>
                    </div>
                </div>
                <div class="card bg-light col-11 col-sm-11 col-md-4 col-lg-3 col-xl-3 m-4 dash-count">
                    <div class="card-body">
                        <h5 class="card-title">Verified Account Count:</h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?php echo "$v" ?></h6>
                    </div>
                </div>
                <div class="card bg-light col-11 col-sm-11 col-md-4 col-lg-3 col-xl-3 m-4 dash-count">
                    <div class="card-body">
                        <h5 class="card-title">Group Count:</h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?php echo "$g" ?></h6>
                    </div>
                </div>
            </div>
        </div>
        <!-- section 02 -->
        <div class="container-fluid" style="margin-top: 20px;margin-bottom: 20px;">
            <center>
                <h3>Create Group</h3>
            </center>
            <?php
            require_once './config.php';
            if (isset($_POST['create'])) {
                //get data from db ->group id
                $quarye = "SELECT * FROM `user` WHERE `email`='$email';";
                $resulte_qw = mysqli_query($Connector, $quarye);
                while ($row = mysqli_fetch_array($resulte_qw)) {
                    $typ  = $row['acc_type'];
                    if ($typ != null) {
                        switch ($typ) {
                            case "lite":
                                $cc = 1;
                                break;
                            case "silver":
                                $cc = 2;
                                break;
                            case "gold":
                                $cc = 3;
                                break;
                        }
                    } else {
                        header('Location: ./price.php');
                        ob_end_flush();
                    }
                }
                //get data from db ->group id
                $quarye12 = "SELECT * FROM `c-group` WHERE `email`='$email';";
                $resulte_qw12 = mysqli_query($Connector, $quarye12);
                $n = 0;
                while ($row = mysqli_fetch_array($resulte_qw12)) {
                    $n++;
                    // $em  = $row['email'];
                }
                // echo "<script>alert('$n')</script>";
                if ($cc <= $n) {
                    echo "
                    <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Account Limit full!'
                      })
                    </script>
                    ";
                } else {
                    while (true) {
                        $nnn = rand(1, 100);
                        $id = $nnn .  "gg" . rand(1, 10000);
                        $query_insert = "SELECT * FROM `c-group` WHERE `g_id`='$id';";
                        $query_run_insert = mysqli_query($Connector, $query_insert);
                        if (mysqli_num_rows($query_run_insert) > 0) {
                            continue;
                        } else {
                            break;
                        }
                    }

                    $name = $_POST['group_name'];
                    $query_insert = "INSERT INTO `c-group` (`g_id`, `g_name`, `email`) VALUES ('$id', '$name', '$email');";
                    $query_run = mysqli_query($Connector, $query_insert);
                    if ($query_run) {
                        echo "
                        <script>
                        Swal.fire(
                            'Group Creates!',
                            'You Can use this group!',
                            'success'
                          )
                        </script>
                ";
                    } else {
                        echo "
                    <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Try Again!'
                      })
                    </script>
                    ";
                    }
                }
            }
            if (isset($_GET['gid'])) {
                $g_id = $_GET['gid'];
                //get data from db ->otp tb
                $quary3 = "SELECT * FROM `c-group` WHERE `g_id`='$g_id';";
                $result3 = mysqli_query($Connector, $quary3);
                $img = "";
                while ($row = mysqli_fetch_array($result3)) {
                    $img  = $row['img'];
                }
                if ($img != "") {
                    if (file_exists('../user-logo/' . $img)) {
                        unlink('../user-logo/' . $img);
                    }
                }

                $query_del = "DELETE FROM `c-group` WHERE `g_id` = '$g_id'";
                $query_run = mysqli_query($Connector, $query_del);
                $query_del2 = "DELETE FROM `otp` WHERE `g_id` = '$g_id'";
                $query_run2 = mysqli_query($Connector, $query_del2);
                if ($query_run && $query_del2) {
                    echo "
                        <script>
                        Swal.fire(
                            'Group Deleted!',
                            'All Data Cleared!',
                            'success'
                          )
                        </script>
                ";
                } else {
                    echo "
                    <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Try Again!'
                      })
                    </script>
                    ";
                }
            }
            ?>
            <form method="post">
                <div class="container" style="margin-bottom: 20px;">
                    <div class="row justify-content-center">
                        <div class="col-11 col-sm-11 col-md-11 col-lg-5 col-xl-5 m-2">
                            <input type="text" class="form-control" id="group_name" name="group_name" placeholder="Enter Group Name Here" style="text-align: center;" required>
                        </div>
                        <div class="col-11 col-sm-11 col-md-11 col-lg-3 col-xl-3 m-2" style="text-align: center;">
                            <button type="submit" class="btn btn-outline-dark" name="create" id="create">Create Group</button>
                        </div>
                    </div>
                </div>
            </form>
            <form method="post">
                <div class="container bg-light scl">
                    <table class="table table-hover scroll-item" style="text-align: center;">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Group ID</th>
                                <th scope="col">Group Name</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // $_SESSION["admin"] = $resuly_email;
                            $sql = "SELECT * FROM `c-group` WHERE email='$email' ";
                            $result = mysqli_query($Connector, $sql);
                            $i = 0;
                            while ($row = mysqli_fetch_array($result)) {
                                $i++;
                                $resuly_g_id  = $row['g_id'];
                                $resuly_g_name = $row['g_name'];
                                $resuly_email = $row['email'];
                            ?>
                                <tr>
                                    <th scope="row"><?php echo "$i"; ?></th>
                                    <td><?php echo "$resuly_g_id"; ?></td>
                                    <td><?php echo "$resuly_g_name"; ?></td>
                                    <td>
                                        <a href="./update.php?gid=<?php echo "$resuly_g_id"; ?>"><button type="button" class="btn btn-outline-success" name="update">Update</button></a>
                                        <a href="./featchure.php?gid=<?php echo "$resuly_g_id"; ?>"><button type="button" class="btn btn-outline-danger">Delete</button></a>
                                    </td>
                                </tr>
                            <?php
                            }
                            if ($i < 1) {
                            ?>
                                <tr>
                                    <th scope="row" colspan="4" style="text-align: center;">No Data !</th>
                                </tr>
                            <?php
                            }

                            ?>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>

    <?php
    require_once '../../pg/footer.php';
    ?>
</body>

</html>