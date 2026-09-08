<?php
session_start();
require_once "../../models/movieModel.php";

if (!isset($_SESSION["customer_id"])) {
    header("Location: ../login.php");
    exit();
}

$nowShowing = getMoviesByStatus("Now Showing");
$upcoming = getMoviesByStatus("Upcoming");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - CineVerse</title>
    <link rel="stylesheet" href="../css/home.css?v=2">
</head>

<body>
    <div class="navbar">
        <div class="logo">
            CineVerse
        </div>
        <div class="nav-links">
            <a href="home.php">Home</a>
            <a href="movies.php">Movies</a>
            <a href="#contact">Contact</a>
        </div>
        <div class="user">

            <a href="profile.php">
                <?php echo $_SESSION["customer_name"]; ?>
            </a>

            <span class="separator">||</span>

            <a href="../logout.php">
                Logout
            </a>

        </div>
    </div>

    <div class="movie-section">
        <h1>Upcoming Movies</h1>

        <div class="movie-container">

            <?php
            while ($movie = mysqli_fetch_assoc($upcoming)) {

                echo "<div class='movie'>";
                echo "<img src='../images/" . $movie["thumbnail"] . "' alt='" . $movie["movie_name"] . "'>";
                echo "</div>";
            }
            ?>

        </div>


        <h1><span class="live-dot"></span>Now Showing</h1>

        <div class="movie-container">

            <?php
            while ($movie = mysqli_fetch_assoc($nowShowing)) {

                echo "<div class='movie'>";
                echo "<img src='../images/" . $movie["thumbnail"] . "' alt='" . $movie["movie_name"] . "'>";
                echo "</div>";
            }
            ?>

        </div>
    </div>


    <div class="footer" id="contact">

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