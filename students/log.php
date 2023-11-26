<?php
require("../connection.php");
if (isset($_GET['reference'])) {
  $ref = $_GET['reference'];

  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . $ref,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
      "Authorization: Bearer sk_test_eea0813a31c79e376a33cbb14bbad4f72e16e87c",
      "Cache-Control: no-cache",
    ),
  ));

  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);
  // echo $response;exit();
  $response = json_decode($response);
  if (isset($response->data->status)) {
    if ($response->data->status == "success") {
      $query1 = mysqli_query($con, "SELECT*FROM deposit WHERE Ref='$ref' and Status_='Pending'");
      if (mysqli_num_rows($query1) == 1) {
        $fundinfo = mysqli_fetch_assoc($query1);
        $userid = $fundinfo['StudentID'];
        $update = $fundinfo['Amount'];
        // $query2 = mysqli_query($conn,"SELECT*FROM userinfo WHERE StudentID='$userid'");
        // $userinfo = mysqli_fetch_assoc($query2);
        // $update = ($fundinfo['Amount']+$userinfo['Balance']);
        mysqli_query($con, "UPDATE deposit SET Status_='Paid' WHERE Ref='$ref'");
        mysqli_query($con, "UPDATE student_profile SET amount=amount+'$update' WHERE id='$userid'");
      }
    }
  }
}
header("location:../students/studentdash.php");
exit();
