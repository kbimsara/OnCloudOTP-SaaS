<?php
require_once '../src/session.php';
$featchure = "active"
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
    $g_id = $_GET['gid'];

    $quary = "SELECT * FROM `c-group` WHERE `g_id`='$g_id';";
    $result = mysqli_query($Connector, $quary);
    while ($row = mysqli_fetch_array($result)) {
        $g_id  = $row['g_id'];
        $g_name  = $row['g_name'];
        $email  = $row['email'];
        $img  = $row['img'];
        $rq = null;
        if ($img == null) {
            $img = "Enter Group Logo Here (png, jpg, jpeg)";
            $rq = "required";
        }
    }
    ?>

    <div class="container-fluid" style="margin: 0px;padding: 0px;">
        <!-- navBar -->
        <?php require_once '../src/nav.php'; ?>
        <!-- section 02 -->
        <div class="container-fluid" style="margin-top: 20px;margin-bottom: 20px;">
            <center>
                <h3>Update Group Data</h3>
            </center>
            <?php
            if (isset($_POST['update'])) {

                if ($_FILES["image"]["error"] === 4) {

                    $name = $_POST['name'];
                    $query_update = "UPDATE `c-group` SET `g_name` = '$name' WHERE `g_id` = '$g_id ';";
                    $query_run_update = mysqli_query($Connector, $query_update);
                    if ($query_run_update) {
                        echo "
                        <script>
                        Swal.fire(
                            'Group Updated!',
                            'You Can use this group!',
                            'success'
                          ).then(function() {
                            window.location = './featchure.php';
                        });
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
                } else {

                    $fname = $_FILES['image']['name'];
                    $ftype = $_FILES['image']['type'];
                    $fsize = $_FILES['image']['size'];
                    $temp_name = $_FILES['image']['tmp_name'];

                    $validImageExtention = ['jpg', 'jpeg', 'png'];
                    $imageExtention = explode('.', $fname);
                    $imageExtention = strtolower(end($imageExtention));
                    if (!in_array($imageExtention, $validImageExtention)) {
                        echo '<script>Swal.fire({
                        title: "Invalide Image Format",
                        text: "You can upload jpg , jpeg & png Files only !",
                        icon: "warning",
                        showCancelButton: true,
                      })
                      </script>';
                    } elseif ($fsize > 1000000) {
                        echo '<script>Swal.fire({
                        title: "Invalide Image Size !",
                        text: "You can upload logo File Size 2MB only !",
                        icon: "warning",
                        showCancelButton: true,
                      })
                      </script>';
                    } else {
                        if (file_exists('../user-logo/' . $img)) {
                            unlink('../user-logo/' . $img);
                        }
                        $newImageName = uniqid();
                        $newImageName = $newImageName . '.' . $imageExtention;
                        move_uploaded_file($temp_name, '../user-logo/' . $newImageName);

                        $name = $_POST['name'];
                        $query_update = "UPDATE `c-group` SET `g_name` = '$name', `img` = '$newImageName' WHERE `g_id` = '$g_id ';";
                        $query_run_update = mysqli_query($Connector, $query_update);
                        if ($query_run_update) {
                            echo "
                        <script>
                        Swal.fire(
                            'Group Updated!',
                            'You Can use this group!',
                            'success'
                          ).then(function() {
                            window.location = './featchure.php';
                        })
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
            }
            ?>
            <form method="post" enctype="multipart/form-data">
                <div class="container bg-light" style="margin-bottom: 20px;">
                    <div class="row justify-content-center">
                        <div class="col-12 col-sm-11 col-md-8 col-lg-5 col-xl-5 m-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Group ID:</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="111XXXXXX" disabled value="<?php echo "$g_id"; ?>">
                                <small id="emailHelp" class="form-text text-muted">Can't Change Group ID.</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Group Name:</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Your Name" required value="<?php echo "$g_name"; ?>">
                                <small id="emailHelp" class="form-text text-muted">New Name for Group.</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Group Logo:</label><br>
                                <input type="file" class="btn btn-outline-primary col-12 col-sm-11 col-md-8 col-lg-10 col-xl-10" id="image" name="image" <?php echo " $rq"; ?>>
                                <small id="emailHelp" class="form-text text-muted"><?php echo "$img"; ?>.</small>
                            </div>
                            <div class="form-group" style="text-align: center;">
                                <button type="submit" class="btn btn-outline-dark" name="update" id="update">Update Group</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <?php
    require_once '../../pg/footer.php';
    ?>
</body>

</html>