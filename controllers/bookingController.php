<?php

session_start();

require_once "../models/bookingModel.php";

if (!isset($_SESSION["customer_id"])) {
    header("Location: ../views/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $customerId = $_SESSION["customer_id"];

    $movieId = $_POST["movie_id"] ?? "";
    $showId = $_POST["show_id"] ?? "";
    $seats = $_POST["seats"] ?? [];

    $hasError = false;

    if ($showId == "") {
        $hasError = true;
    }

    if (empty($seats)) {
        $hasError = true;
    }

    if ($hasError) {
        echo "Please select a showtime and at least one seat";
        exit();
    }

    foreach ($seats as $seatId) {

        if (isSeatBooked($showId, $seatId)) {
            echo "One or more selected seats are already booked";
            exit();
        }
    }

    $booking = getBookingByCustomerAndShow($customerId, $showId);

    if (!$booking) {

        createBooking($customerId, $showId);

        $booking = getBookingByCustomerAndShow($customerId, $showId);
    }

    if ($booking) {

        $bookingId = $booking["booking_id"];

        foreach ($seats as $seatId) {

            addBookingSeat($bookingId, $seatId);
        }

        echo "Booking successful";
    } else {
        echo "Booking could not be created";
    }
}
