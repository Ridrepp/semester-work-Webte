<?php
include "octaveAPI/config.php";
$headers = "Content-Type: text/html; charset=UTF-8";
if (isset($_POST["email"])){
    $email = $_POST["email"];
    $msg = "Využitie jednotlivých stránok:<br>";
    try {
        $conn = new PDO("mysql:host=localhost;dbname=semestralneZadanie;charset=utf8", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage() . "<br>";
    }
    $query = "SELECT * FROM `visits`";
    $result = $conn->query($query);
    while($row = $result->fetch()){
        $msg .= $row[1] . ": " . $row[2] . " x<br>";
    }
    $success = mail($email, "Štatistika - Team: Martin Michale, Martin Domorák, Patrik Majtán", $msg ,$headers);
    echo "SUCCESS";
}
else{
    echo "FAIL";
}