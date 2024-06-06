<?php
set_time_limit(0);
$host = "10.6.107.90";
$port = 8080;

$socket = socket_create(AF_INET, SOCK_STREAM, 0);
socket_bind($socket, $host, $port) or die("Could not bind to socket\n");
socket_listen($socket, 5) or die("Could not set up socket listener\n");

echo "Server started on $host:$port\n";

function handle_in_action($data) {
    $nomor_tiket = $data['ticketNumber'];
    $nomor_plat = $data['nomor_plat'];
    $jenis_kendaraan = $data['jenis_kendaraan'];

    // Replace with your own database connection details
    $conn = new mysqli('localhost', 'root', '', 'vpmsdb');
    
    if ($conn->connect_error) {
        return "Database connection failed: " . $conn->connect_error;
    }

    $stmt = $conn->prepare("INSERT INTO tbltickets (ticketNumber, nomor_plat, jenis_kendaraan) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nomor_tiket, $nomor_plat, $jenis_kendaraan);
    
    if ($stmt->execute()) {
        $response = "Data successfully inserted.";
    } else {
        $response = "Data insertion failed: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    return $response;
}

function handle_out_action($data) {
    $digital_ticket = $data['digitalTicket'];
    $nomor_plat = $data['nomor_plat'];

    // Replace with your own database connection details
    $conn = new mysqli('localhost', 'root', '', 'vpmsdb');

    if ($conn->connect_error) {
        return "Database connection failed: " . $conn->connect_error;
    }

    $stmt = $conn->prepare("SELECT * FROM tbltiketdigital WHERE digitalTicket = ? AND nomor_plat = ? AND sudahBayar = 0");
    $stmt->bind_param("ss", $digital_ticket, $nomor_plat);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $stmt = $conn->prepare("UPDATE tbltiketdigital SET sudahBayar = 1 WHERE digitalTicket = ? AND nomor_plat = ?");
        $stmt->bind_param("ss", $digital_ticket, $nomor_plat);
        
        if ($stmt->execute()) {
            $response = "Payment status updated.";
        } else {
            $response = "Failed to update payment status: " . $stmt->error;
        }
    } else {
        $response = "No matching ticket or the ticket has already been paid.";
    }

    $stmt->close();
    $conn->close();

    return $response;
}

while (true) {
    $client = socket_accept($socket);
    if ($client) {
        echo "Client connected\n";  // Indicate successful client connection
    }
    $input = socket_read($client, 1024);
    $data = json_decode($input, true);

    if ($data['action'] == 'in') {
        $response = handle_in_action($data['data']);
    } elseif ($data['action'] == 'out') {
        $response = handle_out_action($data['data']);
    } else {
        $response = "Invalid action.";
    }

    socket_write($client, $response, strlen($response));
    socket_close($client);
}

socket_close($socket);
?>
