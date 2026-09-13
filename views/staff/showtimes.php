<?php

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'staff') {
    echo "Access Denied";
    exit();
}

require_once "../../models/Showtime.php";
require_once "../../models/Movie.php";

$showtimes = getAllShowtimes();
$movies = getAllMovies();

?>

<!DOCTYPE html>
<html>

<head>

    <title>Showtimes - CineVerse</title>

    <link rel="stylesheet" href="../../public/style.css">

</head>

<body>

<div class="navbar">

    <div class="logo">
        CineVerse
    </div>

    <div>

        <a href="movies.php">Movies</a>

        <a href="showtimes.php">Showtimes</a>

        <a href="../../controllers/LogoutController.php">Logout</a>

    </div>

</div>


<div class="showtime-container">

    <div class="showtime-heading">

        <h1>Manage Showtimes</h1>

        <p>
            Welcome, <?php echo $_SESSION['name']; ?>
        </p>

    </div>


    <div class="card">

        <h2>Add New Showtime</h2>

        <div class="center">

            <input
                type="submit"
                name="add_showtime"
                value="Add Showtime"
                form="showtime-form"
            >

        </div>


        <form
            method="POST"
            action="../../controllers/ShowtimeController.php"
            id="showtime-form"
        >

            <div class="form-group">

                <label>Select Movie:</label>

                <select name="movie_id" required>

                    <option value="">
                        Select a movie
                    </option>

                    <?php

                    while ($movie = mysqli_fetch_assoc($movies)) {

                    ?>

                        <option value="<?php echo $movie['id']; ?>">

                            <?php echo $movie['title']; ?>

                        </option>

                    <?php

                    }

                    ?>

                </select>

            </div>


            <div class="form-group">

                <label>Show Date:</label>

                <input
                    type="date"
                    name="show_date"
                    required
                >

            </div>


            <div class="form-group">

                <label>Show Time:</label>

                <input
                    type="time"
                    name="show_time"
                    required
                >

            </div>


            <div class="form-group">

                <label>Ticket Price:</label>

                <input
                    type="number"
                    name="price"
                    step="0.01"
                    min="0"
                    placeholder="Enter ticket price"
                    required
                >

            </div>

        </form>

    </div>


    <div style="text-align: center; margin: 20px 0;">

        <a href="movies.php"
           style="display: inline-block; background: #003b5c; color: white; padding: 13px 25px; border-radius: 8px; text-decoration: none; font-weight: bold;">
            Back to Movies
        </a>

    </div>


    <div class="showtime-heading">

        <h1>All Showtimes</h1>

        <p>
            Manage movie schedules and ticket prices
        </p>

    </div>


    <?php

    if (mysqli_num_rows($showtimes) > 0) {

    ?>

        <div class="showtime-list">

            <?php

            while ($showtime = mysqli_fetch_assoc($showtimes)) {

            ?>

                <div class="showtime-card">

                    <div class="showtime-info">

                        <h2>
                            <?php echo $showtime['title']; ?>
                        </h2>

                        <p>
                            <strong>Showtime ID:</strong>
                            <?php echo $showtime['id']; ?>
                        </p>

                        <p>
                            <strong>Date:</strong>
                            <?php echo $showtime['show_date']; ?>
                        </p>

                        <p>
                            <strong>Time:</strong>
                            <?php echo $showtime['show_time']; ?>
                        </p>

                        <p>
                            <strong>Ticket Price:</strong>
                            <?php echo $showtime['price']; ?>
                        </p>

                    </div>


                    <div class="showtime-button">

                        <a href="edit_showtime.php?id=<?php echo $showtime['id']; ?>">
                            Edit Showtime
                        </a>

                        <a href="../../controllers/ShowtimeController.php?delete_showtime=<?php echo $showtime['id']; ?>">
                            Delete Showtime
                        </a>

                    </div>

                </div>

            <?php

            }

            ?>

        </div>

    <?php

    } else {

    ?>

        <div class="no-showtimes">

            <h2>No Showtimes Found</h2>

            <p>
                Add a showtime for your movies using the form above.
            </p>

        </div>

    <?php

    }

    ?>

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

            <h3>Staff Panel</h3>

            <p>
                Manage movies and showtimes
            </p>

            <p>
                cineverse@gmail.com
            </p>

        </div>

    </div>

</div>


</body>

</html>