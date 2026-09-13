<?php

require_once "../models/Showtime.php";

function showMessage($title, $message, $buttonText, $buttonLink)
{
    $isError = false;

    if (
        $title == "Showtime Add Failed!" ||
        $title == "Showtime Update Failed!" ||
        $title == "Showtime Delete Failed!"
    ) {
        $isError = true;
    }

    $titleClass = $isError ? "error-title" : "";

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

            .error-title {
                color: #b00020 !important;
            }

            .error-button {
                background: #b00020;
            }

            .error-button:hover {
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

            <h1 class="' . $titleClass . '">
                ' . $title . '
            </h1>

            <p>
                ' . $message . '
            </p>

            <a href="' . $buttonLink . '" class="controller-button ' . ($isError ? "error-button" : "") . '">
                ' . $buttonText . '
            </a>

        </div>

    </div>


    <div class="footer">

        <div class="footer-content">

            <div>

                <h3>CineVerse</h3>

                <p>
                    Movie Booking System
                </p>

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


if (isset($_POST['add_showtime'])) {

    $movie_id = $_POST['movie_id'];
    $show_date = $_POST['show_date'];
    $show_time = $_POST['show_time'];
    $price = $_POST['price'];

    if (addShowtime($movie_id, $show_date, $show_time, $price)) {

        showMessage(
            "Showtime Added Successfully!",
            "The showtime has been added successfully.",
            "Back to Showtimes",
            "../views/staff/showtimes.php"
        );

    } else {

        showMessage(
            "Showtime Add Failed!",
            "The showtime could not be added.",
            "Back to Showtimes",
            "../views/staff/showtimes.php"
        );

    }
}


if (isset($_POST['update_showtime'])) {

    $id = $_POST['id'];
    $movie_id = $_POST['movie_id'];
    $show_date = $_POST['show_date'];
    $show_time = $_POST['show_time'];
    $price = $_POST['price'];

    if (updateShowtime($id, $movie_id, $show_date, $show_time, $price)) {

        showMessage(
            "Showtime Updated Successfully!",
            "The showtime information has been updated successfully.",
            "Back to Showtimes",
            "../views/staff/showtimes.php"
        );

    } else {

        showMessage(
            "Showtime Update Failed!",
            "The showtime information could not be updated.",
            "Back to Showtimes",
            "../views/staff/showtimes.php"
        );

    }
}


if (isset($_GET['delete_showtime'])) {

    $id = $_GET['delete_showtime'];

    if (deleteShowtime($id)) {

        showMessage(
            "Showtime Deleted Successfully!",
            "The showtime has been deleted successfully.",
            "Back to Showtimes",
            "../views/staff/showtimes.php"
        );

    } else {

        showMessage(
            "Showtime Delete Failed!",
            "The showtime could not be deleted.",
            "Back to Showtimes",
            "../views/staff/showtimes.php"
        );

    }
}

?>