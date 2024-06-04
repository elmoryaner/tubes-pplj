<!DOCTYPE html>
<html lang="en">
    <head>   
        <title>Parking Management System</title>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            body, html {
                height: 100%;
                margin: 0;
                display: flex;
                flex-direction: column;
            }
            #main-content {
                flex: 1;
            }
            .copyright {
                background-color: #2c3e50;
                color: white;
                padding: 10px 0;
                width: 100%;
                position: sticky;
                bottom: 0;
            }
        </style>
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
            <div class="container">
                <button class="navbar-toggler text-uppercase font-weight-bold bg-white text-black rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="admin/loginadmin.php">Admin</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="users/login.php">Users</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Main Content -->
        <div id="main-content">
            <!-- Masthead-->
            <header class="masthead bg-white text-black text-center">
                <div class="container d-flex align-items-center flex-column">
                    <!-- Masthead Avatar Image-->
                    <img class="mb-5" src="assets/img/parking-sign.png" width="150" height="150" alt="Parking Sign" />
                    <!-- Masthead Heading-->
                    <h5 class="masthead-heading text-uppercase">Parking Management System</h5>
                </div>
            </header>
        </div>
        <!-- Copyright Section-->
        <div class="copyright py-4 text-center text-black">
            <div class="container text-white"><small>Parking Management System &copy; 2024</small></div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
