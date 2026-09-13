```php
<?php

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    echo "Access Denied";
    exit();
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Admin Dashboard</title>

    <link rel="stylesheet" href="../../public/style.css">

    <style>

        .logout-button {
            display: inline-block;
            background: #dc3545;
            color: white;
            text-decoration: none;
            padding: 12px 25px;
            border-radius: 7px;
            font-weight: bold;
            font-size: 16px;
            margin-top: 10px;
        }

        .logout-button:hover {
            background: #b02a37;
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
        <a href="staff.php">Staff</a>
        <a href="../../controllers/LogoutController.php">Logout</a>
    </div>

</div>


<div class="dashboard">

    <div class="dashboard-content">

        <h1>Admin Dashboard</h1>

        <h2>
            Welcome,
            <?php echo $_SESSION['name']; ?>!
        </h2>

        <p>
            Email:
            <?php echo $_SESSION['email']; ?>
        </p>

        <hr>

        <h3>Admin Menu</h3>

        <div class="dashboard-buttons">

            <a href="users.php">
                Manage Customers
            </a>

            <a href="staff.php">
                Manage Staff
            </a>

        </div>

        <p>

            <a
                href="../../controllers/LogoutController.php"
                class="logout-button"
            >
                Logout
            </a>

        </p>

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
                Manage Customers
            </p>

            <p>
                Manage Staff
            </p>

        </div>

    </div>

</div>

</body>

</html>
```
