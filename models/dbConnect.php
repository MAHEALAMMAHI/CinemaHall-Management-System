<?php
$serverName = "localhost";
$userName = "root";
$password = "";
$dbname = "cineverse";

$conn = mysqli_connect($serverName, $userName, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>