<?php
include "config.php";
$headers = "Content-Type: text/html; charset=UTF-8";
if (isset($_POST["email"])){
    $email = $_POST["email"];
    $msg = null;
    $success = mail($email, "Štatistika - Team: Martin Michale, Martin Domorák, Patrik Majtán", $msg ,$headers);
    if ($success) {
        echo "Email bol úspešne odoslaný.";
    }
}