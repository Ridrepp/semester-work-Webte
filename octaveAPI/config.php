<?php
$servername = "localhost";
$username = "xmajtanp";
$password = "STUApi**20";
$dbname = "semestralneZadanie";

date_default_timezone_set('Europe/Bratislava');
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
mysqli_set_charset($conn,"utf8");