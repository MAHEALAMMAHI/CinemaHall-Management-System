<?php
session_start();

require_once("../../models/customerModel.php");

if (!isset($_SESSION["customer_id"])) {
    header("Location: ../login.php");
    exit();
}

$customerID = $_SESSION["customer_id"];
$customer = getCustomerById($customerID);

$edit = $_GET["edit"] ?? "";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - CineVerse</title>

    <link rel="stylesheet" href="../css/profile.css?v=2">
</head>

<body>
    <div class="profile-container">
        <h1>User Profile</h1>
        <div class="profile-info">
            <p>
                <b>Name:</b>
                <?php echo $customer["customer_name"]; ?>
            </p>

            <p>
                <b>Email:</b>
                <?php echo $customer["customer_email"]; ?>
            </p>

            <p>
                <b>Phone:</b>
                <?php echo $customer["customer_phone"]; ?>
            </p>

            <p>
                <b>Gender:</b>
                <?php echo $customer["gender"]; ?>
            </p>
        </div>

        <a href="updateProfile.php">
            Update Profile
        </a>

        <br><br>

        <a href="home.php">
            Back to Home
        </a>
    </div>

</body>

</html>