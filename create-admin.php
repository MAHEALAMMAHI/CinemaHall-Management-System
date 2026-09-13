<?php

require_once "config/database.php";

$name = "admin";
$email = "admin@gmail.com";
$password = "123456";
$role = "admin";

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "UPDATE users SET
        name = '$name',
        password = '$hashed_password',
        role = '$role'
        WHERE email = '$email'";

if (mysqli_query($conn, $sql)) {
    echo "Admin created successfully!";
} else {
    echo "Admin creation failed!";
}

?>