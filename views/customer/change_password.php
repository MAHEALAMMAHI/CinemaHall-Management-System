<?php

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'customer') {
    echo "Access Denied";
    exit();
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Change Password</title>

    <link rel="stylesheet" href="../../public/style.css">

</head>

<body>

<div class="container">

    <div class="profile-box">

        <h2>Change Password</h2>

        <p>
            Update your account password
        </p>

    </div>

    <form method="POST" action="../../controllers/PasswordController.php">

        <label>Current Password:</label>

        <input
            type="password"
            name="current_password"
            required
        >

        <br><br>

        <label>New Password:</label>

        <input
            type="password"
            name="new_password"
            required
        >

        <br><br>

        <label>Confirm New Password:</label>

        <input
            type="password"
            name="confirm_password"
            required
        >

        <br><br>

        <input
            type="submit"
            name="change_password"
            value="Change Password"
        >

    </form>

    <div class="center">

        <a href="dashboard.php">
            Back to Dashboard
        </a>

    </div>

</div>

</body>

</html>