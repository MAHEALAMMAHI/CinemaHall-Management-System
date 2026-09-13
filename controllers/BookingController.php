<?php

session_start();

require_once "../config/database.php";
require_once "../models/Booking.php";


if (isset($_POST['book_seats'])) {


    if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'customer') {

        echo "Access Denied";
        exit();

    }


    $user_id = $_SESSION['user_id'];

    $showtime_id = $_POST['showtime_id'];


    if (!isset($_POST['seats'])) {

        echo "Please select at least one seat.";
        exit();

    }


    $seats = $_POST['seats'];

    $seat_count = count($seats);


    // Get ticket price

    $sql = "SELECT price FROM showtimes
            WHERE id = '$showtime_id'";

    $result = mysqli_query($conn, $sql);

    $showtime = mysqli_fetch_assoc($result);


    $price = $showtime['price'];


    // Calculate total amount

    $total_amount = $seat_count * $price;


    // Create booking

    $booking_id = createBooking(
        $user_id,
        $showtime_id,
        $total_amount
    );


    if ($booking_id) {


        // Save selected seats

        foreach ($seats as $seat_id) {

            addBookingSeat(
                $booking_id,
                $showtime_id,
                $seat_id
            );

        }


        // Go to Payment Page

        header("Location: ../views/customer/payment.php?booking_id=$booking_id&amount=$total_amount");

        exit();


    } else {

        echo "Booking failed!";

    }

}

?>