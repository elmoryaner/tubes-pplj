<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
date_default_timezone_set('Asia/Jakarta');

if (strlen($_SESSION['vpmsuid']) == 0) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $uid = $_SESSION['vpmsuid'];
        $ticketNumber = $_POST['ticketnumber'];
        $query = mysqli_query($con, "SELECT waktuMasuk FROM tbltickets WHERE ticketNumber='$ticketNumber'");
        $row = mysqli_fetch_array($query);

        if ($row) {
            $waktuMasuk = $row['waktuMasuk'];
            $waktuMasukTimestamp = strtotime($waktuMasuk);
            $waktuSekarangTimestamp = time();
            $selisihDetik = $waktuSekarangTimestamp - $waktuMasukTimestamp;
            $selisihJam = ceil($selisihDetik / 3600); // Pembulatan ke atas untuk jam

            $hargaPerJam = 10000; // Contoh harga per jam
            $totalBiaya = $selisihJam * $hargaPerJam;

            $_SESSION['totalBiaya'] = $totalBiaya;
            echo '<script>window.location.href="konfirmasi.php"</script>';
        } else {
            echo '<script>alert("Ticket number not found. Please try again.")</script>';
        }
    }
?>
<!doctype html>
<html class="no-js" lang="">
<head>
    <title>Ticket Input</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">

    <link rel="stylesheet" href="../admin/assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="../admin/assets/css/style.css">

    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
   <?php include_once('includes/sidebar.php');?>
   <?php include_once('includes/header.php');?>

   <div class="content animated fadeIn">
    <div class="row">
        <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
            <strong>Input Ticket Number</strong>
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


    <div class="clearfix"></div>

   <?php include_once('includes/footer.php');?>

</div>



</body>
</html>
<?php } ?>