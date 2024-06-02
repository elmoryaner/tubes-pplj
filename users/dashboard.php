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
</head>

<body>
    
   <?php include_once('includes/sidebar.php');?>

        <?php include_once('includes/header.php');?>
      
        <!-- Content -->
        <div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">
                <!-- Widgets  -->
                <div class="row">
                   
                    <div class="col-lg-12 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <?php
$uid=$_SESSION['vpmsuid'];
$ret=mysqli_query($con,"select * from tblregusers where ID='$uid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {
    ?> 
                                    <div class="stat-icon dib flat-color-1">
                                        Welcome to panel !! <?php  echo $row['FirstName'];?> <?php  echo $row['LastName'];?>
                                    </div>
                                    <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /Widgets -->
               
            </div>
            <!-- .animated -->
        </div>
        <!-- /.content -->
        <div class="clearfix"></div>
        <!-- Footer -->
       <?php include_once('includes/footer.php');?>
</body>
</html>
<?php } ?>