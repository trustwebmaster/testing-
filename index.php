<?php
session_start();
error_reporting(0);
include("includes/config.php");
$_SESSION['role'] = 'user';
if (isset($_POST['submit'])) {
    $tries = 3;
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $query = mysqli_query($con, "SELECT * FROM users WHERE idNumber='$username' and password='$password'");
    $num = mysqli_fetch_array($query);
    if ($num > 0) {
        $tries = 3;
        $_SESSION['alogin'] = $_POST['username'];
        $_SESSION['id'] = $num['id'];
        $_SESSION['email'] = $num['email'];
        $_SESSION['status'] = '';


        if ($num['role'] == 'user') {
            $host = $_SERVER['HTTP_HOST'];
            $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $extra = "general-user/trademark-history.php";
            header("location:http://$host$uri/$extra");
            exit();
        } else {
            $tries -= 1;
            if ($tries == 0) {
                $_SESSION['errmsg'] = "Invalid username or password. Contact your adminstrator.";
            } else {
                $_SESSION['errmsg'] = "Invalid username or password. " . $tries . " tries left.";
            }
        }
    } else {
        $tries -= 1;
        if ($tries == 0) {
            $_SESSION['errmsg'] = "Invalid username or password. Contact your adminstrator.";
        } else {
            $_SESSION['errmsg'] = "Invalid username or password. " . $tries . " tries left.";
            $extra = "index.php";
            $host  = $_SERVER['HTTP_HOST'];
            $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            header("location:http://$host$uri/$extra");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Trademark Registeration System</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body>
   <?php
error_reporting(0);
?>
<div class="navbar navbar-inverse set-radius-zero" style="background-color:rgb(75, 161, 231);">
    <div class="container row">
        <div class="navbar-header col align-content-center">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <img style="background-color:whitesmoke;" src="assets/img/Capture.png" alt="logo">
        </div>
        <a style="color:#fff; font-size:48px;4px; line-height:24px; padding-top:50px; float: right;">
            School Management Systems
        </a>
    </div>
</div>
<br/>
    </div>
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="page-head-line" style="color: #292650;">Please Login To Enter </h4>

                </div>

            </div>
            <span style="color:#292650;"><?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?></span>
            <span style="color:#292650;"><?php echo htmlentities($_SESSION['errmsg']); ?><?php echo htmlentities($_SESSION['errmsg'] = ""); ?></span>

            <form name="admin" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <label>Enter Username : </label>
                        <input type="text" name="username" class="form-control" required />
                        <label>Enter Password : </label>
                        <input type="password" name="password" class="form-control" required />
                        <hr />
                        <button type="submit" name="submit" class="btn btn-info"><span class="glyphicon glyphicon-user"></span> &nbsp;Log Me In </button>&nbsp;
                        <hr />
                        <a href="./new-user-registration.php">Don't have an account Already? Signup Now</a>
                    </div>
            </form>
            <div class="col-md-6">
                <div class="alert alert-info">
                    Welcome, please use your registered EC number as username to login
                    <br />
                    <br />
                    <a href='admin.php'>Login as Headmaster</a>
                </div>
            </div>

        </div>
    </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
    <?php include('includes/footer.php'); ?>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.11.1.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
</body>

</html>