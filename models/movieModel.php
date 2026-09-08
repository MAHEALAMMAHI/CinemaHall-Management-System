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
