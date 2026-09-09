<?php

require_once "../models/showtimeModel.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["delete_showtime"])) {

        $showId = $_POST["show_id"] ?? "";

        if ($showId == "") {
            echo "Invalid showtime";
            exit();
        }

        if (hasBookingForShow($showId)) {

            header("Location: ../views/staff/manage_showtime.php?error=Cannot delete this showtime because customers have booked seats");
            exit();

        } else {

            if (deleteShowtime($showId)) {

                header("Location: ../views/staff/manage_showtime.php?success=Showtime deleted successfully");
                exit();

            } else {

                echo "Showtime could not be deleted";
            }
        }

    } else {

        $movieId = $_POST["movie_id"] ?? "";
        $showDate = $_POST["show_date"] ?? "";
        $startTime = $_POST["start_time"] ?? "";
        $endTime = $_POST["end_time"] ?? "";
        $ticketPrice = $_POST["ticket_price"] ?? "";
        $hallId = $_POST["hall_id"] ?? "";

        $hasError = false;

        if ($movieId == "") {
            $hasError = true;
        }

        if ($showDate == "") {
            $hasError = true;
        }

        if ($startTime == "") {
            $hasError = true;
        }

        if ($endTime == "") {
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

            $showTime = $startTime . "-" . $endTime;

            $showEndDatetime = $showDate . " " . $endTime . ":00";

            if (addShowtime(
                $showDate,
                $showTime,
                $showEndDatetime,
                $ticketPrice,
                $movieId,
                $hallId
            )) {

                header("Location: ../views/staff/add_showtime.php?success=Showtime added successfully");
                exit();

            } else {

                echo "Showtime could not be added";
            }
        }
    }
}

?>