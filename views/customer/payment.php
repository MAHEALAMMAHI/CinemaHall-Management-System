<?php

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'customer') {

    echo "Access Denied";
    exit();

}

$booking_id = $_GET['booking_id'];

$amount = $_GET['amount'];

?>

<!DOCTYPE html>
<html>

<head>

    <title>Payment - CineVerse</title>

    <link rel="stylesheet" href="../../public/style.css">

</head>

<body>

<div class="navbar">

    <div class="logo">
        CineVerse
    </div>

    <div>

        <a href="dashboard.php">Dashboard</a>

        <a href="movies.php">Movies</a>

        <a href="my_bookings.php">My Bookings</a>

        <a href="edit_profile.php">Profile</a>

        <a href="../../controllers/LogoutController.php">Logout</a>

    </div>

</div>


<div class="payment-container">

    <div class="payment-card">

        <h1>Make Payment</h1>

        <p class="payment-welcome">
            Welcome, <?php echo $_SESSION['name']; ?>!
        </p>


        <div class="payment-details">

            <div class="payment-row">

                <span>Booking ID</span>

                <strong>
                    <?php echo $booking_id; ?>
                </strong>

            </div>


            <div class="payment-row">

                <span>Total Amount</span>

                <strong>
                    <?php echo $amount; ?>
                </strong>

            </div>

        </div>


        <form method="POST"
              action="../../controllers/PaymentController.php">

            <input type="hidden"
                   name="booking_id"
                   value="<?php echo $booking_id; ?>">


            <input type="hidden"
                   name="amount"
                   value="<?php echo $amount; ?>">


            <h2>Select Payment Method</h2>


            <div class="payment-methods">

                <label class="payment-option">

                    <input type="radio"
                           name="payment_method"
                           value="Cash"
                           required>

                    <span>Cash</span>

                </label>


                <label class="payment-option">

                    <input type="radio"
                           name="payment_method"
                           value="Card">

                    <span>Card</span>

                </label>


                <label class="payment-option">

                    <input type="radio"
                           name="payment_method"
                           value="Mobile Banking">

                    <span>Mobile Banking</span>

                </label>

            </div>


            <div class="center">

                <input type="submit"
                       name="make_payment"
                       value="Pay Now">

            </div>

        </form>


        <div class="payment-back">

            <a href="dashboard.php">
                Back to Dashboard
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