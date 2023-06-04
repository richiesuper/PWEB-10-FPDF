<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "upload_file";

$pdo = new PDO("mysql:host=" . $host . ";dbname=" . $database, $username, $password);
