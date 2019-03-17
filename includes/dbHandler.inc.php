<?php
$dbServerName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "loginapp";

$conn = mysqli_connect($dbServerName, $dbUsername, $dbPassword, $dbName);

$conn->set_charset("utf8");
if (!$conn) {
    die("Connection failed ".mysqli_connect_error());
}
