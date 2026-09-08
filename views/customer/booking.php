<?php
session_start();

require_once "../../models/movieModel.php";
require_once "../../models/bookingModel.php";

if (!isset($_SESSION["customer_id"])) {
    header("Location: ../login.php");
    exit();
}

$movieId = $_GET["movie_id"] ?? "";

if ($movieId == "") {
    header("Location: movies.php");
    exit();
}

$movie = getMovieById($movieId);

if (!$movie) {
    header("Location: movies.php");
    exit();
}
$shows = getShowsByMovieId($movieId);
$seats = getSeatsByHallId(1);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Ticket - CineVerse</title>
    <link rel="stylesheet" href="../css/home.css?v=2">
    <link rel="stylesheet" href="../css/booking.css">
</head>

<body>
    <div class="navbar">
        <div class="logo">CineVerse</div>

        <div class="nav-links">
            <a href="home.php">Home</a>
            <a href="movies.php">Movie</a>
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

    <div class="booking-section">
        <div class="movie-details">
            <img src="../images/<?php echo $movie["thumbnail"]; ?>"
                alt="<?php echo $movie["movie_name"]; ?>">

            <h1>
                <?php echo $movie["movie_name"]; ?>
            </h1>

            <p>
                Duration: <?php echo $movie["movie_duration"]; ?>
            </p>
        </div>

        <div class="booking-options">
            <form action="../../controllers/bookingController.php" method="post">
                <input type="hidden" name="movie_id" value="<?php echo $movie["movie_id"]; ?>">

                <h1>Showtime</h1>
                <div class="showtime-container">

                    <?php
                    while ($show = mysqli_fetch_assoc($shows)) {

                        echo "<div class='showtime'>";

                        echo "<input type='radio' name='show_id' value='" . $show["show_id"] . "'>";

                        echo "<label>";
                        echo $show["show_time"] . " - $" . $show["ticket_price"];
                        echo "</label>";

                        echo "</div>";
                    }
                    ?>

                </div>

                <h1>Seat</h1>

                <div class="seat-row">

                    <?php

                    while ($seat = mysqli_fetch_assoc($seats)) {

                        echo "<div class='seat'>";

                        echo "<input type='checkbox' name='seats[]' value='" . $seat["seat_id"] . "' id='seat" . $seat["seat_id"] . "'>";

                        echo "<label for='seat" . $seat["seat_id"] . "'>";
                        echo $seat["seat_number"];
                        echo "</label>";

                        echo "</div>";
                    }

                    ?>

                </div>


                <input type="submit" name="confirm" value="Confirm">
            </form>
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