<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Movies - CineVerse</title>

    <link rel="stylesheet" href="../css/add_movie.css?v=3">
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

    <div class="main-content">
        <div class="movie-form-container">
            <h1>Add Movie</h1>
            <?php
            if (isset($_GET["success"])) {
                echo "<p class='success'>" . $_GET["success"] . "</p>";
            }
            ?>
            <form action="../../controllers/movieController.php" method="post" enctype="multipart/form-data">

                <label for="movieName">Movie Name</label>
                <input type="text" name="movieName" id="movieName">

                <label for="duration">Duration</label>
                <input type="text" name="duration" id="duration" placeholder="Example: 2 hours 30 minutes">

                <label for="status">Movie Status</label>

                <select name="status" id="status">
                    <option value="">
                        Select Status
                    </option>

                    <option value="Now Showing">
                        Now Showing
                    </option>

                    <option value="Upcoming">
                        Upcoming
                    </option>

                </select>

                <label for="thumbnail">Thumbnail</label>
                <input type="file" name="thumbnail" id="thumbnail">

                <input type="submit" value="Add Movie">
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