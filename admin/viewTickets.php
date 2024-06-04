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
    <title>Lihat Daftar Tiket</title>
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
                    <h3>Daftar Tiket</h3><br>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nomor Tiket</th>
                                <th>ID Pengguna</th>
                                <th>Waktu Masuk</th>
                                <th>Nomor Plat</th>
                                <th>Tipe Kendaraan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Retrieve all ticket data
                            $query = mysqli_query($con, "SELECT ticketNumber, UserID, waktuMasuk, nomor_plat, jenis_kendaraan FROM tbltickets");

                            // Check if there are any tickets found
                            if (mysqli_num_rows($query) > 0) {
                                while ($row = mysqli_fetch_array($query)) {
                                    // Format the timestamp for better readability (optional)
                                    $formattedTime = date('d-M-Y H:i:s', strtotime($row['waktuMasuk']));
                                    echo '<tr>';
                                    echo '<td>' . $row['ticketNumber'] . '</td>';
                                    echo '<td>' . $row['UserID'] . '</td>';
                                    echo '<td>' . $formattedTime . '</td>'; // Display formatted timestamp
                                    echo '<td>' . $row['nomor_plat'] . '</td>';
                                    echo '<td>' . $row['jenis_kendaraan'] . '</td>';
                                    echo '</tr>';
                                }
                            } else {
                                echo '<tr><td colspan="5">Tidak ada tiket yang ditemukan.</td></tr>';
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
