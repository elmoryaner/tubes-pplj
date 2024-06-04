<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['vpmsuid']) == 0) {
    header('location:logout.php');
    exit();
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Lihat Riwayat</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">

    <link rel="stylesheet" href="../admin/assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="../admin/assets/css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800'>

    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
    <?php include_once('includes/header.php'); ?>

    <div class="content container">
        <div class="animated fadeIn">
            <div class="row justify-content-center">
                <div class="col-lg-12 mb-4">
                    <div class="card-header">
                        <h3>Riwayat Pembayaran</h3><br>
                    </div>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>UserID</th>
                                <th>Metode Pembayaran</th>
                                <th>Jumlah Pembayaran</th>
                                <th>Nomor Tiket</th>
                                <th>Waktu Pembayaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Retrieve specific columns from tblriwayat
                            $query = mysqli_query($con, "SELECT tblriwayat.UserID, tblriwayat.metodePembayaran, tblriwayat.jumlahPembayaran, tblriwayat.nomorTiket, tblriwayat.waktuPembayaran FROM tblriwayat");

                            // Check if there are any history entries found
                            if (mysqli_num_rows($query) > 0) {
                                while ($row = mysqli_fetch_array($query)) {
                                    echo '<tr>';
                                    echo '<td>' . $row['UserID'] . '</td>';
                                    echo '<td>' . $row['metodePembayaran'] . '</td>';
                                    echo '<td>' . $row['jumlahPembayaran'] . '</td>';
                                    echo '<td>' . $row['nomorTiket'] . '</td>';
                                    echo '<td>' . $row['waktuPembayaran'] . '</td>';
                                    echo '</tr>';
                                }
                            } else {
                                echo '<tr><td colspan="5">Tidak ada riwayat yang ditemukan.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <?php include_once('includes/footer.php'); ?>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="../admin/assets/js/main.js"></script>
    </body>
</html>
<?php } ?>
