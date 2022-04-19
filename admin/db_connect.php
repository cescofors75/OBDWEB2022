<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "td2q2019";
define('NUM_ITEMS_BY_PAGE', 50);
$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
$conn->set_charset("utf8");
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
?>