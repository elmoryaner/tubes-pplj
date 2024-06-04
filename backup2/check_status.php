<?php
// Koneksi ke database
session_start();
include('includes/dbconnection.php');

// Cek koneksi
if (!$con) {
    die('Koneksi database gagal: ' . mysqli_connect_error());
}

// Nomor Tiket yang akan dicek
$digitalNumber = $_SESSION["randomCode"];
$ticket_number = $_SESSION['nomorTiket'];

// Query untuk mendapatkan status tiket
$query = "SELECT sudahBayar FROM tbltiketdigital WHERE ticketNumber = '$ticket_number' and digitalTicket = '$digitalNumber'";
$result = mysqli_query($con, $query);

if ($result) {
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        echo $row['sudahBayar'];
    } else {
        echo '0'; // Nomor Tiket tidak ditemukan
    }
} else {
    echo 'Error dalam mengecek status tiket.';
}

mysqli_close($con);
?>
