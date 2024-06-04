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
        <!doctype html>
        <html class="no-js" lang="">
		<head>
			<title>
				Riwayat Pembayaran
			</title>
			<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
			<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
			<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
			<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
			<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
			<link rel="stylesheet" href="../admin/assets/css/cs-skin-elastic.css">
			<link rel="stylesheet" href="../admin/assets/css/style.css">
			<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800'
			rel='stylesheet' type='text/css'>
			<meta name="viewport" content="width=device-width, initial-scale=1">
		</head>
		<body>
			<!-- Left Panel -->
			<?php include_once( 'includes/sidebar.php');?>
				<!-- Right Panel -->
				<?php include_once( 'includes/header.php');?>
                <div class="content animated fadeIn">
                    <div class="row">
                        <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                            <strong class="card-title">Riwayat Pembayaran</strong>
                            </div>
                            <div class="card-body">
                            <table class="table">
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
                            </div>
                        </div>
                        </div>
                    </div>
                </div>

            <!-- .content -->
            <div class="clearfix">
            </div>
            <?php include_once( 'includes/footer.php');?>
            <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js">
            </script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js">
            </script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js">
            </script>
            <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js">
            </script>
            <script src="../admin/assets/js/main.js">
            </script>

		</body>
	</html>
    <?php
    } else {
        echo '<p>Tidak ada riwayat pembayaran yang ditemukan.</p>';
    }
}
?>