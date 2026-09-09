<?php
require_once "dbConnect.php";

function getShowsByMovieId($movieId)
{
    global $conn;

    $sql = "SELECT * FROM movie_show WHERE movie_id = ?
    AND show_end_datetime >= CURRENT_TIMESTAMP";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $movieId);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    return $result;
}

function getSeatsByHallId($hallId)
{
    global $conn;
    $sql = "SELECT * FROM seat WHERE hall_id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $hallId);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    return $result;
}

function getBookingByCustomerAndShow($customerId, $showId)
{
    global $conn;

    $sql = "SELECT * FROM booking WHERE customer_id = ? AND show_id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "ii", $customerId, $showId);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 1) {
        return mysqli_fetch_assoc($result);
    } else {
        return false;
    }
}

function createBooking($customerId, $showId)
{
    global $conn;

    $sql = "INSERT INTO booking (customer_id, show_id) VALUES(?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "ii", $customerId, $showId);

    if (mysqli_stmt_execute($stmt)) {
        return true;
    } else {
        return false;
    }
}

function addBookingSeat($bookingId, $seatId)
{
    global $conn;

    $sql = "INSERT INTO booking_seat (booking_id, seat_id) VALUES (?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "ii", $bookingId, $seatId);

    if (mysqli_stmt_execute($stmt)) {
        return true;
    } else {
        return false;
    }
}

function isSeatBooked($showId, $seatId)
{
    global $conn;

    $sql = "SELECT * FROM booking WHERE show_id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $showId);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    while ($booking = mysqli_fetch_assoc($result)) {

        $bookingId = $booking["booking_id"];

        $sql2 = "SELECT * FROM booking_seat WHERE booking_id = ? AND seat_id = ?";

        $stmt2 = mysqli_prepare($conn, $sql2);

        mysqli_stmt_bind_param($stmt2, "ii", $bookingId, $seatId);

        mysqli_stmt_execute($stmt2);

        $result2 = mysqli_stmt_get_result($stmt2);

        if (mysqli_num_rows($result2) > 0) {
            return true;
        }
    }

    return false;
}

function getShowById($showId)
{
    global $conn;

    $sql = "SELECT * FROM movie_show
            WHERE show_id = ?
            AND show_end_datetime >= CURRENT_TIMESTAMP";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $showId);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 1) {
        return mysqli_fetch_assoc($result);
    } else {
        return false;
    }
}
