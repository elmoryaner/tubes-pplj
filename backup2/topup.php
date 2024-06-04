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
    <title>VPMS - Topup Saldo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
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
    <div class="center-form">
        <div class="form-container">
            <h2>Topup Saldo</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="topupAmount">Jumlah Topup</label>
                    <input type="number" name="topupAmount" required="true" class="form-control" id="topupAmount">
                </div>
                <div class="form-group">
                    <label for="paymentMethod">Metode Pembayaran</label>
                    <select name="paymentMethod" required="true" class="form-control" id="paymentMethod">
                        <option value="GoPay">GoPay</option>
                        <option value="DANA">DANA</option>
                    </select>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary" name="submit">Topup</button>
                </div>
            </form>
            <div class="text-center mt-3">
                <a href="dashboard.php" class="btn btn-secondary">Kembali ke Dashboard</a>
            </div>
        </div>
    </div>
</body>
</html>
<?php } ?>
