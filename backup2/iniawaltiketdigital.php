<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
date_default_timezone_set('Asia/Jakarta');

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
    //$nomorTiket = $_SESSION['nomorTiket']; // Use randomCode as ticket number
    $nomorTiket = 1; // Use randomCode as ticket number
    $randomCode = 1;
    $expTime = date("Y-m-d H:i:s", strtotime("+30 minutes", time())); // Current timestamp + 30 minutes
    //$query = "INSERT INTO tbltiketdigital (UserID, digitalTicket, ticketNumber, expTime) VALUES ('$vpmsuid', '$randomCode', '$nomorTiket', '$expTime')";

    if (mysqli_query($con, $query)) {
        // Success
        $status_query = mysqli_query($con, "SELECT sudahBayar FROM tbltiketdigital WHERE ticketNumber = '$nomorTiket'");
        $row = mysqli_fetch_assoc($status_query);
        $status_paid = $row['sudahBayar'];
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
                    display: none;
                    /* Initially hide the timer */
                    position: absolute;
                    top: 10px;
                    right: 10px;
                    font-size: 16px;
                    font-weight: bold;
                }

                /* New style for status_paid */
                #status-paid {
                    position: absolute;
                    top: 40px;
                    right: 10px;
                    font-size: 16px;
                    font-weight: bold;
                    color: green; /* Example color */
                }
            </style>
        </head>

        <body>
            <!-- <div class="timestamp"><?php echo date("Y-m-d H:i:s"); ?></div> -->
            <div id="ticket-code">Kode Tiket Digital: <?php echo 1; ?></div>
            <div id="status-paid">Status: <?php echo $status_paid; ?></div> <!-- Display status_paid here -->
            <br>
            <a href="dashboard.php" class="btn btn-primary">Kembali ke Dashboard</a>
            <div id="timer"></div>

            <script>
                // Set the countdown timer for 30 minutes (1800 seconds)
                let countdown = 1800; // Change this to match your timer duration

                // Update the timer display every second
                let timerInterval = setInterval(function () {
                    // Function to check if the ticket is paid
                    let status_paid = <?php echo $status_paid; ?>;

                    if (countdown <= 0 || status_paid == 1) {
                        // Timer expired, redirect to dashboard.php
                        clearInterval(timerInterval); // Stop the timer interval
                        window.location.href = "dashboard.php";
                    } else {
                        let minutes = Math.floor(countdown / 60);
                        let seconds = countdown % 60;
                        let formattedTime = `${minutes}:${seconds.toString().padStart(2, '0')}`;

                        // Update timer display
                        document.getElementById("timer").innerHTML = formattedTime;

                        // Decrease countdown
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
