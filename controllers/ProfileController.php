<?php

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'customer') {
    echo "Access Denied";
    exit();
}

require_once "../models/User.php";

if (isset($_POST['update_profile'])) {

    $id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    if (updateProfile($id, $name, $email)) {

        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;

        header("Location: ../views/customer/edit_profile.php?success=1");
        exit();

    } else {

        echo "Profile update failed!";

    }
}

?>