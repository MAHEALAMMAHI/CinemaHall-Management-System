<?php

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    echo "Access Denied";
    exit();
}

require_once "../models/User.php";
require_once "../config/database.php";

function showMessage($title, $message, $buttonText, $buttonLink, $type = "success")
{
    $titleClass = "";
    $buttonClass = "";

    if ($type == "delete") {
        $titleClass = "delete-title";
        $buttonClass = "delete-button";
    }

    if ($type == "error") {
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

            .controller-container {
                width: 90%;
                max-width: 700px;
                margin: 60px auto;
                flex: 1;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .controller-card {
                width: 100%;
                background: rgba(255, 255, 255, 0.97);
                padding: 45px;
                border-radius: 20px;
                text-align: center;
                box-shadow: 0 8px 30px rgba(0, 0, 0, 0.35);
            }

            .controller-card h1 {
                color: #003b5c;
                margin-bottom: 15px;
            }

            .controller-card p {
                font-size: 18px;
                color: #555;
                margin-bottom: 30px;
            }

            .controller-button {
                display: inline-block;
                background: #003b5c;
                color: white;
                text-decoration: none;
                padding: 13px 30px;
                border-radius: 8px;
                font-weight: bold;
            }

            .controller-button:hover {
                background: #00557f;
            }

            .delete-title {
                color: #d00000 !important;
            }

            .delete-button {
                background: #d00000;
            }

            .delete-button:hover {
                background: #a00000;
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

            <a href="../views/admin/dashboard.php">
                Dashboard
            </a>

            <a href="../views/admin/users.php">
                Customers
            </a>

            <a href="../views/admin/staff.php">
                Staff
            </a>

            <a href="../controllers/LogoutController.php">
                Logout
            </a>

        </div>

    </div>


    <div class="controller-container">

        <div class="controller-card">

            <h1 class="' . $titleClass . '">
                ' . $title . '
            </h1>

            <p>
                ' . $message . '
            </p>

            <a href="' . $buttonLink . '" class="controller-button ' . $buttonClass . '">
                ' . $buttonText . '
            </a>

        </div>

    </div>


    <div class="footer">

        <div class="footer-content">

            <div>

                <h3>CineVerse</h3>

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

                <h3>Admin Panel</h3>

                <p>
                    Customer and Staff Management
                </p>

            </div>

        </div>

    </div>

    </body>

    </html>
    ';

    exit();
}


if (isset($_POST['update_customer'])) {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    if (updateProfile($id, $name, $email)) {

        showMessage(
            "Customer Updated Successfully!",
            "Customer information has been updated successfully.",
            "Back to Customers",
            "../views/admin/users.php"
        );

    } else {

        showMessage(
            "Customer Update Failed!",
            "The customer information could not be updated.",
            "Back to Customers",
            "../views/admin/users.php",
            "error"
        );

    }
}


if (isset($_GET['delete_customer'])) {

    $id = $_GET['delete_customer'];

    $user = getUserById($id);

    if ($user && $user['role'] == 'customer') {

        $sql = "DELETE FROM users
                WHERE id = '$id'
                AND role = 'customer'";

        if (mysqli_query($conn, $sql)) {

            showMessage(
                "Customer Deleted Successfully!",
                "The customer account has been deleted successfully.",
                "Back to Customers",
                "../views/admin/users.php",
                "delete"
            );

        } else {

            showMessage(
                "Customer Delete Failed!",
                "The customer account could not be deleted.",
                "Back to Customers",
                "../views/admin/users.php",
                "error"
            );

        }

    } else {

        showMessage(
            "Invalid Customer!",
            "The selected customer could not be found.",
            "Back to Customers",
            "../views/admin/users.php",
            "error"
        );

    }
}


if (isset($_POST['add_staff'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (addStaff($name, $email, $password)) {

        showMessage(
            "Staff Added Successfully!",
            "The new staff account has been added successfully.",
            "Back to Staff",
            "../views/admin/staff.php"
        );

    } else {

        showMessage(
            "Staff Add Failed!",
            "The staff account could not be added.",
            "Back to Staff",
            "../views/admin/staff.php",
            "error"
        );

    }
}


if (isset($_POST['update_staff'])) {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    if (updateStaff($id, $name, $email)) {

        showMessage(
            "Staff Updated Successfully!",
            "Staff information has been updated successfully.",
            "Back to Staff",
            "../views/admin/staff.php"
        );

    } else {

        showMessage(
            "Staff Update Failed!",
            "The staff information could not be updated.",
            "Back to Staff",
            "../views/admin/staff.php",
            "error"
        );

    }
}


if (isset($_GET['delete_staff'])) {

    $id = $_GET['delete_staff'];

    $staff = getUserById($id);

    if ($staff && $staff['role'] == 'staff') {

        if (deleteStaff($id)) {

            showMessage(
                "Staff Deleted Successfully!",
                "The staff account has been deleted successfully.",
                "Back to Staff",
                "../views/admin/staff.php",
                "delete"
            );

        } else {

            showMessage(
                "Staff Delete Failed!",
                "The staff account could not be deleted.",
                "Back to Staff",
                "../views/admin/staff.php",
                "error"
            );

        }

    } else {

        showMessage(
            "Invalid Staff!",
            "The selected staff member could not be found.",
            "Back to Staff",
            "../views/admin/staff.php",
            "error"
        );

    }
}

?>