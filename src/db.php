<?php

$host = "localhost";
$db = "book_tracking";
$usr = "root";
$pwd = "eko";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $usr, $pwd);
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (EXCEPTION $e) {
    die("Connection with the DB failed" . $e->getMessage());
}

session_start();

function logout_account() {
    if (isset($_SESSION["user"])) {
        header("Location: logout.php");
        exit();
    }
}

function redirect_unauth_users() {
    if (empty($_SESSION["user"])) {
        header("Location: no_account_warning.php");
        exit();
    }
}

?>