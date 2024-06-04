<?php
session_start();

// Error handling (optional but recommended)
if (!isset($_SESSION['vpmsuid'])) {
  header('location:logout.php');
  exit();
}

error_reporting(E_ALL & ~E_NOTICE); // Report all errors except notices

include('includes/dbconnection.php');
date_default_timezone_set('Asia/Jakarta');

$uid = $_SESSION['vpmsuid'];

$ticket_number = $_SESSION['nomorTiket'];
$update_ticket = mysqli_query($con, "DELETE FROM tbltickets WHERE ticketNumber = '$ticket_number'");
$update_ticket2 = mysqli_query($con, "DELETE FROM tbltiketdigital WHERE ticketNumber = '$ticket_number'");

//echo '<script>window.location.href="dashboard.php"</script>';

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Berhasil Bayar (Payment Failed)</title>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">

  <link rel="stylesheet" href="../admin/assets/css/cs-skin-elastic.css">
  <link rel="stylesheet" href="../admin/assets/css/style.css">

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
    #status {
      font-weight: bold;
      color: #dc3545; /* Adjust color for error message */
    }
  </style>
</head>
<body>
  <div class="center-form">
    <div class="form-container">
      <h2>Berhasil Bayar </h2>
      <div id="status">
        <p>Transaksi pembayaran Anda selesai.</p>
        </div>
        <a href="dashboard.php" class="btn btn-primary">Back</a>
    </div>
  </div>
</body>
</html>