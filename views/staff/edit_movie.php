<?php

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'staff') {
    echo "Access Denied";
    exit();
}

require_once "../../models/Movie.php";

$id = $_GET['id'];

$movie = getMovieById($id);

?>

<!DOCTYPE html>
<html>

<head>

    <title>Edit Movie - CineVerse</title>

    <link rel="stylesheet" href="../../public/style.css">

    <style>

        .edit-movie-container {
            width: 90%;
            max-width: 800px;
            margin: 35px auto;
            flex: 1;
        }

        .edit-movie-card {
            background: rgba(255, 255, 255, 0.96);
            padding: 35px;
            border-radius: 18px;
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.3);
        }

        .edit-movie-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .edit-movie-header h1 {
            margin: 0 0 8px;
            color: #003b5c;
            font-size: 32px;
        }

        .edit-movie-header p {
            margin: 0;
            color: #666;
            font-size: 16px;
        }

        .edit-movie-card form {
            background: transparent;
            box-shadow: none;
            padding: 0;
            margin: 0;
        }

        .edit-form-group {
            margin-bottom: 20px;
        }

        .edit-form-group label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
            color: #333;
        }

        .edit-form-group input,
        .edit-form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
            font-family: Arial, sans-serif;
        }

        .edit-form-group textarea {
            min-height: 120px;
            resize: vertical;
        }

        .edit-form-group input:focus,
        .edit-form-group textarea:focus {
            outline: none;
            border-color: #003b5c;
            box-shadow: 0 0 5px rgba(0, 59, 92, 0.2);
        }

        .edit-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 30px;
        }

        .update-button {
            padding: 12px 25px;
            background: #003b5c;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
        }

        .update-button:hover {
            background: #00557f;
        }

        .back-button {
            display: inline-block;
            padding: 12px 25px;
            background: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
        }

        .back-button:hover {
            background: #545b62;
        }

        @media (max-width: 600px) {

            .edit-movie-container {
                width: 94%;
                margin: 25px auto;
            }

            .edit-movie-card {
                padding: 25px 20px;
            }

            .edit-movie-header h1 {
                font-size: 27px;
            }

            .edit-buttons {
                flex-direction: column;
            }

            .update-button,
            .back-button {
                width: 100%;
                text-align: center;
            }

        }

    </style>

</head>

<body>

<div class="navbar">

    <div class="logo">
        CineVerse
    </div>

    <div>

        <a href="dashboard.php">Dashboard</a>

        <a href="movies.php">Movies</a>

        <a href="../../controllers/LogoutController.php">Logout</a>

    </div>

</div>


<div class="edit-movie-container">

    <div class="edit-movie-card">

        <div class="edit-movie-header">

            <h1>Edit Movie</h1>

            <p>Update the movie information below</p>

        </div>


        <form method="POST" action="../../controllers/MovieController.php">

            <input
                type="hidden"
                name="id"
                value="<?php echo $movie['id']; ?>"
            >


            <div class="edit-form-group">

                <label>Movie Title</label>

                <input
                    type="text"
                    name="title"
                    value="<?php echo $movie['title']; ?>"
                    required
                >

            </div>


            <div class="edit-form-group">

                <label>Description</label>

                <textarea
                    name="description"
                ><?php echo $movie['description']; ?></textarea>

            </div>


            <div class="edit-form-group">

                <label>Duration</label>

                <input
                    type="number"
                    name="duration"
                    value="<?php echo $movie['duration']; ?>"
                >

            </div>


            <div class="edit-form-group">

                <label>Genre</label>

                <input
                    type="text"
                    name="genre"
                    value="<?php echo $movie['genre']; ?>"
                >

            </div>


            <div class="edit-form-group">

                <label>Release Date</label>

                <input
                    type="date"
                    name="release_date"
                    value="<?php echo $movie['release_date']; ?>"
                >

            </div>


            <div class="edit-form-group">

                <label>Poster</label>

                <input
                    type="text"
                    name="poster"
                    value="<?php echo $movie['poster']; ?>"
                >

            </div>


            <div class="edit-buttons">

                <input
                    type="submit"
                    name="update_movie"
                    value="Update Movie"
                    class="update-button"
                >

                <a
                    href="movies.php"
                    class="back-button"
                >
                    Back to Movies
                </a>

            </div>

        </form>

    </div>

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