<?php

require_once "../models/Movie.php";
require_once "../config/database.php";

function showMessage($title, $message, $buttonText, $buttonLink)
{
    $deleteStyle = "";

    if ($title == "Movie Deleted Successfully!") {
        $deleteStyle = "delete-message";
    }

    echo '
    <!DOCTYPE html>
    <html>

    <head>

        <title>CineVerse</title>

        <link rel="stylesheet" href="../public/style.css">

        <style>

            .controller-container {
                width: 90%;
                max-width: 700px;
                margin: 60px auto;
                flex: 1;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .controller-card {
                width: 100%;
                background: rgba(255, 255, 255, 0.97);
                padding: 45px;
                border-radius: 20px;
                text-align: center;
                box-shadow: 0 8px 30px rgba(0, 0, 0, 0.35);
            }

            .controller-card h1 {
                color: #003b5c;
                margin-bottom: 15px;
            }

            .controller-card p {
                font-size: 18px;
                color: #555;
                margin-bottom: 30px;
            }

            .controller-button {
                display: inline-block;
                background: #003b5c;
                color: white;
                text-decoration: none;
                padding: 13px 30px;
                border-radius: 8px;
                font-weight: bold;
            }

            .controller-button:hover {
                background: #00557f;
            }

            .delete-message {
                color: #b00020 !important;
            }

            .delete-button {
                background: #b00020;
            }

            .delete-button:hover {
                background: #8a0018;
            }

        </style>

    </head>

    <body>

    <div class="navbar">

        <div class="logo">
            CineVerse
        </div>

        <div>

            <a href="../views/staff/movies.php">
                Movies
            </a>

            <a href="../views/staff/showtimes.php">
                Showtimes
            </a>

            <a href="../controllers/LogoutController.php">
                Logout
            </a>

        </div>

    </div>


    <div class="controller-container">

        <div class="controller-card">

            <h1 class="' . $deleteStyle . '">
                ' . $title . '
            </h1>

            <p>
                ' . $message . '
            </p>

            <a href="' . $buttonLink . '" class="controller-button ' . ($deleteStyle != "" ? "delete-button" : "") . '">
                ' . $buttonText . '
            </a>

        </div>

    </div>


    <div class="footer">

        <div class="footer-content">

            <div>

                <h3>CineVerse</h3>

                <p>
                    Level 8 of the Bashundhara City Shopping Complex
                </p>

                <p>
                    Complex at 13/3 Ka, Panthapath, Tejgaon
                </p>

                <p>
                    Dhaka 1205
                </p>

            </div>


            <div>

                <h3>Contact</h3>

                <p>
                    cineverse@gmail.com
                </p>

                <p>
                    017xxxxxxxx
                </p>

            </div>

        </div>

    </div>

    </body>

    </html>
    ';

    exit();
}


if (isset($_POST['add_movie'])) {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $duration = $_POST['duration'];
    $genre = $_POST['genre'];
    $release_date = $_POST['release_date'];
    $poster = $_POST['poster'];

    if (addMovie($title, $description, $duration, $genre, $release_date, $poster)) {

        showMessage(
            "Movie Added Successfully!",
            "The movie has been added successfully.",
            "Back to Movies",
            "../views/staff/movies.php"
        );

    } else {

        showMessage(
            "Movie Add Failed!",
            "The movie could not be added.",
            "Back to Movies",
            "../views/staff/movies.php"
        );

    }
}


if (isset($_POST['update_movie'])) {

    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $duration = $_POST['duration'];
    $genre = $_POST['genre'];
    $release_date = $_POST['release_date'];
    $poster = $_POST['poster'];

    if (updateMovie($id, $title, $description, $duration, $genre, $release_date, $poster)) {

        showMessage(
            "Movie Updated Successfully!",
            "The movie information has been updated successfully.",
            "Back to Movies",
            "../views/staff/movies.php"
        );

    } else {

        showMessage(
            "Movie Update Failed!",
            "The movie information could not be updated.",
            "Back to Movies",
            "../views/staff/movies.php"
        );

    }
}


if (isset($_GET['delete_movie'])) {

    $id = $_GET['delete_movie'];

    $sql = "DELETE FROM movies WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {

        showMessage(
            "Movie Deleted Successfully!",
            "The movie has been deleted successfully.",
            "Back to Movies",
            "../views/staff/movies.php"
        );

    } else {

        showMessage(
            "Movie Delete Failed!",
            "The movie could not be deleted.",
            "Back to Movies",
            "../views/staff/movies.php"
        );

    }
}




?>