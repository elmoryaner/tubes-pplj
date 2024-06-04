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
    <title>Cek Saldo</title>

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
        .content {
            margin-top: 50px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px 12px;
            text-align: left;
            border: 1px solid #ccc;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .footer {
            text-align: center;
            padding: 20px 0;
            background-color: #343a40;
            color: #fff;
        }
    </style>
</head>
<body>
    <?php include_once('includes/header.php'); ?>

    <div class="content container">
        <div class="animated fadeIn">
            <div class="row justify-content-center">
                <div class="col-lg-12 mb-4">
                    <h3>Cek Saldo</h3><br>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>GoPay</th>
                                <th>DANA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Retrieve saldo data
                            $uid = $_SESSION['vpmsuid']; // Securely retrieve vpmsuid from session
                            $query = mysqli_query($con, "SELECT GoPay, DANA FROM tblsaldo WHERE ID = '$uid'");

                            // Check if there is any saldo data for the current user (vpmsuid)
                            if (mysqli_num_rows($query) > 0) {
                                $row = mysqli_fetch_array($query);
                                echo '<tr>';
                                // Only display GoPay and DANA values if present
                                echo (isset($row['GoPay']) ? '<td>Rp ' . $row['GoPay'] . '</td>' : '<td>-</td>');
                                echo (isset($row['DANA']) ? '<td>Rp ' . $row['DANA'] . '</td>' : '<td>-</td>');
                                echo '</tr>';
                            } else {
                                echo '<tr><td colspan="2">Tidak ada data saldo yang ditemukan.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                    <a href="dashboard.php" class="btn btn-primary mt-4">Kembali</a>
                </div>
            </div>
        </div>
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
