<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
date_default_timezone_set('Asia/Jakarta');

if (strlen($_SESSION['vpmsuid']) == 0) {
    header('location:logout.php');
} else {
    $uid = $_SESSION['vpmsuid'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cek Status Tiket</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <?php include_once('includes/sidebar.php'); ?>
    <?php include_once('includes/header.php'); ?>
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
            <div id="status"></div>
            <div id="timer"></div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var secondsLeft = 20; // 10 menit
            var interval = setInterval(function() {
                if (secondsLeft <= 0) {
                    clearInterval(interval);
                    window.location.href = 'dashboard.php';
                }

                var ticketNumber = 2; // Nomor Tiket diset menjadi 1

                $.ajax({
                    url: 'check_status.php',
                    type: 'POST',
                    data: { ticketNumber: ticketNumber },
                    success: function(response) {
                        $('#status').html('Status Tiket: ' + response);

                        if (response === 'Sudah Bayar' || response === '1') {
                            clearInterval(interval);
                            window.location.href = 'dashboard.php';
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
