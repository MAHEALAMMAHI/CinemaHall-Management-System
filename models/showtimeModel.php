<?php
require_once "dbConnect.php";

function getAllMovies()
{
    global $conn;

    $sql = "SELECT * FROM movie";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    return $result;
}

function getAllHalls()
{
    global $conn;

    $sql = "SELECT * FROM hall";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    return $result;
}

function addShowTime($showDate, $showTime, $ticketPrice, $movieId, $hallId)
{
    global $conn;

    $sql = "INSERT INTO movie_show(show_date, show_time, ticket_price, movie_id, hall_id) VALUES (?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "ssdii", $showDate, $showTime, $ticketPrice, $movieId, $hallId);

    if (mysqli_stmt_execute($stmt)) {
        return true;
    } else {
        return false;
    }
}

function hasBookingForShow($showId)
{
    global $conn;

    $sql = "SELECT * FROM booking WHERE show_id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $showId);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

function deleteShowtime($showId)
{
    global $conn;

    $sql = "DELETE FROM movie_show WHERE show_id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $showId);

    if (mysqli_stmt_execute($stmt)) {
        return true;
    } else {
        return false;
    }
}

function getAllShowtimes()
{
    global $conn;

    $sql = "SELECT * FROM movie_show";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    return $result;
}
?>
