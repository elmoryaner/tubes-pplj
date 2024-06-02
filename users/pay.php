<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['vpmsuid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $uid = $_SESSION['vpmsuid'];
        $ticketNumber = $_POST['ticketnumber'];
        $query = mysqli_query($con, "INSERT INTO tbltickets (ID, TicketNumber) VALUES ('$uid', '$ticketNumber')");
        if ($query) {
            echo '<script>alert("Ticket number saved successfully.")</script>';
            echo '<script>window.location.href="dashboard.php"</script>';
        } else {
            echo '<script>alert("Something went wrong. Please try again.")</script>';
        }
    }
?>
<!doctype html>
<html class="no-js" lang="">
<head>
    <title>VPMS - Ticket Input</title>

</head>
<body>
   <?php include_once('includes/sidebar.php');?>
   <?php include_once('includes/header.php');?>

    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>Dashboard</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="dashboard.php">Dashboard</a></li>
                                <li class="active">Ticket Input</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Input </strong> Ticket Number
                        </div>
                        <div class="card-body card-block">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="ticketnumber" class="form-control-label">Ticket Number</label></div>
                                    <div class="col-12 col-md-9"><input type="text" name="ticketnumber" required="true" class="form-control"></div>
                                </div>
                                <p style="text-align: center;">
                                    <button type="submit" class="btn btn-primary btn-sm" name="submit">Kirim</button>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

   <?php include_once('includes/footer.php');?>

</div>



</body>
</html>
<?php } ?>