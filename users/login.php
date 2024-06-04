<?php
session_start();
//error_reporting(0);
include('includes/dbconnection.php');
if (isset($_POST['login'])) {
    $emailcon = $_POST['emailcont'];
    $password = md5($_POST['password']);
    $query = mysqli_query($con, "SELECT ID, MobileNumber FROM tblregusers WHERE (Email='$emailcon' || MobileNumber='$emailcon') AND Password='$password'");
    $ret = mysqli_fetch_array($query);
    if ($ret) {
        $_SESSION['vpmsuid'] = $ret['ID'];
        $_SESSION['vpmsumn'] = $ret['MobileNumber'];
        header('location:dashboard.php');
        exit();
    } else {
        echo "<script>alert('Invalid Details.');</script>";
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>VPMS - Login Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            background-color: #343a40;
            color: #fff;
            font-family: 'Open Sans', sans-serif;
        }
        .login-content {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background-color: #444;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }
        .login-logo h2 {
            color: #fff;
        }
        .form-control {
            background-color: #555;
            color: #fff;
            border: none;
        }
        .form-control:focus {
            background-color: #666;
            color: #fff;
        }
        .btn-success {
            background-color: #28a745;
            border: none;
        }
        .btn-success:hover {
            background-color: #218838;
        }
        a {
            color: #fff;
        }
        a:hover {
            color: #ccc;
        }
    </style>
</head>
<body>
    <div class="login-content">
        <div class="login-logo">
            <a href="index.php">
                <h2>Silakan Login Terlebih Dahulu</h2>
            </a>
        </div>
        <div class="login-form">
            <form method="post">
                <div class="form-group">
                    <label>Email atau Username</label>
                    <input type="text" name="emailcont" required="true" placeholder="Registered Email or Contact Number" class="form-control">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter password" required="true" class="form-control">
                </div>
                <div class="form-group d-flex justify-content-between">
                    <a href="forgot-password.php">Lupa Password?</a>
                    <a href="signup.php">Daftar</a>
                </div>
                <button type="submit" name="login" class="btn btn-success btn-block">Sign in</button>
                <div class="text-center mt-3">
                    <a href="../index.php">Home</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
