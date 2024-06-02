<?php
session_start();
//error_reporting(0);
include('includes/dbconnection.php');
if(isset($_POST['login']))
  {
    $emailcon=$_POST['emailcont'];
    $password=md5($_POST['password']);
    $query=mysqli_query($con,"select ID,MobileNumber from tblregusers where  (Email='$emailcon' || MobileNumber='$emailcon') && Password='$password' ");
    $ret=mysqli_fetch_array($query);
    if($ret>0){
      $_SESSION['vpmsuid']=$ret['ID'];
      $_SESSION['vpmsumn']=$ret['MobileNumber'];
     header('location:dashboard.php');
    }
    else{
  
    echo "<script>alert('Invalid Details.');</script>";
    }
  }
  ?>
<!doctype html>
 <html class="no-js" lang="">
<head>
    
    <title>VPMS-Login Page</title>

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
</head>
<body class="bg-dark">

    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="index.php">
                        <h2 style="color: #fff">VPMS!! Sign in</h2>
                    </a>
                </div>
                <div class="login-form">
                    <form method="post">
                         
                        <div class="form-group">
                            <label>Registered Email or Contact Number</label>
                           <input type="text" name="emailcont" required="true" placeholder="Registered Email or Contact Number" required="true" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" placeholder="Enter password" required="true" class="form-control">
                        </div>
                        <button type="submit" name="login" class="btn btn-success btn-flat m-b-30 m-t-30">Sign in</button>
                        <div class="checkbox" style="padding-bottom: 20px;padding-top: 20px;">
                            
                            <label class="pull-right" >
                                <a href="../index.php">Home</a>
                            </label>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="../admin/assets/js/main.js"></script>

</body>
</html>
