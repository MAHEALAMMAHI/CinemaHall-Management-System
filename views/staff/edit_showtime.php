<?php

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'staff') {
    echo "Access Denied";
    exit();
}

require_once "../../models/Showtime.php";
require_once "../../models/Movie.php";

$id = $_GET['id'];

$showtime = getShowtimeById($id);
$movies = getAllMovies();

?>

<!DOCTYPE html>
<html>

<head>

    <title>Edit Showtime - CineVerse</title>

    <link rel="stylesheet" href="../../public/style.css">

    <style>

        .edit-showtime-container {
            width: 90%;
            max-width: 800px;
            margin: 35px auto;
            flex: 1;
        }

        .edit-showtime-card {
            background: rgba(255, 255, 255, 0.96);
            padding: 35px;
            border-radius: 18px;
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.3);
        }

        .edit-showtime-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .edit-showtime-header h1 {
            margin: 0 0 8px;
            color: #003b5c;
            font-size: 32px;
        }

        .edit-showtime-header p {
            margin: 0;
            color: #666;
            font-size: 16px;
        }

        .edit-showtime-card form {
            background: transparent;
            box-shadow: none;
            padding: 0;
            margin: 0;
        }

        .showtime-form-group {
            margin-bottom: 20px;
        }

        .showtime-form-group label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
            color: #333;
        }

        .showtime-form-group input,
        .showtime-form-group select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
            background: white;
        }

        .showtime-form-group input:focus,
        .showtime-form-group select:focus {
            outline: none;
            border-color: #003b5c;
            box-shadow: 0 0 5px rgba(0, 59, 92, 0.2);
        }

        .edit-showtime-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 30px;
        }

        .update-showtime-button {
            padding: 12px 25px;
            background: #003b5c;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
        }

        .update-showtime-button:hover {
            background: #00557f;
        }

        .back-showtime-button {
            display: inline-block;
            padding: 12px 25px;
            background: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
        }

        .back-showtime-button:hover {
            background: #545b62;
        }

        @media (max-width: 600px) {

            .edit-showtime-container {
                width: 94%;
                margin: 25px auto;
            }

            .edit-showtime-card {
                padding: 25px 20px;
            }

            .edit-showtime-header h1 {
                font-size: 27px;
            }

            .edit-showtime-buttons {
                flex-direction: column;
            }

            .update-showtime-button,
            .back-showtime-button {
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

        <a href="showtimes.php">Showtimes</a>

        <a href="../../controllers/LogoutController.php">Logout</a>

    </div>

</div>


<div class="edit-showtime-container">

    <div class="edit-showtime-card">

        <div class="edit-showtime-header">

            <h1>Edit Showtime</h1>

            <p>Update the showtime information below</p>

        </div>


        <form method="POST" action="../../controllers/ShowtimeController.php">

            <input
                type="hidden"
                name="id"
                value="<?php echo $showtime['id']; ?>"
            >


            <div class="showtime-form-group">

                <label>Select Movie</label>

                <select name="movie_id" required>

                    <?php

                    while ($movie = mysqli_fetch_assoc($movies)) {

                        if ($movie['id'] == $showtime['movie_id']) {

                    ?>

                        <option
                            value="<?php echo $movie['id']; ?>"
                            selected
                        >
                            <?php echo $movie['title']; ?>
                        </option>

                    <?php

                        } else {

                    ?>

                        <option
                            value="<?php echo $movie['id']; ?>"
                        >
                            <?php echo $movie['title']; ?>
                        </option>

                    <?php

                        }
                    }

                    ?>

                </select>

            </div>


            <div class="showtime-form-group">

                <label>Show Date</label>

                <input
                    type="date"
                    name="show_date"
                    value="<?php echo $showtime['show_date']; ?>"
                    required
                >

            </div>


            <div class="showtime-form-group">

                <label>Show Time</label>

                <input
                    type="time"
                    name="show_time"
                    value="<?php echo $showtime['show_time']; ?>"
                    required
                >

            </div>


            <div class="showtime-form-group">

                <label>Price</label>

                <input
                    type="number"
                    name="price"
                    value="<?php echo $showtime['price']; ?>"
                    step="0.01"
                    required
                >

            </div>


            <div class="edit-showtime-buttons">

                <input
                    type="submit"
                    name="update_showtime"
                    value="Update Showtime"
                    class="update-showtime-button"
                >

                <a
                    href="showtimes.php"
                    class="back-showtime-button"
                >
                    Back to Showtimes
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