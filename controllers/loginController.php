<?php

session_start();
require_once "../models/customerModel.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    $hasError = false;

    $emailErr = "";
    $passwordErr = "";

    if ($email == "") {
        $emailErr = "Email cannot be empty";
        $hasError = true;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Provide a valid email address";
        $hasError = true;
    }

    if ($password == "") {
        $passwordErr = "Password cannot be empty";
        $hasError = true;
    }

    if ($hasError) {
        $url = "../views/login.php?emailErr=" . urlencode($emailErr)
            . "&passwordErr=" . urlencode($passwordErr);

        header("Location: $url");
        exit();
    } else {
        $customer = loginCustomer($email, $password);

        if ($customer) {
            $_SESSION["customer_id"] = $customer["customer_id"];
            $_SESSION["customer_name"] = $customer["customer_name"];
            $_SESSION["customer_email"] = $customer["customer_email"];
            $_SESSION["role"] = "customer";

            header("Location: ../views/customer/home.php");
            exit();
        } else {
            $passwordErr = "Invalid email or password";

            $url = "../views/login.php?passwordErr="
                . urlencode($passwordErr);

            header("Location: $url");
            exit();
        }
    }
}
?>