<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Drivers registration</title>

  <!-- Bootstrap core CSS-->
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark" style="background-image: linear-gradient(gray, #2144);">

  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Register an Account</div>
      <div class="card-body">
        <form method="POST" action="../drivers/register.php" enctype="multipart/form-data">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="firstName" class="form-control" placeholder="First name" name="fname" required="required" autofocus="autofocus">
                  <label for="firstName">First name</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="lastName" class="form-control" placeholder="Last name" name="sname" required="required">
                  <label for="lastName">Last name</label>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="form-label-group">
              <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="email" required="required">
              <label for="inputEmail">Email address</label>
            </div>
          </div>

          <div class="form-group">
            <div class="form-label-group">
              <input type="date" id="date" class="form-control" placeholder="Date of Birth" name="DOB" required="required">
              <label for="inputEmail">Data of Birth</label>
            </div>
          </div>
          <div class="form-group">
            <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" name="gender" onchange="document.getElementById('selectedGender').value=this.options[this.selectedIndex].text">
              <option value="" disabled selected>Gender:</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
            </select>
            <input type="hidden" name="selectedGender" id="selectedGender" value="" />
          </div>

          <div class="form-group">
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="customFile1" name="passport" />
              <label class="custom-file-label custom-file-label1" for="customFile1">Passport</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="inputPassword" class="form-control" placeholder="Password" name="password" required="required">
                  <label for="inputPassword">Password</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="password" id="confirmPassword" class="form-control" placeholder="Confirm password" name="confirm" required="required">
                  <label for="confirmPassword">Confirm password</label>
                </div>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-block" name="register" style="background-image: linear-gradient(gray, #2144);">Submit</button>
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="../drivers/log.php">Sign in</a>
          <!-- <a class="d-block small" href="forgot-password.php">Forgot Password?</a> -->
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js" style="background-image: linear-gradient(gray, #2144);"> </script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>