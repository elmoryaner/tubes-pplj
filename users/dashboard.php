<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
error_reporting(0);
if (strlen($_SESSION['vpmsuid']==0)) {
  header('location:logout.php');
  } else{ ?>


<!doctype html>
<html class="no-js" lang="">
    <head>
        
        <title>User Dashboard</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">

        <link rel="stylesheet" href="../admin/assets/css/cs-skin-elastic.css">
        <link rel="stylesheet" href="../admin/assets/css/style.css">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800'>

        <meta name="viewport" content="width=device-width, initial-scale=1">

    </head>

    <body>
        
    <?php include_once('includes/header.php');?>

            <!-- Content -->
            <div class="content">
                <!-- Animated -->
                <div class="animated fadeIn">
                    <!-- Widgets  -->
                    <div class="row">
                        <div class="col-lg-12 col-md-6">
                            <div class="card text-center" style="width: auto;">
                            <div class="card-body">
                                <?php
                                    $uid=$_SESSION['vpmsuid'];
                                    $ret=mysqli_query($con,"select * from tblregusers where ID='$uid'");
                                    $cnt=1;
                                    while ($row=mysqli_fetch_array($ret)) {
                                ?> 
                                <h3 class="stat-icon dib flat-color-1 text-black text-center">
                                    Welcome, <?php  echo $row['FirstName'];?> <?php  echo $row['LastName'];?>
                                </h3>
                                <?php } ?>
                                <p class="card-text"></p>
                                <a href="pay.php" class="btn btn-primary">Pay Now</a>
                            </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        <?php include_once('includes/footer.php');?>

        <!-- /#right-panel -->

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
        <script src="../admin/assets/js/main.js"></script>

    </body>
</html>

<?php } ?>
