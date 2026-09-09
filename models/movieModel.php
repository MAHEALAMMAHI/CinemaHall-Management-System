<?php
require_once "dbConnect.php";

function addMovie($movieName, $duration, $thumbnail, $status)
{
    global $conn;

    $sql = "INSERT INTO movie(movie_name, movie_duration, thumbnail, movie_status) VALUES(?,?,?,?)";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "ssss", $movieName, $duration, $thumbnail, $status);

    if (mysqli_stmt_execute($stmt)) {
        return true;
    } else {
        return false;
    }
}

function getMoviesByStatus($status)
{
    global $conn;

    $sql = "SELECT * FROM movie WHERE movie_status = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "s", $status);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    return $result;
}
function getMovieById($movieId)
{
    global $conn;

    $sql = "SELECT * FROM movie WHERE movie_id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $movieId);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 1) {
        return mysqli_fetch_assoc($result);
    } else {
        return false;
    }
}

function getAllMoviesForStaff()
{
    global $conn;

    $sql = "SELECT * FROM movie";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    return $result;
}

function hasShowtimeForMovie($movieId)
{
    global $conn;

    $sql = "SELECT * FROM movie_show WHERE movie_id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $movieId);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

function deleteMovie($movieId)
{
    global $conn;

    $sql = "DELETE FROM movie WHERE movie_id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $movieId);

    if (mysqli_stmt_execute($stmt)) {
        return true;
    } else {
        return false;
    }
}