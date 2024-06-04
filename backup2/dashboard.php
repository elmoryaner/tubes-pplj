<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['vpmsuid'] == 0)) {
    header('location:logout.php');
} else {
?>

<!doctype html>
<html lang="en">
<head>
    <title>User Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f8f9fa;
        }
        .content {
            margin-top: 50px;
        }
        .option-card {
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: transform 0.2s;
        }
        .option-card:hover {
            transform: scale(1.05);
        }
        .option-card h3 {
            font-size: 24px;
            margin-bottom: 10px;
            color: #007bff;
        }
        .option-card p {
            font-size: 18px;
            color: #343a40;
        }
        .footer {
            text-align: center;
            padding: 20px 0;
            background-color: #343a40;
            color: #fff;
        }
    </style>
</head>
<body>
    <?php include_once('includes/sidebar.php');?>
    <?php include_once('includes/header.php');?>

    <!-- Content -->
    <div class="content container">
        <!-- Animated -->
        <div class="animated fadeIn">
            <!-- Options -->
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="option-card" onclick="location.href='pay.php'">
                        <h3>Bayar Parkir</h3>
                        <p>Lanjutkan untuk membayar parkir Anda</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="option-card" onclick="location.href='riwayat.php'">
                        <h3>Riwayat Transaksi</h3>
                        <p>Lanjutkan untuk membayar parkir Anda</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="option-card" onclick="location.href='ceksaldo.php'">
                        <h3>Cek Saldo</h3>
                        <p>Cek saldo anda</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="option-card" onclick="location.href='topup.php'">
                        <h3>Topup Saldo</h3>
                        <p>Isi ulang saldo parkir Anda</p>
                    </div>
                </div>
            </div>
            <!-- /Options -->
        </div>
        <!-- .animated -->
    </div>
    <!-- /.content -->

    <!-- Footer -->
    <div class="footer">
        <?php include_once('includes/footer.php');?>
    </div>
    <!-- /.footer -->
</body>
</html>
<?php } ?>
