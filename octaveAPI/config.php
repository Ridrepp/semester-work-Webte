<?php
$servername = "localhost";
$username = "xmajtanp";
$password = "STUApi**20";
$dbname = "semestralneZadanie";
$slowConstant = 1;
$apiKey = "6acecbbb8b287799b906826d2391f5";
date_default_timezone_set('Europe/Bratislava');
$connSQLI = new mysqli($servername, $username, $password, $dbname);

if ($connSQLI->connect_error) {
    die("Connection failed: " . $connSQLI->connect_error);
}
if($_POST['slow']){
    echo json_encode(array("value"=>$slowConstant));
}
mysqli_set_charset($connSQLI,"utf8");