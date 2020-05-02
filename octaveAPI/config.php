<?php
$servername = "localhost";
$username = "xmajtanp";
$password = "STUApi**20";
$dbname = "semestralneZadanie";

$apiKey = "6acecbbb8b287799b906826d2391f5";

date_default_timezone_set('Europe/Bratislava');
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
mysqli_set_charset($conn,"utf8");