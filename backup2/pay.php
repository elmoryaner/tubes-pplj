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
        $_SESSION['nomorTiket'] = $_POST['ticketnumber'];
        $ticketNumber = $_SESSION['nomorTiket'];
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

            $_SESSION["totalBiaya"] = $totalBiaya;
            echo '<script>window.location.href="konfirmasi.php"</script>';
        } else {
            echo '<script>alert("Ticket number not found. Please try again.")</script>';
        }
    }
?>
<!doctype html>
<html lang="en">
<head>
    <title>VPMS - Ticket Input</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <?php include_once('includes/sidebar.php');?>
    <?php include_once('includes/header.php');?>
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
            <h2>Pembayaran Digital</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="ticketnumber">Nomor Tiket</label>
                    <input type="text" name="ticketnumber" required="true" class="form-control" id="ticketnumber">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary" name="submit">Bayar</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<?php } ?>
