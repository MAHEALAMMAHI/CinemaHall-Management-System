<?php
session_start();

require_once "../models/customerModel.php";

if (!isset($_SESSION["customer_id"])) {
    header("Location: ../views/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customerId = $_SESSION["customer_id"];

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];

    $hasError = false;

    $nameErr = "";
    $emailErr = "";
    $phoneErr = "";
    $passwordErr = "";
    $confirmPasswordErr = "";

    if ($name == "") {
        $nameErr = "Name cannot be empty";
        $hasError = true;
    } elseif (!preg_match('/^[a-zA-Z\' -]+$/', $name)) {
        $nameErr = "Name cannot contain numbers or special characters";
        $hasError = true;
    }

    if ($email == "") {
        $emailErr = "Email cannot be empty";
        $hasError = true;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Provide a valid email address";
        $hasError = true;
    }

    if ($phone == "") {
        $phoneErr = "Phone cannot be empty";
        $hasError = true;
    } elseif (!preg_match('/^01[0-9]{9}$/', $phone)) {
        $phoneErr = "Provide a valid phone number";
        $hasError = true;
    }

    if ($password != "") {
        if (strlen($password) < 8) {
            $passwordErr = "Password must be at least 8 characters";
            $hasError = true;
        }
        if ($confirmPassword == "") {
            $confirmPasswordErr = "Confirm password cannot be empty";
            $hasError = true;
        } elseif ($password != $confirmPassword) {
            $confirmPasswordErr = "Passwords do not match";
            $hasError = true;
        }
    }

    if (!$hasError) {
        if (emailExistsForOtherCustomer($email, $customerId)) {
            $emailErr = "This email is already registered";
            $hasError = true;
        }
    }
    if ($hasError) {
        $url = "../views/customer/updateProfile.php"
            . "&nameErr=" . urlencode($nameErr)
            . "&emailErr=" . urlencode($emailErr)
            . "&phoneErr=" . urlencode($phoneErr)
            . "&passwordErr=" . urlencode($passwordErr)
            . "&confirmPasswordErr=" . urlencode($confirmPasswordErr);

        header("Location: $url");
        exit();
    }

    $customer = getCustomerById($customerId);
    if ($password == "") {
        $password = $customer["password"];
    }

    if (updateCustomer($customerId, $name, $email, $phone, $password)) {
        $_SESSION["customer_name"] = $name;
        $_SESSION["customer_email"] = $email;
        header("Location: ../views/customer/profile.php?success=Profile updated successfully");
        exit();
    } else {
        echo "Profile update failed";
    }
}
?>