<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['vpmsuid']) == 0) {
    header('location:logout.php');
    exit();
} else {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['payment_method'])) {
        $uid = $_SESSION['vpmsuid'];
        $payment_method = $_POST['payment_method'];
        $payment_amount = $_POST['payment_amount'];


        $ticket_number = $_SESSION['nomorTiket'];

        // Simpan detail pembayaran ke database (misal ke tabel tblriwayat)
        $query = mysqli_query($con, "INSERT INTO tblriwayat (UserID, metodePembayaran, jumlahPembayaran, nomorTiket) VALUES ('$uid', '$payment_method', '$payment_amount', '$ticket_number')");

        if ($query) {
            // Kurangi saldo sesuai metode pembayaran yang dipilih
            if ($payment_method == 'GoPay') {
                $update_balance = mysqli_query($con, "UPDATE tblsaldo SET GoPay = GoPay - $payment_amount WHERE ID = $uid");
            } elseif ($payment_method == 'DANA') {
                $update_balance = mysqli_query($con, "UPDATE tblsaldo SET DANA = DANA - $payment_amount WHERE ID = $uid");
            }

            if ($update_balance) {
                echo '<script>alert("Pembayaran berhasil.")</script>';
                echo '<script>window.location.href="tiketdigital.php"</script>';
                //$update_ticket = mysqli_query($con, "DELETE FROM tbltickets WHERE ticketNumber = '$ticket_number'");
                exit();
            } else {
                echo '<script>alert("Terjadi kesalahan saat mengupdate saldo. Silakan coba lagi.")</script>';
            }
        } else {
            echo '<script>alert("Terjadi kesalahan saat menyimpan detail pembayaran. Silakan coba lagi.")</script>';
        }
    }

    // Query untuk mendapatkan nilai dari tabel tblsaldo
    $uid = $_SESSION['vpmsuid'];
    $query = mysqli_query($con, "SELECT GoPay, DANA FROM tblsaldo WHERE ID=$uid"); // Asumsikan ID=$uid adalah data yang ingin diambil
    $row = mysqli_fetch_array($query);
    $gopay_value = $row['GoPay'];
    $dana_value = $row['DANA'];

    // Ambil totalBiaya dari session
    $totalBiaya = $_SESSION['totalBiaya'];
?>
<!doctype html>
<html class="no-js" lang="">
<head>
    <title>VPMS - Pilih Metode Pembayaran</title>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <style>
        .container {
            text-align: center;
            margin-top: 50px;
        }
        .payment-option {
            display: inline-block;
            margin: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 200px;
            cursor: pointer;
        }
        .payment-option:hover {
            background-color: #f0f0f0;
        }
        .sufficient {
            background-color: #d4edda; /* Green background */
        }
        .insufficient {
            background-color: #f8d7da; /* Red background */
        }
        .btn-back {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .btn-back:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Konfirmasi Pembayaran</h2>
        <div class="payment-option <?php echo ($gopay_value >= $totalBiaya) ? 'sufficient' : 'insufficient'; ?>" onclick="selectPayment('GoPay', <?php echo $gopay_value; ?>)">
            <h3>GoPay</h3>
            <p>Jumlah: Rp<?php echo number_format($gopay_value, 0, ',', '.'); ?></p>
        </div>
        <div class="payment-option <?php echo ($dana_value >= $totalBiaya) ? 'sufficient' : 'insufficient'; ?>" onclick="selectPayment('DANA', <?php echo $dana_value; ?>)">
            <h3>DANA</h3>
            <p>Jumlah: Rp<?php echo number_format($dana_value, 0, ',', '.'); ?></p>
        </div>
        <p>Total Biaya: Rp<?php echo number_format($totalBiaya, 0, ',', '.'); ?></p>
        <a href="dashboard.php" class="btn-back">Kembali ke Dashboard</a>
    </div>

    <form id="paymentForm" action="" method="post" style="display: none;">
        <input type="hidden" name="payment_method" id="paymentMethod">
        <input type="hidden" name="payment_amount" id="paymentAmount">
    </form>

    <script>
        function selectPayment(method, amount) {
            var totalBiaya = <?php echo $totalBiaya; ?>;
            if (amount < totalBiaya) {
                alert("Error: Saldo tidak cukup.");
            } else {
                document.getElementById('paymentMethod').value = method;
                document.getElementById('paymentAmount').value = totalBiaya; // Pastikan jumlah yang dikirim adalah total biaya
                document.getElementById('paymentForm').submit();
            }
        }
    </script>
</body>
</html>
<?php } ?>
