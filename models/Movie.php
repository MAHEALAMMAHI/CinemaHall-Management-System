<?php

require_once __DIR__ . "/../config/database.php";


// ================= ADD MOVIE =================

function addMovie($title, $description, $duration, $genre, $release_date, $poster)
{
    global $conn;

    $sql = "INSERT INTO movies
            (title, description, duration, genre, release_date, poster)
            VALUES
            ('$title', '$description', '$duration', '$genre', '$release_date', '$poster')";

    return mysqli_query($conn, $sql);
}


// ================= GET ALL MOVIES =================

function getAllMovies()
{
    global $conn;

    $sql = "SELECT * FROM movies ORDER BY id DESC";

    return mysqli_query($conn, $sql);
}


// ================= GET SINGLE MOVIE =================

function getMovieById($id)
{
    global $conn;

    $sql = "SELECT * FROM movies WHERE id = '$id'";

    $result = mysqli_query($conn, $sql);

    return mysqli_fetch_assoc($result);
}


// ================= UPDATE MOVIE =================

function updateMovie($id, $title, $description, $duration, $genre, $release_date, $poster)
{
    global $conn;

    $sql = "UPDATE movies SET
            title = '$title',
            description = '$description',
            duration = '$duration',
            genre = '$genre',
            release_date = '$release_date',
            poster = '$poster'
            WHERE id = '$id'";

    return mysqli_query($conn, $sql);
}


// ================= DELETE MOVIE =================

function deleteMovie($id)
{
    global $conn;

    $sql = "DELETE FROM movies WHERE id = '$id'";

    return mysqli_query($conn, $sql);
}

?>