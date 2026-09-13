<?php

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'customer') {
    echo "Access Denied";
    exit();
}

require_once "../../models/Movie.php";

$movies = getAllMovies();

?>

<!DOCTYPE html>
<html>

<head>

    <title>CineVerse - Movies</title>

    <link rel="stylesheet" href="../../public/style.css">

    <style>

        .back-button {
            display: inline-block;
            padding: 12px 25px;
            background: #003b5c;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            margin-top: 20px;
        }

        .back-button:hover {
            background: #00557f;
        }

    </style>

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


<div class="movies-container">

    <div class="movies-heading">

        <h1>Movies</h1>

        <p>
            Choose your favorite movie and book your seat.
        </p>

        <a href="dashboard.php" class="back-button">
            Back to Dashboard
        </a>

    </div>


    <div class="movies-grid">

        <?php

        if (mysqli_num_rows($movies) > 0) {

            while ($movie = mysqli_fetch_assoc($movies)) {

        ?>

        <div class="movie-box">

            <div class="movie-poster">

                <?php

                if (!empty($movie['poster'])) {

                ?>

                    <img
                        src="../../public/images/<?php echo $movie['poster']; ?>"
                        alt="<?php echo $movie['title']; ?>"
                    >

                <?php

                } else {

                ?>

                    <div class="no-poster">
                        No Poster
                    </div>

                <?php

                }

                ?>

            </div>


            <div class="movie-info">

                <h2>
                    <?php echo $movie['title']; ?>
                </h2>

                <p>
                    <?php echo $movie['description']; ?>
                </p>

                <p>
                    <b>Genre:</b>
                    <?php echo $movie['genre']; ?>
                </p>

                <p>
                    <b>Duration:</b>
                    <?php echo $movie['duration']; ?> minutes
                </p>

                <p>
                    <b>Release Date:</b>
                    <?php echo $movie['release_date']; ?>
                </p>

                <a
                    class="book-button"
                    href="showtimes.php?movie_id=<?php echo $movie['id']; ?>"
                >
                    Book Now
                </a>

            </div>

        </div>

        <?php

            }

        } else {

        ?>

            <div class="no-movies">

                <h2>No Movies Available</h2>

                <p>
                    Please check again later.
                </p>

            </div>

        <?php

        }

        ?>

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