<?php include('../connection.php') ?>
<?php



if (isset($_POST['login'])) {

    $mat_num = $_POST['mat_num'];
    $password = $_POST['password'];

    $query = "SELECT * FROM `student_profile` WHERE `mat_num` = '$mat_num' and `password` = '$password' ";
    $run = mysqli_query($con, $query);
    $row = mysqli_num_rows($run);
    if ($row < 1) {
        $_SESSION['login_failed'] = "Username Or Password Wrong";
        $login_failed = $_SESSION['login_failed'];
    } else {
        $data = mysqli_fetch_assoc($run);
        // $name = $data['name'];
        $uid = $data['id'];
        $_SESSION['uid'] = $uid;
        header("location:../students/studentdash.php");
    }
}
?>
