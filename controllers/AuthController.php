<?php

session_start();

require_once "../models/User.php";

function showMessage($title, $message, $buttonText, $buttonLink, $error = false)
{
    $titleClass = "";
    $buttonClass = "";

    if ($error) {
        $titleClass = "error-title";
        $buttonClass = "error-button";
    }

    echo '
    <!DOCTYPE html>
    <html>

    <head>

        <title>CineVerse</title>

        <link rel="stylesheet" href="../public/style.css">

        <style>

            .auth-container {
                width: 90%;
                max-width: 600px;
                margin: 60px auto;
                flex: 1;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .auth-card {
                width: 100%;
                background: rgba(255, 255, 255, 0.97);
                padding: 45px;
                border-radius: 20px;
                text-align: center;
                box-shadow: 0 8px 30px rgba(0, 0, 0, 0.35);
            }

            .auth-card h1 {
                color: #003b5c;
                margin-bottom: 15px;
            }

            .auth-card p {
                font-size: 18px;
                color: #555;
                margin-bottom: 30px;
            }

            .auth-button {
                display: inline-block;
                background: #003b5c;
                color: white;
                text-decoration: none;
                padding: 13px 30px;
                border-radius: 8px;
                font-weight: bold;
            }

            .auth-button:hover {
                background: #00557f;
            }

            .error-title {
                color: #b00020 !important;
            }

            .error-button {
                background: #b00020;
            }

            .error-button:hover {
                background: #8a0018;
            }

        </style>

    </head>

    <body>

    <div class="navbar">

        <div class="logo">
            CineVerse
        </div>

        <div>

            <a href="../views/auth/login.php">
                Login
            </a>

            <a href="../views/auth/register.php">
                Register
            </a>

        </div>

    </div>


    <div class="auth-container">

        <div class="auth-card">

            <h1 class="' . $titleClass . '">
                ' . $title . '
            </h1>

            <p>
                ' . $message . '
            </p>

            <a href="' . $buttonLink . '" class="auth-button ' . $buttonClass . '">
                ' . $buttonText . '
            </a>

        </div>

    </div>


    <div class="footer">

        <div class="footer-content">

            <div>

                <h3>CineVerse</h3>

                <p>
                    Movie Booking System
                </p>

                <p>
                    Level 8 of the Bashundhara City Shopping Complex
                </p>

                <p>
                    Complex at 13/3 Ka, Panthapath, Tejgaon
                </p>

                <p>
                    Dhaka 1205
                </p>

            </div>


            <div>

                <h3>Contact</h3>

                <p>
                    cineverse@gmail.com
                </p>

                <p>
                    017xxxxxxxx
                </p>

            </div>

        </div>

    </div>

    </body>

    </html>
    ';

    exit();
}


if (isset($_POST['register'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = registerUser($name, $email, $password);

    if ($result === true) {

        showMessage(
            "Registration Successful!",
            "Your CineVerse account has been created successfully.",
            "Go to Login",
            "../views/auth/login.php"
        );

    } elseif ($result === "email_exists") {

        showMessage(
            "Email Already Exists!",
            "This email is already registered. Please use another email.",
            "Try Again",
            "../views/auth/register.php",
            true
        );

    } else {

        showMessage(
            "Registration Failed!",
            "The account could not be created. Please try again.",
            "Try Again",
            "../views/auth/register.php",
            true
        );

    }
}


if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = loginUser($email, $password);

    if ($user) {

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] == 'admin') {

            header("Location: ../views/admin/dashboard.php");
            exit();

        } elseif ($user['role'] == 'staff') {

            header("Location: ../views/staff/movies.php");
            exit();

        } else {

            header("Location: ../views/customer/dashboard.php");
            exit();

        }

    } else {

        showMessage(
            "Login Failed!",
            "Invalid email or password. Please check your email and password and try again.",
            "Back to Login",
            "../views/auth/login.php",
            true
        );

    }
}

?>