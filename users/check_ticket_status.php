<?php
// Include your database connection and any necessary configurations
include('includes/dbconnection.php');

// Get the randomCode from the GET parameters
$randomCode = $_GET['randomCode'];

// Check if the ticket is paid
$query = "SELECT sudahBayar FROM tbltiketdigital WHERE digitalTicket = '$randomCode'"; // Change this query as per your database schema
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $sudahBayar = $row['sudahBayar'];
    echo json_encode(['sudahBayar' => $sudahBayar]);
} else {
    echo json_encode(['sudahBayar' => 0]);
}

mysqli_close($con);
?>
