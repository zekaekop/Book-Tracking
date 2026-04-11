<?php

$host = "localhost";
$db = "book_tracking";
$usr = "root";
$pwd = "eko";

try{
    $pdo = new PDO("mysql:host=$host;db_name=$db", $usr, $pwd);
    $pdo -> setAttribute(PDO::ATTR_ERROR, PDO:ERRMODE_EXCEPTION);
} catch (EXCEPTION $e) {
    die("Connection with the DB failed" . $e->getMessage());
}

?>