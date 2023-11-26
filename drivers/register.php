<?php include_once "../connection.php" ?>
<?php if (isset($_POST["register"])) {
    if ($_POST['password'] = $_POST['confirm']) {
        $image_name = $_FILES['passport']['name'];
        $temp_image_name =  $_FILES['passport']['tmp_name'];

        $fname = $_POST['fname'];
        $sname = $_POST['sname'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $password = $_POST['password'];

        $_SESSION['fname'] = $fname;
        $_SESSION['sname'] = $sname;
        move_uploaded_file($temp_image_name, "../image/$image_name");

        $query = "INSERT INTO `drivers_profile`(`fname`, `sname`, `email`, `gender`,`passport`, `password`) 
     VALUES ('$fname','$sname','$email','$gender','$image_name','$password')";
        $run = mysqli_query($con, $query);
    }
    if ($run) {
        Header("location:../drivers/log.php");
    }
    echo "there is problem somewhere";
}

?>