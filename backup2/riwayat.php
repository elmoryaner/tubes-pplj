<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['vpmsuid']) == 0) {
    header('location:logout.php');
    exit();
} else {
    // Get the current user's ID
    $uid = $_SESSION['vpmsuid'];

    // Retrieve payment history data for the current user
    $query = mysqli_query($con, "SELECT metodePembayaran, jumlahPembayaran, nomorTiket, waktuPembayaran FROM tblriwayat WHERE UserID = $uid");

    // Check if there are any payment records found
    if (mysqli_num_rows($query) > 0) {
        ?>
        <!DOCTYPE html>
        <html class="no-js" lang="">
        <head>
            <title>VPMS - Riwayat Pembayaran</title>
            <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
            <style>
                body {
                    font-family: 'Open Sans', sans-serif;
                    margin: 20px;
                }

                table {
                    width: 100%;
                    border-collapse: collapse;
                    border: 1px solid #ccc;
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

                .btn-back {
                    display: block;
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
        <h1>Riwayat Pembayaran</h1>

        <table>
            <thead>
                <tr>
                    <th>Metode Pembayaran</th>
                    <th>Jumlah Pembayaran</th>
                    <th>Nomor Tiket</th>
                    <th>Waktu Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_array($query)) {
                    echo '<tr>';
                    echo '<td>' . $row['metodePembayaran'] . '</td>';
                    echo '<td>Rp' . number_format($row['jumlahPembayaran'], 0, ',', '.') . '</td>';
                    echo '<td>' . $row['nomorTiket'] . '</td>';
                    echo '<td>' . $row['waktuPembayaran'] . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>

        <a href="dashboard.php" class="btn-back">Kembali ke Dashboard</a>

        </body>
        </html>
        <?php
    } else {
        echo '<p>Tidak ada riwayat pembayaran yang ditemukan.</p>';
    }
}
?>
