<?php include_once "../connection.php";

if (!isset($_SESSION['uid'])) {
  // header("location:login.php");
  exit();
}
$uid = $_SESSION['uid'];
if (isset($_POST['submit'])) {
  # code...

  $amount = $_POST['amount'];
  $email = "opuamalucky42@gmail.com";
  $url = "https://api.paystack.co/transaction/initialize";

  $query = "UPDATE `student_profile` SET `amount`='[$amount]' WHERE id ='$uid'";
  $fields = [
    'email' => $email,
    'amount' => $amount . "00"
  ];

  $fields_string = http_build_query($fields);

  $ch = curl_init();

  //set the url, number of POST vars, POST data
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Authorization: Bearer sk_test_eea0813a31c79e376a33cbb14bbad4f72e16e87c",
    "Cache-Control: no-cache",
  ));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $result = curl_exec($ch);
  $result = json_decode($result);
  if (isset($result->data->reference)) {
    $ref = $result->data->reference;
    mysqli_query($con, "INSERT INTO deposit(StudentID,Amount,Ref)VALUES('$uid','$amount','$ref')");
    header("location:" . $result->data->authorization_url);
    exit();
  }
}
$query1 = mysqli_query($con, "SELECT  `amount` FROM `student_profile` WHERE id ='$uid'");
if (mysqli_num_rows($query1) == 1) {
  $fundinfo = mysqli_fetch_assoc($query1);
  // $userid =$fundinfo['StudentID'];
  $update = $fundinfo['amount'];
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
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <!--Stylesheets-->
  <style media="screen">
    *,
    *:before,
    *:after {
      padding: 0;
      margin: 0;
      box-sizing: border-box;
    }

    body {
      /* background-color: #0855ae; */
    }

    .popup {
      background-color: #ffffff;
      width: 420px;
      padding: 30px 40px;
      position: absolute;
      transform: translate(-50%, -50%);
      left: 50%;
      top: 50%;
      border-radius: 8px;
      font-family: "Poppins", sans-serif;
      display: none;
      text-align: center;
    }

    .popup button {
      display: block;
      margin: 0 0 20px auto;
      background-color: transparent;
      font-size: 30px;
      color: #ffffff;
      background: #03549a;
      border-radius: 100%;
      width: 40px;
      height: 40px;
      border: none;
      outline: none;
      cursor: pointer;
    }

    .popup h2 {
      margin-top: -20px;
    }

    .popup p {
      font-size: 10px;
      text-align: justify;
      margin: 20px 0;
      line-height: 25px;
    }

    .popup .amount {
      padding-top: 3.5px;
      padding-bottom: 6px;
      border: none;


    }

    .popup .amount:focus {
      outline: none;
    }
  </style>

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top" style="background-image: linear-gradient(pink,#2144);">

    <a class="navbar-brand mr-1" href="index.php">BUS SCHEDULING</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <!-- <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">

    </form> -->

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <div class="dropdown-divider"></div>

          <a class="dropdown-item" href="../logout.php" data-target="#logoutModal">Logout</a>

        </div>
      </li>
    </ul>

  </nav>


  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav" style="background-image: linear-gradient(pink,#2144);">
      <li class="nav-item">
        <a class="nav-link" href="./studentdash.php">
          <i class="fas fa-fw fa-user"></i>
          <span>STUDENT_DASH</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="./scan-code.php">
          <i class="fas fa-fw fa-book"></i>
          <span>SCAN_QRCODE</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./complete-payment.php">
          <i class="fas fa-fw fa-books    "></i>
          <span>ACCOUNT</span></a>
      </li>

      </li>

    </ul>

    <div id="content-wrapper">

      <div class="container-fluid">


        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item" style="background-image: linear-gradient();">
            <h2> Balance: </h2>
            <h2> <?php echo $update ?> </h2>
          </li>
        </ol>
        <div class="container">
          <button type="button" class="btn btn-primary btn-rounded" onclick="openForm()">Fund Account</button>
          <a href="./scan-code.php">
            <button type="button" class="btn btn-danger btn-rounded">Scan to Pay</button>
          </a>
        </div>
        <!-- Page Content -->
        <div class="bus_logo">

          <a class="image full"><img src="../image/deluxe.jpg" style="width:800px;" style="background-attachment: fixed;" style="background-size: contain;"> </a>

        </div>
        <form action="#" method="post">
          <div class="popup">
            <button id="close">&times;</button>
            <h2>Enter Amount</h2>
            <input type="number" placeholder="&#8358;2000" name="amount" class="amount" required>
            <input type="submit" class="btn btn-primary" value="continue" name="submit">
          </div>
        </form>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <!-- Sticky Footer -->
        <!-- <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright © Your Website 2023</span>
            </div>
          </div>
        </footer> -->

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
            <a class="btn btn-primary" href="../logout.php">Logout</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Sticky Footer -->
    <!-- <footer class="sticky-footer">
      <div class="container my-auto">
        <div class="copyright text-center my-auto">
          <span>Copyright © Your Website 2023</span>
        </div>
      </div>
    </footer> -->
    <!-- Bootstrap core JavaScript-->
    <script type="text/javascript">
      function openForm() {
        setTimeout(
          function open(event) {
            document.querySelector(".popup").style.display = "block";
          },
          2000
        )
      };


      document.querySelector("#close").addEventListener("click", function() {
        document.querySelector(".popup").style.display = "none";
      });
    </script>
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
</body>

</html>