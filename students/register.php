<?php include_once "../connection.php" ?>
<?php if (isset($_POST["submit"])) {
    if ($_POST['password'] = $_POST['confirm']) {
        $image_name = $_FILES['passport']['name'];
        $temp_image_name =  $_FILES['passport']['tmp_name'];
        $fname = $_POST['fname'];
        $sname = $_POST['sname'];
        $mat_num = $_POST['mat_num'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $password = $_POST['password'];

        $_SESSION['fname'] = $fname;
        $_SESSION['sname'] = $sname;
        $_SESSION['mat_num'] = $mat_num;


        move_uploaded_file($temp_image_name, "../image/$image_name");

        $query = "INSERT INTO `student_profile`(`fname`, `sname`,`mat_num`, `email`, `gender`,`passport`, `password`) 
     VALUES ('$fname','$sname','$mat_num','$email','$gender','$image_name','$password')";
        $run = mysqli_query($con, $query);
    }
    if ($run) {
        // echo "connected";
        Header("location:../students/log.php");
    }
    "there is problem somewhere";
}

?>