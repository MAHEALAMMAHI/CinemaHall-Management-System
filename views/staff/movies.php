<?php

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'staff') {
    echo "Access Denied";
    exit();
}

require_once "../../models/Movie.php";

$movies = getAllMovies();

?>

<!DOCTYPE html>
<html>

<head>

    <title>Staff - Movie Management</title>

    <link rel="stylesheet" href="../../public/style.css">

    <style>

        .add-movie-button {
            display: inline-block;
            padding: 12px 25px;
            background: #003b5c;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .add-movie-button:hover {
            background: #00557f;
        }

        .back-movie-button {
            display: inline-block;
            padding: 12px 25px;
            background: #555;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            margin-left: 10px;
        }

        .back-movie-button:hover {
            background: #333;
        }

    </style>

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


<div class="movies-container">

    <div class="movies-heading">

        <h1>Staff Movie Management</h1>

        <p>
            Welcome, <?php echo $_SESSION['name']; ?>!
        </p>

        <div class="dashboard-buttons">

            <button
                type="button"
                class="add-movie-button"
                onclick="showMovieForm()"
            >
                Add Movie
            </button>

        </div>

    </div>


    <div class="card" id="movieForm" style="display: none;">

        <h2>Add New Movie</h2>

        <form method="POST"
              action="../../controllers/MovieController.php">

            <div class="form-group">

                <label>Movie Title:</label>

                <input
                    type="text"
                    name="title"
                    required
                >

            </div>


            <div class="form-group">

                <label>Description:</label>

                <textarea name="description"></textarea>

            </div>


            <div class="form-group">

                <label>Duration:</label>

                <input
                    type="number"
                    name="duration"
                >

            </div>


            <div class="form-group">

                <label>Genre:</label>

                <input
                    type="text"
                    name="genre"
                >

            </div>


            <div class="form-group">

                <label>Release Date:</label>

                <input
                    type="date"
                    name="release_date"
                >

            </div>


            <div class="form-group">

                <label>Poster:</label>

                <input
                    type="text"
                    name="poster"
                >

            </div>


            <div class="dashboard-buttons">

                <input
                    type="submit"
                    name="add_movie"
                    value="Add Movie"
                >

                <button
                    type="button"
                    class="back-movie-button"
                    onclick="hideMovieForm()"
                >
                    Back to Movies
                </button>

            </div>

        </form>

    </div>


    <div class="movies-heading">

        <h1>All Movies</h1>

        <p>
            Manage your movies and showtimes
        </p>

    </div>


    <?php

    if (mysqli_num_rows($movies) > 0) {

        while ($movie = mysqli_fetch_assoc($movies)) {

    ?>

        <div class="movie-card">

            <div class="movie-info">

                <h2>
                    <?php echo $movie['title']; ?>
                </h2>

                <p>
                    <b>Movie ID:</b>
                    <?php echo $movie['id']; ?>
                </p>

                <p>
                    <b>Description:</b>
                    <?php echo $movie['description']; ?>
                </p>

                <p>
                    <b>Duration:</b>
                    <?php echo $movie['duration']; ?> minutes
                </p>

                <p>
                    <b>Genre:</b>
                    <?php echo $movie['genre']; ?>
                </p>

                <p>
                    <b>Release Date:</b>
                    <?php echo $movie['release_date']; ?>
                </p>

                <p>
                    <b>Poster:</b>
                    <?php echo $movie['poster']; ?>
                </p>


                <div class="dashboard-buttons">

                    <a href="edit_movie.php?id=<?php echo $movie['id']; ?>">
                        Edit Movie
                    </a>

                    <a href="../../controllers/MovieController.php?delete_movie=<?php echo $movie['id']; ?>">
                        Delete Movie
                    </a>

                    <a href="showtimes.php">
                        Manage Showtimes
                    </a>

                </div>

            </div>

        </div>

    <?php

        }

    } else {

    ?>

        <div class="no-movies">

            <h2>No movies found.</h2>

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
                Movie Booking System
            </p>

        </div>

        <div>

            <h3>Staff Panel</h3>

            <p>
                Manage Movies and Showtimes
            </p>

        </div>

    </div>

</div>


<script>

function showMovieForm() {

    document.getElementById("movieForm").style.display = "block";

}

function hideMovieForm() {

    document.getElementById("movieForm").style.display = "none";

}

</script>

</body>

</html>