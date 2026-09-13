<?php

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'customer') {
    echo "Access Denied";
    exit();
}

require_once "../../models/Booking.php";

$user_id = $_SESSION['user_id'];

$bookings = getMyBookings($user_id);

?>

<!DOCTYPE html>
<html>

<head>

    <title>My Bookings</title>

    <link rel="stylesheet" href="../../public/style.css">

    <style>

        .back-button {
            display: inline-block;
            padding: 12px 25px;
            background: #003b5c;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            margin-top: 20px;
        }

        .back-button:hover {
            background: #00557f;
        }

        .logout-button {
            display: inline-block;
            padding: 12px 25px;
            background: #c62828;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            margin-top: 10px;
        }

        .logout-button:hover {
            background: #e53935;
        }

    </style>

</head>

<body>

<div class="container">

    <div class="profile-box">

        <h2>My Bookings</h2>

        <p>
            Welcome, <?php echo $_SESSION['name']; ?>!
        </p>

    </div>

    <?php

    if (mysqli_num_rows($bookings) > 0) {

        while ($booking = mysqli_fetch_assoc($bookings)) {

    ?>

            <div class="movie-card">

                <h3>
                    Booking ID:
                    <?php echo $booking['booking_id']; ?>
                </h3>

                <p>
                    <b>Movie:</b>
                    <?php echo $booking['title']; ?>
                </p>

                <p>
                    <b>Show Date:</b>
                    <?php echo $booking['show_date']; ?>
                </p>

                <p>
                    <b>Show Time:</b>
                    <?php echo $booking['show_time']; ?>
                </p>

                <p>
                    <b>Seats:</b>

                    <?php

                    $booking_id = $booking['booking_id'];

                    $seats = getBookingSeats($booking_id);

                    while ($seat = mysqli_fetch_assoc($seats)) {

                        echo $seat['seat_number'] . " ";

                    }

                    ?>

                </p>

                <p>
                    <b>Total Amount:</b>
                    <?php echo $booking['total_amount']; ?>
                </p>

                <p>
                    <b>Booking Date:</b>
                    <?php echo $booking['booking_date']; ?>
                </p>

            </div>

    <?php

        }

    } else {

        echo "<p>No bookings found.</p>";

    }

    ?>

    <div class="center">

        <a href="dashboard.php" class="back-button">
            Back to Dashboard
        </a>

        <br>

        <a href="../../controllers/LogoutController.php" class="logout-button">
            Logout
        </a>

    </div>

</div>

</body>

</html>