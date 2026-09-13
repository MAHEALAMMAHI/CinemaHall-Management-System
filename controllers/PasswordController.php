
<?php

session_start();

require_once "../models/User.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'customer') {
    echo '
    <!DOCTYPE html>
    <html>
    <head>
        <title>Access Denied - CineVerse</title>
        <link rel="stylesheet" href="../public/style.css">
    </head>
    <body>

    <div class="navbar">
        <div class="logo">CineVerse</div>
    </div>

    <div class="success-container">
        <div class="success-card">
            <h1>Access Denied</h1>
            <p class="success-message">
                You are not allowed to access this page.
            </p>
            <a href="../views/auth/login.php" class="success-button">
                Go to Login
            </a>
        </div>
    </div>

    </body>
    </html>
    ';
    exit();
}

if (isset($_POST['change_password'])) {

    $user_id = $_SESSION['user_id'];

    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if (!checkCurrentPassword($user_id, $current_password)) {

        echo '
        <!DOCTYPE html>
        <html>
        <head>
            <title>Password Change - CineVerse</title>
            <link rel="stylesheet" href="../public/style.css">
        </head>
        <body>

        <div class="navbar">
            <div class="logo">CineVerse</div>
        </div>

        <div class="success-container">
            <div class="success-card">
                <h1>Password Change Failed</h1>

                <p class="success-message">
                    Current password is incorrect!
                </p>

                <a href="../views/customer/change_password.php" class="success-button">
                    Try Again
                </a>
            </div>
        </div>

        </body>
        </html>
        ';
        exit();
    }

    if ($new_password != $confirm_password) {

        echo '
        <!DOCTYPE html>
        <html>
        <head>
            <title>Password Change - CineVerse</title>
            <link rel="stylesheet" href="../public/style.css">
        </head>
        <body>

        <div class="navbar">
            <div class="logo">CineVerse</div>
        </div>

        <div class="success-container">
            <div class="success-card">
                <h1>Password Change Failed</h1>

                <p class="success-message">
                    New passwords do not match!
                </p>

                <a href="../views/customer/change_password.php" class="success-button">
                    Try Again
                </a>
            </div>
        </div>

        </body>
        </html>
        ';
        exit();
    }

    if (changePassword($user_id, $new_password)) {

        echo '
        <!DOCTYPE html>
        <html>
        <head>
            <title>Password Changed - CineVerse</title>
            <link rel="stylesheet" href="../public/style.css">
        </head>
        <body>

        <div class="navbar">
            <div class="logo">CineVerse</div>

            <div>
                <a href="../views/customer/dashboard.php">Dashboard</a>
                <a href="../controllers/LogoutController.php">Logout</a>
            </div>
        </div>

        <div class="success-container">
            <div class="success-card">

                <div class="success-icon">
                    ✓
                </div>

                <h1>Password Changed Successfully!</h1>

                <p class="success-message">
                    Your password has been updated successfully.
                </p>

                <a href="../views/customer/dashboard.php" class="success-button">
                    Back to Dashboard
                </a>

            </div>
        </div>

        </body>
        </html>
        ';

    } else {

        echo '
        <!DOCTYPE html>
        <html>
        <head>
            <title>Password Change - CineVerse</title>
            <link rel="stylesheet" href="../public/style.css">
        </head>
        <body>

        <div class="navbar">
            <div class="logo">CineVerse</div>
        </div>

        <div class="success-container">
            <div class="success-card">

                <h1>Password Change Failed</h1>

                <p class="success-message">
                    Something went wrong. Please try again.
                </p>

                <a href="../views/customer/change_password.php" class="success-button">
                    Try Again
                </a>

            </div>
        </div>

        </body>
        </html>
        ';
    }

} else {

    header("Location: ../views/customer/change_password.php");
    exit();

}

?>