<?php
session_start();
$dbname = "oaustech_transport_system";
$dbusername = "root";
$dbpassword = "";
$dbhost = "localhost";

$con = mysqli_connect($dbhost, $dbusername, $dbpassword, $dbname);
