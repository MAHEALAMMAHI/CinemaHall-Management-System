<?php

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'customer') {
    echo "Access Denied";
    exit();
}

require_once "../../models/Showtime.php";
require_once "../../models/Movie.php";

$movie_id = $_GET['movie_id'];

$movie = getMovieById($movie_id);

$showtimes = getShowtimesByMovie($movie_id);

?>

<!DOCTYPE html>
<html>

<head>

    <title>CineVerse - Showtimes</title>

    <link rel="stylesheet" href="../../public/style.css">

</head>

<body>

<div class="navbar">

    <div class="logo">
        CineVerse
    </div>

    <div>
        <a href="dashboard.php">Home</a>
        <a href="movies.php">Movies</a>
        <a href="my_bookings.php">My Bookings</a>
        <a href="edit_profile.php">Profile</a>
        <a href="../../controllers/LogoutController.php">Logout</a>
    </div>

</div>


<div class="showtime-container">

    <div class="showtime-heading">

        <h1>
            <?php echo $movie['title']; ?>
        </h1>

        <p>
            Select a showtime to continue booking.
        </p>

    </div>


    <div class="showtime-list">

        <?php

        if (mysqli_num_rows($showtimes) > 0) {

            while ($showtime = mysqli_fetch_assoc($showtimes)) {

        ?>

        <div class="showtime-card">

            <div class="showtime-info">

                <h2>
                    <?php echo $movie['title']; ?>
                </h2>

                <p>
                    <b>Date:</b>
                    <?php echo $showtime['show_date']; ?>
                </p>

                <p>
                    <b>Time:</b>
                    <?php echo $showtime['show_time']; ?>
                </p>

                <p>
                    <b>Ticket Price:</b>
                    <?php echo $showtime['price']; ?> BDT
                </p>

            </div>


            <div class="showtime-button">

                <a href="seats.php?showtime_id=<?php echo $showtime['id']; ?>">
                    Select Seats
                </a>

            </div>

        </div>

        <?php

            }

        } else {

        ?>

            <div class="no-showtimes">

                <h2>No Showtimes Available</h2>

                <p>
                    There are no available shows for this movie.
                </p>

            </div>

        <?php

        }

        ?>

    </div>


    <div class="center">

        <a href="movies.php">
            Back to Movies
        </a>

    </div>

</div>


<div class="footer">

    <div class="footer-content">

        <div>

            <h3>CineVerse</h3>

            <p>
                Your destination for movies and entertainment.
            </p>

            <p>
                Level 8 of the Bashundhara City Shopping Complex
            </p>

            <p>
                Panthapath, Dhaka 1205
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