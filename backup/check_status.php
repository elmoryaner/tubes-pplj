<?php
// Koneksi ke database
include('includes/dbconnection.php');

// Cek koneksi
if (!$con) {
    die('Koneksi database gagal: ' . mysqli_connect_error());
}

// Nomor Tiket yang akan dicek
$ticketNumber = 2;

// Query untuk mendapatkan status tiket
$query = "SELECT sudahBayar FROM tbltiketdigital WHERE ticketNumber = '$ticketNumber'";
$result = mysqli_query($con, $query);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
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
