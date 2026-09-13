<?php

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    echo "Access Denied";
    exit();
}

require_once "../../models/User.php";

$id = $_GET['id'];

$customer = getUserById($id);

if (!$customer || $customer['role'] != 'customer') {
    echo "Invalid customer!";
    exit();
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Edit Customer</title>

    <link rel="stylesheet" href="../../public/style.css">

    <style>

        .edit-container {
            width: 90%;
            max-width: 600px;
            margin: 40px auto;
            flex: 1;
        }

        .edit-box {
            background: rgba(255,255,255,0.96);
            padding: 35px;
            border-radius: 15px;
            box-shadow: 0 5px 18px rgba(0,0,0,0.3);
        }

        .edit-box h2 {
            text-align: center;
            color: #003b5c;
            margin-top: 0;
            margin-bottom: 25px;
        }

        .edit-box label {
            font-weight: bold;
            color: #333;
        }

        .edit-box input[type="text"],
        .edit-box input[type="email"] {
            width: 100%;
            padding: 12px;
            margin-top: 8px;
            border: 1px solid #ccc;
            border-radius: 7px;
            font-size: 16px;
            box-sizing: border-box;
        }

        .edit-box input[type="submit"] {
            width: 100%;
            padding: 14px;
            background: #003b5c;
            color: white;
            border: none;
            border-radius: 7px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .edit-box input[type="submit"]:hover {
            background: #00557f;
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
        }

        .back-link a {
            color: #003b5c;
            font-weight: bold;
            text-decoration: none;
        }

        .back-link a:hover {
            text-decoration: underline;
        }

    </style>

</head>

<body>

<div class="navbar">

    <div class="logo">
        CineVerse
    </div>

    <div>

        <a href="dashboard.php">Dashboard</a>

        <a href="users.php">Customers</a>

        <a href="../../controllers/LogoutController.php">Logout</a>

    </div>

</div>


<div class="edit-container">

    <div class="edit-box">

        <h2>Edit Customer</h2>

        <form method="POST"
              action="../../controllers/AdminController.php">

            <input
                type="hidden"
                name="id"
                value="<?php echo $customer['id']; ?>"
            >

            <label>Name:</label>

            <input
                type="text"
                name="name"
                value="<?php echo $customer['name']; ?>"
                required
            >

            <br><br>

            <label>Email:</label>

            <input
                type="email"
                name="email"
                value="<?php echo $customer['email']; ?>"
                required
            >

            <br><br>

            <input
                type="submit"
                name="update_customer"
                value="Update Customer"
            >

        </form>

        <div class="back-link">

            <a href="users.php">
                Back to Customers
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
                Complex at 13/3 Ka, Panthapath, Tejgaon
            </p>

            <p>
                Dhaka 1205
            </p>

        </div>

        <div>

            <h3>Admin Panel</h3>

            <p>
                Edit Customer Information
            </p>

        </div>

    </div>

</div>

</body>

</html>