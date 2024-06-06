<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
date_default_timezone_set('Asia/Jakarta');

if (strlen($_SESSION['vpmsuid']) == 0) {
    header('location:logout.php');
} else {
    $uid = $_SESSION['vpmsuid'];
    $digitalNumber = $_SESSION["randomCode"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cek Status Tiket</title>
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
    </style>
</head>
<body>
    <div class="center-form">
        <div class="form-container">
            <h2>Pembayaran Digital</h2>
            <p>Kode Tiket Digital : <?php echo $digitalNumber ; ?></p>
            <div id="status"></div>
            <div id="timer"></div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var secondsLeft = 600; // 10 menit
            var interval = setInterval(function() {
                if (secondsLeft <= 0) {
                    clearInterval(interval);
                    window.location.href = 'gagalbayar.php';
                }

                var ticketNumber = 0;

                $.ajax({
                    url: 'check_status.php',
                    type: 'POST',
                    data: { ticketNumber: ticketNumber },
                    success: function(response) {
                        $('#status').html('Status Tiket: ' + response);

                        if (response === 'Sudah Bayar' || response === '1') {
                            clearInterval(interval);
                            window.location.href = 'berhasil_bayar.php';
                        }
                    }
                });

                secondsLeft--;
                $('#timer').html('Timer: ' + secondsToTime(secondsLeft));
            }, 1000);

            function secondsToTime(secs) {
                var hours = Math.floor(secs / (60 * 60));
                var divisor_for_minutes = secs % (60 * 60);
                var minutes = Math.floor(divisor_for_minutes / 60);
                var divisor_for_seconds = divisor_for_minutes % 60;
                var seconds = Math.ceil(divisor_for_seconds);
                return hours + ' Jam ' + minutes + ' Menit ' + seconds + ' Detik';
            }
        });
    </script>
</body>
</html>
<?php } ?>
