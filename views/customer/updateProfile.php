<?php
session_start();

require_once "../../models/customerModel.php";

if (!isset($_SESSION["customer_id"])) {
    header("Location: ../login.php");
    exit();
}

$customerId = $_SESSION["customer_id"];
$customer = getCustomerById($customerId);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile - CineVerse</title>
    <link rel="stylesheet" href="../css/profile.css">
</head>

<body>
    <div class="profile-container">
        <h1>Update Profile</h1>
        <form action="../../controllers/profileController.php" method="post">

            <label for="name">Name </label>
            <input type="text" name="name" id="name" value="<?php echo $customer["customer_name"]; ?>">

            <span class="error">
                <?php
                if (isset($_GET["nameErr"])) {
                    echo $_GET["nameErr"];
                }
                ?>
            </span>


            <label for="email">Email </label>
            <input type="email" name="email" id="email" value="<?php echo $customer["customer_email"]; ?>">

            <span class="error">
                <?php
                if (isset($_GET["emailErr"])) {
                    echo $_GET["emailErr"];
                }
                ?>
            </span>


            <label for="name">Phone </label>
            <input type="text" name="phone" id="phone" value="<?php echo $customer["customer_phone"]; ?>">

            <span class="error">
                <?php
                if (isset($_GET["phoneErr"])) {
                    echo $_GET["phoneErr"];
                }
                ?>
            </span>


            <label for="password">New Password </label>
            <input type="password" name="password" id="password"> 

            <span class="error">
                <?php 
                if(isset($_GET["passwordErr"])) {
                    echo $_GET["passwordErr"];
                }
                ?>
            </span>


            <label for="confirmPassword">Confirm Password </label>
            <input type="password" name="confirmPassword" id="confirmPassword"> 

            <span class="error">
                <?php 
                if(isset($_GET["confirmPasswordErr"])) {
                    echo $_GET["confirmPasswordErr"];
                }
                ?>
            </span>

            <input type="submit" value="Update Profile">

            <a href="profile.php">Cancel</a>
        </form>
    </div>
</body>

</html>