<?php

session_start();

require_once "../../models/movieModel.php";

$movies = getAllMoviesForStaff();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Delete Movies - CineVerse</title>

    <link rel="stylesheet" href="../css/add_movie.css?v=7">
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

            <h1>Delete Movies</h1>

            <?php

            if (isset($_GET["success"])) {
                echo "<p class='success'>" . $_GET["success"] . "</p>";
            }

            if (isset($_GET["error"])) {
                echo "<p class='error'>" . $_GET["error"] . "</p>";
            }

            ?>

            <?php

            while ($movie = mysqli_fetch_assoc($movies)) {

                echo "<p>";

                echo $movie["movie_name"];

                echo " | ";

                echo $movie["movie_duration"];

                echo " | ";

                echo $movie["movie_status"];

                echo "</p>";

                echo "<form action='../../controllers/movieController.php' method='post'>";

                echo "<input type='hidden' name='movie_id' value='" . $movie["movie_id"] . "'>";

                echo "<input type='submit' name='delete_movie' value='Delete'>";

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