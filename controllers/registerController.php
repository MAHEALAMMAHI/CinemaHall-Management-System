<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $gender = $_POST["gender"] ?? "";
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];

    $hasError = false;

    $nameErr = "";
    $emailErr = "";
    $phoneErr = "";
    $genderErr = "";
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
        $phoneErr = "Phone number cannot be empty";
        $hasError = true;
    } elseif (!preg_match('/^01[0-9]{9}$/', $phone)) {
        $phoneErr = "Provide a valid phone number";
        $hasError = true;
    }

    if ($gender == "") {
        $genderErr = "Gender must be selected";
        $hasError = true;
    }

    if ($password == "") {
        $passwordErr = "Password cannot be empty";
        $hasError = true;
    } elseif (strlen($password) < 8) {
        $passwordErr = "Password must be at least 8 characters";
        $hasError = true;
    }
    if ($confirmPassword == "") {
        $confirmPasswordErr = "Confirm password cannot be empty";
        $hasError = true;
    } else if ($password != $confirmPassword) {
        $confirmPasswordErr = "Passwords do not match";
        $hasError = true;
    }

    if ($hasError) {
        $url = "../views/register.php?nameErr=" . urlencode($nameErr)
            . "&emailErr=" . urlencode($emailErr)
            . "&phoneErr=" . urlencode($phoneErr)
            . "&genderErr=" . urlencode($genderErr)
            . "&passwordErr=" . urlencode($passwordErr)
            . "&confirmPasswordErr=" . urlencode($confirmPasswordErr);

        header("Location: $url");
    } else {
        echo "Registration successful!";
    }
}
?>