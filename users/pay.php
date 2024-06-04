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
        $query = mysqli_query($con, "SELECT waktuMasuk,jenis_kendaraan, nomor_plat FROM tbltickets WHERE ticketNumber='$ticketNumber'");
        $row = mysqli_fetch_array($query);
        $jenisKendaraan = $row['jenis_kendaraan'];
        $_SESSION['jenisKendaraan'] = $jenisKendaraan;

        $nomorPlat = $row['nomor_plat'];
        $_SESSION['nomorPlat'] = $nomorPlat;

        if ($row) {
            $waktuMasuk = $row['waktuMasuk'];
            $waktuMasukTimestamp = strtotime($waktuMasuk);
            $waktuSekarangTimestamp = time();
            $selisihDetik = $waktuSekarangTimestamp - $waktuMasukTimestamp;
            $selisihJam = ceil($selisihDetik / 3600); // Pembulatan ke atas untuk jam
            
            if ($jenisKendaraan == 'Motor') {
                $hargaPerJam = 2000;
                $_SESSION['hargaPerJam'] = $hargaPerJam; // Contoh harga per jam
                $totalBiaya = $selisihJam * $hargaPerJam;
            } elseif ($jenisKendaraan == 'Mobil') {
                $hargaPerJam = 5000;
                $_SESSION['hargaPerJam'] = $hargaPerJam; // Contoh harga per jam
                $totalBiaya = $selisihJam * $hargaPerJam;
            }

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
    <title>Ticket Input</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">

    <link rel="stylesheet" href="../admin/assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="../admin/assets/css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800'>

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