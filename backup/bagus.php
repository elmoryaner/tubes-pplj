<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['vpmsuid']) == 0) {
    header('location:logout.php');
    exit();
} else {
    // Generate random 8-character varchar code
    $codeLength = 8;
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $randomCode = '';
    for ($i = 0; $i < $codeLength; $i++) {
        $randomCode .= $characters[rand(0, strlen($characters) - 1)];
    }

    // Insert code into tbltiketdigital table
    $vpmsuid = $_SESSION['vpmsuid'];
    $nomorTiket = $randomCode; // Use randomCode as ticket number
    $expTime = date("Y-m-d H:i:s", strtotime("+30 minutes", time())); // Current timestamp + 30 minutes
    $query = "INSERT INTO tbltiketdigital (UserID, digitalTicket, ticketNumber, expTime) VALUES ('$vpmsuid', '$randomCode', '$nomorTiket', '$expTime')";

    if (mysqli_query($con, $query)) {
        // Success
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <title>Tiket Digital</title>
            <style>
                #ticket-code {
                    font-size: 20px;
                    font-weight: bold;
                    text-align: center;
                    padding: 10px;
                    border: 1px solid #ccc;
                    margin-top: 20px;
                }
                .timestamp {
                    position: absolute;
                    top: 10px;
                    right: 10px;
                }
                #timer {
                    display: none; /* Initially hide the timer */
                    position: absolute;
                    top: 10px;
                    right: 10px;
                    font-size: 16px;
                    font-weight: bold;
                }
            </style>
        </head>
        <body>
            <div class="timestamp"><?php echo date("Y-m-d H:i:s"); ?></div>
            <div id="ticket-code">Kode Tiket Digital: <?php echo $randomCode; ?></div>
            <br>
            <a href="dashboard.php" class="btn btn-primary">Kembali ke Dashboard</a>
            <div id="timer"></div>

            <script>
                // Set the countdown timer for 30 minutes (1800 seconds)
                let countdown = 1800;

                // Update the timer display every second
                setInterval(function() {
                    if (countdown <= 0) {
                        // Timer expired, redirect to dashboard.php
                        window.location.href = "dashboard.php";
                    } else {
                        let minutes = Math.floor(countdown / 60);
                        let seconds = countdown % 60;
                        let formattedTime = `${minutes}:${seconds.toString().padStart(2, '0')}`;

                        // Update timer display
                        document.getElementById("timer").innerHTML = formattedTime;

                        countdown--;
                    }
                }, 1000);

                // Initially show the timer
                document.getElementById("timer").style.display = "block";
            </script>
        </body>
        </html>
        <?php
    } else {
        // Error
        echo "Gagal membuat kode tiket digital: " . mysqli_error($con);
    }
}
?>
