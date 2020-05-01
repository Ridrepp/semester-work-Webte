<?php
$servername = "localhost";
$username = "xmajtanp";
$password = "STUApi**20";
$dbname = "semestralneZadanie";

//$key = implode('', str_split(substr(strtolower(md5(microtime().rand(1000, 9999))), 0, 30), 6));
//echo $key;

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
mysqli_set_charset($conn,"utf8");