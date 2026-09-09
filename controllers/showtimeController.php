<?php
require_once "../models/showtimeModel.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $movieId = $_POST["movie_id"] ?? "";
    $showDate = $_POST["show_date"] ?? "";
    $showTime = $_POST["show_time"] ?? "";
    $ticketPrice = $_POST["ticket_price"] ?? "";
    $hallId = $_POST["hall_id"] ?? "";

    $hasError = false;

    if ($movieId == "") {
        $hasError = true;
    }

    if ($showDate == "") {
        $hasError = true;
    }

    if ($showTime == "") {
        $hasError = true;
    }

    if ($ticketPrice == "") {
        $hasError = true;
    }

    if ($hallId == "") {
        $hasError = true;
    }

    if ($hasError) {
        echo "Please fill all fields correctly";
    } else {
        if (addShowTime($showDate, $showTime, $ticketPrice, $movieId, $hallId)) {
            header("Location: ../views/staff/add_showtime.php?success=Showtime added successfully");
            exit();
        } else {
            echo "Show time could not be added";
        }
    }
}
?>