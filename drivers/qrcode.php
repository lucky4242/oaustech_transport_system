<?php include('../connection.php') ?>
<?php
if (!isset($_SESSION['uid'])) {
    header("location:login.php");
    exit();
}
$uid = $_SESSION['uid'];
if (isset($_SESSION['uid'])) {
    $query = "SELECT * FROM `drivers_profile` WHERE id='$uid'";
    $run = mysqli_query($con, $query);
    $row = mysqli_num_rows($run);

    if ($row == 0) {
        //  echo "<script> alert('Please Enter Correct Information')</script>";
    } else {
        $data = mysqli_fetch_assoc($run);
        $id = $data['id'];
        $sname = $data['sname'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>BUS SCHEDULING SYSTEM</title>

    <!-- Bootstrap core CSS-->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin.css" rel="stylesheet">
    <style>
        /* body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f2f2f2;
        } */

        /* .container {
            text-align: center;
        } */

        h1 {
            margin: 0;
            font-size: 24px;
            line-height: 1.5;
        }

        #qrcode {
            padding-top: 20px;
        }
    </style>

</head>

<body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top" style="background-image: linear-gradient(pink,#2144);">

        <a class="navbar-brand mr-1" href="index.php">OAUSTECH Transport System</a>

        <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Navbar Search -->
        <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">

        </form>

        <!-- Navbar -->
        <ul class="navbar-nav ml-auto ml-md-0">
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user-circle fa-fw"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item" href="logout.php" data-target="#logoutModal">Logout</a>

                </div>
            </li>
        </ul>

    </nav>



    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="sidebar navbar-nav" style="background-image: linear-gradient(pink,#2144);">
            <li class="nav-item">
                <a class="nav-link" href="./driverdash.php">
                    <i class="fas fa-fw fa-home"></i>
                    <span>DRIVERS_DASH</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="./qrcode.php">
                    <i class="fas fa-fw fa-bus"></i>
                    <span>QR_CODE</span></a>
            </li>

        </ul>

        <div id="content-wrapper">

            <div class="container-fluid">
                <div class="container">
                    <h1>
                        Scan the QR Code <br />
                        below to complete the transaction
                    </h1>
                    <div id="qrcode">
                        <!-- QR Code will be generated here -->
                    </div>
                </div>
                <!-- /.container-fluid -->

                <!-- Sticky Footer -->
                <footer class="sticky-footer">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright © Your Website 2023</span>
                        </div>
                    </div>
                </footer>

            </div>
            <!-- /.content-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top" style="background-image: linear-gradient(black, #014923);">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="login.html">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="../vendor/jquery/jquery.min.js"></script>
        <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Page level plugin JavaScript-->
        <script src="../vendor/datatables/jquery.dataTables.js"></script>
        <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="../js/sb-admin.min.js"></script>

        <!-- Demo scripts for this page-->
        <script src="../js/demo/datatables-demo.js"></script>
        <script src="../js/qrcode.min.js"></script>
        <script>
            document.getElementById("qrcode").innerHTML = "";
            console.log("making qr-code...");

            var qrcode = new QRCode(document.getElementById("qrcode"), {
                colorDark: "#000",
                colorLight: "#fff",
                correctLevel: QRCode.CorrectLevel.H,
                width: 200,
                height: 200,
            });

            let url = `id: <?php echo $id; ?>\nname: <?php echo $sname; ?>`;
            qrcode.makeCode(url);
        </script>
</body>

</html>