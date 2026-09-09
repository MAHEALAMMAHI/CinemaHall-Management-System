<?php
session_start();

require_once "../../models/showtimeModel.php";

$movies = getAllMovies();
$halls = getAllHalls();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Showtime - CineVerse</title>
    <link rel="stylesheet" href="../css/add_movie.css?v=5">
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

            <a href="manage_showtime.php">
                Manage Showtime
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

    <div class="main-content">
        <div class="movie-form-container">
            <h1>Add Showtime</h1>

            <?php
            if (isset($_GET["success"])) {
                echo "<p class='success'>" . $_GET["success"] . "</p>";
            }
            ?>

            <form action="../../controllers/showtimeController.php" method="post">
                <label for="movie_id">
                    Movie
                </label>

                <select name="movie_id" id="movie_id">
                    <option value="">
                        Select Movie
                    </option>

                    <?php
                    while ($movie = mysqli_fetch_assoc($movies)) {
                        echo "<option value='" . $movie["movie_id"] . "'>";

                        echo $movie["movie_name"];

                        echo "</option>";
                    }
                    ?>
                </select>

                <label for="show_date">
                    Show Date
                </label>
                <input type="date" name="show_date" id="show_date">

                <label for="start_time">
                    Start Time
                </label>

                <input type="time" name="start_time" id="start_time">

                <label for="end_time">
                    End Time
                </label>
                
                <input type="time" name="end_time" id="end_time">

                <label for="ticket_price">
                    Ticket Price
                </label>

                <input type="number" name="ticket_price" id="ticket_price" placeholder="Example: 10.00">

                <label for="hall_id">Hall</label>
                <select name="hall_id" id="hall_id">

                    <option value="">
                        Select Hall
                    </option>

                    <?php
                    while ($hall = mysqli_fetch_assoc($halls)) {
                        echo "<option value='" . $hall["hall_id"] . "'>";

                        echo $hall["hall_name"];

                        echo "</option>";
                    }
                    ?>

                </select>
                <input type="submit" value="Add Showtime">
            </form>
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