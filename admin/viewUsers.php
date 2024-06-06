<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['vpmsuid']) == 0) {
    header('location:logout.php');
    exit();
} else {
    // Handle deletion
    if (isset($_GET['delid'])) {
        $userid = intval($_GET['delid']);
        $query = mysqli_query($con, "DELETE FROM tblregusers WHERE ID='$userid'");
        if ($query) {
            echo "<script>alert('User berhasil dihapus.');</script>";
            echo "<script>window.location.href='viewUsers.php'</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan. Coba lagi.');</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Lihat Seluruh User</title>
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
    <?php include_once('includes/sidebar.php'); ?>
    <?php include_once('includes/header.php'); ?>

    <div class="content container">
        <div class="animated fadeIn">
            <div class="row justify-content-center">
                <div class="col-lg-12 mb-4">
                    <h3>Lihat Seluruh User</h3><br>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID User</th>
                                <th>Nama Depan</th>
                                <th>Nama Belakang</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Retrieve all user data
                            $query = mysqli_query($con, "SELECT ID, FirstName, LastName FROM tblregusers");

                            // Check if there are any users found
                            if (mysqli_num_rows($query) > 0) {
                                while ($row = mysqli_fetch_array($query)) {
                                    echo '<tr>';
                                    echo '<td>' . $row['ID'] . '</td>';
                                    echo '<td>' . $row['FirstName'] . '</td>';
                                    echo '<td>' . $row['LastName'] . '</td>';
                                    echo '<td><a href="viewUsers.php?delid=' . $row['ID'] . '" onclick="return confirm(\'Apakah Anda yakin ingin menghapus user ini?\');" class="btn btn-danger btn-sm">Hapus</a></td>';
                                    echo '</tr>';
                                }
                            } else {
                                echo '<tr><td colspan="4">Tidak ada user yang ditemukan.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                    <a href="dashboard.php" class="btn btn-primary mt-4">Kembali</a>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <?php include_once('includes/footer.php'); ?>
    </div>
</body>
</html>
<?php } ?>