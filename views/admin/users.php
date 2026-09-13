<?php

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    echo "Access Denied";
    exit();
}

require_once "../../config/database.php";

$sql = "SELECT * FROM users WHERE role = 'customer' ORDER BY id DESC";

$customers = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>

<head>

    <title>Customer Management</title>

    <link rel="stylesheet" href="../../public/style.css">

    <style>

        .customer-container {
            width: 90%;
            max-width: 1100px;
            margin: 35px auto;
            flex: 1;
        }

        .customer-header {
            background: rgba(255, 255, 255, 0.96);
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 5px 18px rgba(0, 0, 0, 0.3);
            margin-bottom: 25px;
        }

        .customer-header h1 {
            margin: 0 0 10px;
            color: #003b5c;
        }

        .customer-header p {
            font-size: 17px;
            margin: 0;
        }

        .message {
            background: #d4edda;
            color: #155724;
            padding: 14px;
            border-radius: 8px;
            text-align: center;
            margin-top: 20px;
            font-weight: bold;
        }

        .customer-list-title {
            background: rgba(255, 255, 255, 0.96);
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 20px;
        }

        .customer-list-title h2 {
            margin: 0;
            color: #003b5c;
        }

        .customer-card {
            background: rgba(255, 255, 255, 0.96);
            padding: 25px;
            border-radius: 14px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.25);
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 25px;
        }

        .customer-info {
            flex: 1;
        }

        .customer-info h3 {
            margin-top: 0;
            margin-bottom: 15px;
            color: #003b5c;
        }

        .customer-info p {
            margin: 8px 0;
        }

        .customer-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .edit-button {
            display: inline-block;
            background: #003b5c;
            color: white;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 7px;
            font-weight: bold;
        }

        .edit-button:hover {
            background: #00557f;
        }

        .delete-button {
            display: inline-block;
            background: #dc3545;
            color: white;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 7px;
            font-weight: bold;
        }

        .delete-button:hover {
            background: #b02a37;
        }

        .customer-navigation {
            background: rgba(255, 255, 255, 0.96);
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            margin-top: 25px;
            margin-bottom: 30px;
        }

        .customer-navigation a {
            display: inline-block;
            margin: 5px;
            padding: 11px 20px;
            background: #003b5c;
            color: white;
            text-decoration: none;
            border-radius: 7px;
            font-weight: bold;
        }

        .customer-navigation a:hover {
            background: #00557f;
        }

        .no-customer {
            background: rgba(255, 255, 255, 0.96);
            padding: 35px;
            border-radius: 12px;
            text-align: center;
            font-size: 18px;
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

        <a href="../../controllers/LogoutController.php">
            Logout
        </a>

    </div>

</div>


<div class="customer-container">

    <div class="customer-header">

        <h1>
            Customer Management
        </h1>

        <p>
            Welcome, <?php echo $_SESSION['name']; ?>!
        </p>

        <?php

        if (isset($_GET['success'])) {

            echo '<div class="message">
                    Customer updated successfully!
                  </div>';

        }

        if (isset($_GET['delete'])) {

            echo '<div class="message">
                    Customer deleted successfully!
                  </div>';

        }

        ?>

    </div>


    <div class="customer-list-title">

        <h2>
            Registered Customers
        </h2>

    </div>


    <?php

    if (mysqli_num_rows($customers) > 0) {

        while ($customer = mysqli_fetch_assoc($customers)) {

    ?>

            <div class="customer-card">

                <div class="customer-info">

                    <h3>
                        <?php echo $customer['name']; ?>
                    </h3>

                    <p>
                        <b>Customer ID:</b>
                        <?php echo $customer['id']; ?>
                    </p>

                    <p>
                        <b>Name:</b>
                        <?php echo $customer['name']; ?>
                    </p>

                    <p>
                        <b>Email:</b>
                        <?php echo $customer['email']; ?>
                    </p>

                    <p>
                        <b>Role:</b>
                        <?php echo $customer['role']; ?>
                    </p>

                </div>


                <div class="customer-actions">

                    <a
                        class="edit-button"
                        href="edit_customer.php?id=<?php echo $customer['id']; ?>"
                    >
                        Edit Customer
                    </a>

                    <a
                        class="delete-button"
                        href="../../controllers/AdminController.php?delete_customer=<?php echo $customer['id']; ?>"
                    >
                        Delete Customer
                    </a>

                </div>

            </div>

    <?php

        }

    } else {

    ?>

        <div class="no-customer">

            No customers found.

        </div>

    <?php

    }

    ?>


    <div class="customer-navigation">

        <a href="dashboard.php">
            Back to Admin Dashboard
        </a>

        <a href="../../controllers/LogoutController.php">
            Logout
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