<?php

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'customer') {
    echo "Access Denied";
    exit();
}

$booking_id = $_GET['booking_id'];
$amount = $_GET['amount'];
$payment_method = $_GET['method'];

?>

<!DOCTYPE html>
<html>

<head>

    <title>Payment Successful - CineVerse</title>

    <link rel="stylesheet" href="../../public/style.css">

</head>

<body>

<div class="navbar">

    <div class="logo">
        CineVerse
    </div>

    <div>
        <a href="dashboard.php">Dashboard</a>
        <a href="my_bookings.php">My Bookings</a>
    </div>

</div>


<div class="success-container">

    <div class="success-card">

        <div class="success-icon">
            ✓
        </div>

        <h1>Payment Successful!</h1>

        <p class="success-message">
            Your payment has been completed successfully.
        </p>


        <div class="success-details">

            <div class="success-row">

                <span>Booking ID</span>

                <strong>
                    <?php echo $booking_id; ?>
                </strong>

            </div>


            <div class="success-row">

                <span>Amount Paid</span>

                <strong>
                    ৳<?php echo $amount; ?>
                </strong>

            </div>


            <div class="success-row">

                <span>Payment Method</span>

                <strong>
                    <?php echo $payment_method; ?>
                </strong>

            </div>

        </div>


        <div class="success-note">

            Thank you for booking with CineVerse.

        </div>


        <a class="success-button" href="dashboard.php">
            Back to Dashboard
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