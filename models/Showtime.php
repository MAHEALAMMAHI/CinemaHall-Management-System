<?php

require_once __DIR__ . "/../config/database.php";

function addShowtime($movie_id, $show_date, $show_time, $price)
{
    global $conn;

    $sql = "INSERT INTO showtimes
            (movie_id, show_date, show_time, price)
            VALUES
            ('$movie_id', '$show_date', '$show_time', '$price')";

    return mysqli_query($conn, $sql);
}

function getAllShowtimes()
{
    global $conn;

    $sql = "SELECT showtimes.*, movies.title
            FROM showtimes
            JOIN movies ON showtimes.movie_id = movies.id
            ORDER BY showtimes.show_date, showtimes.show_time";

    return mysqli_query($conn, $sql);
}

function getShowtimesByMovie($movie_id)
{
    global $conn;

    $sql = "SELECT showtimes.*, movies.title
            FROM showtimes
            JOIN movies ON showtimes.movie_id = movies.id
            WHERE showtimes.movie_id = '$movie_id'
            ORDER BY showtimes.show_date, showtimes.show_time";

    return mysqli_query($conn, $sql);
}

function getShowtimeById($id)
{
    global $conn;

    $sql = "SELECT * FROM showtimes WHERE id = '$id'";

    $result = mysqli_query($conn, $sql);

    return mysqli_fetch_assoc($result);
}

function updateShowtime($id, $movie_id, $show_date, $show_time, $price)
{
    global $conn;

    $sql = "UPDATE showtimes SET
            movie_id = '$movie_id',
            show_date = '$show_date',
            show_time = '$show_time',
            price = '$price'
            WHERE id = '$id'";

    return mysqli_query($conn, $sql);
}

function deleteShowtime($id)
{
    global $conn;

    $sql = "DELETE FROM showtimes WHERE id = '$id'";

    return mysqli_query($conn, $sql);
}

?>