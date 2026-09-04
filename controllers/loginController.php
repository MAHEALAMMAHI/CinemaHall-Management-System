<?php
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
    } else {
        echo "Login successful!";
    }
}
