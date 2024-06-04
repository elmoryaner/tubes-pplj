<?php
$host = '127.0.0.1';
$port = 8080;
$address = 'tcp://' . $host . ':' . $port;

// Create a TCP Stream socket
$server = stream_socket_server($address, $errno, $errstr);

if (!$server) {
    die("Error: $errstr ($errno)\n");
}

echo "Server is listening on port $port...\n";

while ($client = @stream_socket_accept($server)) {
    $data = fread($client, 1024);
    $tbltickets = json_decode($data, true);

    if ($tbltickets) {
        // Insert the received data into the MySQL database
        $conn = new mysqli('localhost', 'root', '', 'vpmsdb');

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("INSERT INTO tbltickets (ticketNumber, nomor_plat, jenis_kendaraan) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $tbltickets['ticketNumber'], $tbltickets['nomor_plat'], $tbltickets['jenis_kendaraan']);
        $stmt->execute();

        $stmt->close();
        $conn->close();

        fwrite($client, "Data received and inserted into the database.\n");
    } else {
        fwrite($client, "Invalid data received.\n");
    }

    fclose($client);
}

fclose($server);
?>
