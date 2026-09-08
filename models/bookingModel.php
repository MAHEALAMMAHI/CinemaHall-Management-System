<?php
require_once "dbConnect.php";

function getShowsByMovieId($movieId)
{
    global $conn;

    $sql = "SELECT * FROM movie_show WHERE movie_id = ?";

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
