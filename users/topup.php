<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['vpmsuid']) == 0) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $uid = $_SESSION['vpmsuid'];
        $topupAmount = $_POST['topupAmount'];
        $paymentMethod = $_POST['paymentMethod'];

        if ($paymentMethod == 'GoPay') {
            $query = "UPDATE tblsaldo SET GoPay = GoPay + $topupAmount WHERE ID = $uid";
        } elseif ($paymentMethod == 'DANA') {
            $query = "UPDATE tblsaldo SET DANA = DANA + $topupAmount WHERE ID = $uid";
        }

        if (mysqli_query($con, $query)) {
            echo '<script>alert("Saldo berhasil ditambahkan.");</script>';
            echo '<script>window.location.href="dashboard.php";</script>';
        } else {
            echo '<script>alert("Terjadi kesalahan, silakan coba lagi.");</script>';
        }
    }
?>
<!doctype html>
<html lang="en">
<head>
    <title>Topup Saldo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="../admin/assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="../admin/assets/css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f8f9fa;
        }
        .center-form {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-container h2 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<?php include_once( 'includes/header.php');?>
    <div class="center-form">
        <div class="form-container">
            <h2>Top Up Saldo</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="topupAmount">Jumlah Topup</label>
                    <input type="number" name="topupAmount" required="true" class="form-control" id="topupAmount">
                </div>
                <h2></h2>
                <div class="form-group">
                    <label for="paymentMethod">Metode Pembayaran</label>
                    <select name="paymentMethod" required="true" class="form-control" id="paymentMethod">
                        <option value="GoPay">GoPay</option>
                        <option value="DANA">DANA</option>
                    </select>
                </div>
                <h2></h2>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary" name="submit">Top up</button>
                </div>
            </form>
            <div class="text-center mt-3">
                <a href="dashboard.php" class="btn btn-secondary">Kembali ke Dashboard</a>
            </div>
        </div>
    </div>

    <!-- .content -->
    <div class="clearfix">
    </div>
    <?php include_once( 'includes/footer.php');?>
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js">
    </script>
    <script src="../admin/assets/js/main.js">
    </script>
</body>
</html>
<?php } ?>
