<?php

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    echo "Access Denied";
    exit();
}

require_once "../../models/User.php";

$id = $_GET['id'];

$staff = getUserById($id);

if (!$staff || $staff['role'] != 'staff') {
    echo "Invalid staff!";
    exit();
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Edit Staff - CineVerse</title>

    <link rel="stylesheet" href="../../public/style.css">

    <style>

        .edit-staff-container {
            width: 90%;
            max-width: 700px;
            margin: 45px auto;
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .edit-staff-card {
            width: 100%;
            background: rgba(255, 255, 255, 0.96);
            padding: 40px;
            border-radius: 18px;
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.3);
        }

        .edit-staff-card h1 {
            text-align: center;
            color: #003b5c;
            margin-top: 0;
            margin-bottom: 10px;
        }

        .edit-staff-card p {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
        }

        .staff-id {
            background: #f1f4f6;
            padding: 12px;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 25px;
            font-weight: bold;
        }

        .edit-staff-form {
            background: transparent;
            padding: 0;
            margin: 0;
            box-shadow: none;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 11px;
            border: 1px solid #ccc;
            border-radius: 7px;
            font-size: 15px;
        }

        .form-group input:focus {
            outline: none;
            border-color: #003b5c;
        }

        .update-area {
            text-align: center;
            margin-top: 25px;
        }

        .update-button {
            background: #003b5c;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .update-button:hover {
            background: #00557f;
        }

        .back-area {
            text-align: center;
            margin-top: 20px;
        }

        .back-area a {
            color: #003b5c;
            font-weight: bold;
            text-decoration: none;
        }

        .back-area a:hover {
            text-decoration: underline;
        }

        @media (max-width: 600px) {

            .edit-staff-container {
                width: 94%;
                margin: 25px auto;
            }

            .edit-staff-card {
                padding: 25px 20px;
            }

        }

    </style>

</head>

<body>

<div class="navbar">

    <div class="logo">
        CineVerse
    </div>

    <div>

        <a href="dashboard.php">
            Dashboard
        </a>

        <a href="staff.php">
            Staff
        </a>

        <a href="users.php">
            Customers
        </a>

        <a href="../../controllers/LogoutController.php">
            Logout
        </a>

    </div>

</div>


<div class="edit-staff-container">

    <div class="edit-staff-card">

        <h1>
            Edit Staff
        </h1>

        <p>
            Update staff information
        </p>


        <div class="staff-id">

            Staff ID:
            <?php echo $staff['id']; ?>

        </div>


        <form
            class="edit-staff-form"
            method="POST"
            action="../../controllers/AdminController.php"
        >

            <input
                type="hidden"
                name="id"
                value="<?php echo $staff['id']; ?>"
            >


            <div class="form-group">

                <label>
                    Name:
                </label>

                <input
                    type="text"
                    name="name"
                    value="<?php echo $staff['name']; ?>"
                    required
                >

            </div>


            <div class="form-group">

                <label>
                    Email:
                </label>

                <input
                    type="email"
                    name="email"
                    value="<?php echo $staff['email']; ?>"
                    required
                >

            </div>


            <div class="update-area">

                <input
                    type="submit"
                    class="update-button"
                    name="update_staff"
                    value="Update Staff"
                >

            </div>

        </form>


        <div class="back-area">

            <a href="staff.php">
                Back to Staff
            </a>

        </div>

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
                Panthapath, Dhaka
            </p>

        </div>


        <div>

            <h3>Admin Panel</h3>

            <p>
                Staff Management
            </p>

            <p>
                Edit Staff Information
            </p>

        </div>

    </div>

</div>


</body>

</html>