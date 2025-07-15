<?php
require_once '../src/session.php';
$home = "active"
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
    <!-- Ajax js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

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
    $quarye = "SELECT * FROM `c-group` WHERE `email`='$email';";
    $resulte = mysqli_query($Connector, $quarye);
    $g = 0;
    $u = 0;
    $v = 0;
    while ($row = mysqli_fetch_array($resulte)) {
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
        <!-- <div class="container-fluid">
            <center>
                <h3>List Of Users</h3>
            </center>
            <div class="container bg-light scl">
                <table class="table table-hover scroll-item">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Date</th>
                            <th scope="col">Group</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>mark@gmail.com</td>
                            <td>2023/10/01</td>
                            <td>gpName</td>
                            <td>pending</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Mark</td>
                            <td>mark@gmail.com</td>
                            <td>2023/10/01</td>
                            <td>gpName</td>
                            <td>pending</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Mark</td>
                            <td>mark@gmail.com</td>
                            <td>2023/10/01</td>
                            <td>gpName</td>
                            <td>pending</td>
                        </tr>
                        <tr>
                            <th scope="row">4</th>
                            <td>Mark</td>
                            <td>mark@gmail.com</td>
                            <td>2023/10/01</td>
                            <td>gpName</td>
                            <td>pending</td>
                        </tr>
                        <tr>
                            <th scope="row">5</th>
                            <td>Mark</td>
                            <td>mark@gmail.com</td>
                            <td>2023/10/01</td>
                            <td>gpName</td>
                            <td>pending</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div> -->
        <!-- section 02 -->
        <div class="container-fluid" style="margin-top: 20px;margin-bottom: 20px;">
            <center>
                <h3>Filter Data</h3>
            </center>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-11 col-sm-11 col-md-11 col-lg-5 col-xl-5 m-2">
                        <h5>Group:</h5>
                        <select class="form-control" name="groupID" id="groupID" oninvalid="this.setCustomValidity('Please Seletc Option For Search')" onchange="FetchGroup(this.value)">
                            <option value="<?php echo "11:$email"; ?>" selected>Choose...</option>
                            <?php
                            //get data from db ->otp tb
                            $quary3 = "SELECT * FROM `c-group` WHERE `email`='$email';";
                            $result3 = mysqli_query($Connector, $quary3);
                            while ($row = mysqli_fetch_array($result3)) {
                                $drp_id  = $row['g_id'];
                                $drp_name  = $row['g_name'];
                            ?>
                                <option value="<?php echo "$drp_id"; ?>"><?php echo "$drp_name"; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-11 col-sm-11 col-md-11 col-lg-5 col-xl-5 m-2">
                        <h5>User Status:</h5>
                        <select class="form-control" name="st" id="st" oninvalid="this.setCustomValidity('Please Seletc Option For Search')" onchange="FetchSt(this.value)">
                            <option value="" selected>Choose...</option>
                            <option value="Verified">Verified</option>
                            <option value="pending">pending</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="container bg-light scl" style="margin-top: 20px;">
                <table class="table table-hover scroll-item">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">OTP</th>
                            <th scope="col">Email</th>
                            <th scope="col">Date</th>
                            <th scope="col">Group</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody id="user-tb" name="user-tb">
                        <?php
                        $sql = "SELECT * FROM `c-group` JOIN `otp` ON `c-group`.`g_id`=`otp`.`g_id` WHERE `c-group`.`email`='$email';";
                        $result = mysqli_query($Connector, $sql);
                        $i = 0;
                        while ($row = mysqli_fetch_array($result)) {
                            $i++;
                            $otp  = $row['otp'];
                            $email  = $row['email'];
                            $time  = $row['time'];
                            $g_id  = $row['g_id'];
                            $otp_status  = $row['otp_status'];
                        ?>
                            <tr>
                                <th scope="row"><?php echo "$i"; ?></th>
                                <td><?php echo "$otp"; ?></td>
                                <td><?php echo "$email"; ?></td>
                                <td><?php echo "$time"; ?></td>
                                <td><?php echo "$g_id"; ?></td>
                                <td><?php echo "$otp_status"; ?></td>
                            </tr>
                        <?php
                        }
                        if ($i < 1) {
                        ?>
                            <tr style="text-align: center;">
                                <td colspan="6">No users in HERE !!</td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    -->

    <script>
        // var s = document.getElementById("st").value;

        function FetchGroup(id) {
            var s = document.getElementById("st").value;
            $('#user-tb').html('');
            $.ajax({
                type: 'post',
                url: 'ajaxdata.php',
                data: {
                    groupID: id,
                    st: s
                },
                success: function(data) {
                    $('#user-tb').html(data);
                }

            })

        }

        function FetchSt(id) {
            var gp = document.getElementById("groupID").value;
            $('#user-tb').html('');
            $.ajax({
                type: 'post',
                url: 'ajaxdata.php',
                data: {
                    st: id,
                    g_id: gp
                },
                success: function(data) {
                    $('#user-tb').html(data);
                }

            })

        }
    </script>
    
    <?php
    require_once '../../pg/footer.php';
    ?>
</body>

</html>