<?php

session_start();

require_once "../../models/showtimeModel.php";
require_once "../../models/movieModel.php";

$showtimes = getAllShowtimes();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Delete Showtimes - CineVerse</title>

    <link rel="stylesheet" href="../css/add_movie.css?v=6">
</head>

<body>

    <div class="navbar">

        <div class="logo">
            CineVerse
        </div>

        <div class="nav-links">

            <a href="add_movie.php">
                Add Movie
            </a>

            <a href="add_showtime.php">
                Add Showtime
            </a>

            <a href="manage_movie.php">
                Delete Movies
            </a>

            <a href="manage_showtime.php">
                Delete Showtime
            </a>

        </div>

        <div class="user">

            Staff

            <span class="separator">||</span>

            <a href="../logout.php">
                Logout
            </a>

        </div>

    </div>


    <div class="main-content manage-content">

        <div class="movie-form-container">

            <h1>Delete Showtimes</h1>
            <?php

            if (isset($_GET["success"])) {
                echo "<p class='success'>" . $_GET["success"] . "</p>";
            }

            if (isset($_GET["error"])) {
                echo "<p class='error'>" . $_GET["error"] . "</p>";
            }

            ?>

            <?php
            while ($show = mysqli_fetch_assoc($showtimes)) {

                $movie = getMovieById($show["movie_id"]);

                echo "<p>";

                echo $movie["movie_name"];

                echo " | ";

                echo $show["show_date"];

                echo " | ";

                echo $show["show_time"];

                echo " | $";

                echo $show["ticket_price"];

                echo "</p>";

                echo "<form action='../../controllers/showtimeController.php' method='post'>";

                echo "<input type='hidden' name='show_id' value='" . $show["show_id"] . "'>";

                echo "<input type='submit' name='delete_showtime' value='Delete'>";

                echo "</form>";
            }
            ?>

        </div>

    </div>


    <div class="footer">

        <div class="footer-left">

            <h1>CineVerse</h1>

            <p>
                Level 8 of the Bashundhara City Shopping<br>
                Complex at 13/3 Ka, Panthapath, Tejgaon,<br>
                Dhaka 1205
            </p>

        </div>


        <div class="footer-right">

            <h1>Contact</h1>

            <p>cineverse@gmail.com</p>

            <p>017xxxxxxxx</p>

        </div>

    </div>

</body>

</html>