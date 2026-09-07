<?php

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'] ?? "";
    $price = $_POST['price'] ?? "";
    $hall = $_POST['hall'] ?? "";

    $message = "Movie uploaded successfully!";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineVerse - Add Movie</title>

    <link rel="stylesheet" href="add_movie_style.css">
</head>

<body>

    <header class="navbar">

        <div class="logo">
            CineVerse
        </div>

        <div class="nav-links">
            <a href="#">Home</a>
            <a href="add_movie.php">Add Movies</a>
        </div>

        <div class="user-profile">
            <span>Shawlin</span>

            <div class="avatar-icon">
                <svg viewBox="0 0 24 24" width="42" height="42"
                    stroke="currentColor" stroke-width="1.5" fill="none">

                    <circle cx="12" cy="12" r="10"></circle>

                    <path d="M12 14c-3 0-5 2-5 4m10 0c0-2-2-4-5-4"></path>

                    <circle cx="12" cy="9" r="2.5"></circle>

                </svg>
            </div>
        </div>

    </header>


    <main class="main-content">

        <?php if (!empty($message)): ?>

            <p class="message">
                <?php echo htmlspecialchars($message); ?>
            </p>

        <?php endif; ?>


        <h1>Add Movie</h1>


        <form action="add_movie.php" method="POST"
              enctype="multipart/form-data"
              class="movie-form">

            <div class="form-row">

                <label for="title">Title :</label>

                <input type="text" id="title" name="title">

            </div>


            <div class="form-row">

                <label for="price">Ticket Price:</label>

                <input type="text" id="price" name="price">

            </div>


            <div class="form-row">

                <label for="hall">Hall :</label>

                <input type="text" id="hall" name="hall">

            </div>


            <div class="form-row file-row">

                <label>Add thumbnail :</label>

                <input type="file" id="thumbnail" name="thumbnail">

                <label for="thumbnail" class="file-button">
                    Select File
                </label>

            </div>


            <button type="submit" class="upload-button">
                Upload
            </button>

        </form>


        <h2>Add Upcoming Movie</h2>


        <div class="upcoming-form">

            <input type="file" id="upcoming1" name="upcoming1">

            <label for="upcoming1" class="upcoming-button">
                Select File
            </label>


            <input type="file" id="upcoming2" name="upcoming2">

            <label for="upcoming2" class="upcoming-button">
                Select File
            </label>


            <input type="file" id="upcoming3" name="upcoming3">

            <label for="upcoming3" class="upcoming-button">
                Select File
            </label>


            <button type="button" class="upload-button upcoming-upload">
                Upload
            </button>

        </div>

    </main>


    <footer class="footer">

        <div class="footer-left">

            <h3>CineVerse</h3>

            <p>
                Level 8 of the Bashundhara City Shopping<br>
                Complex at 13/3 Ka, Panthapath, Tejgaon,<br>
                Dhaka 1205
            </p>

        </div>


        <div class="footer-right">

            <h3>Contact</h3>

            <p>
                <a href="mailto:cineverse@gmail.com">
                    cineverse@gmail.com
                </a>
            </p>

            <p>
                017xxxxxxxx
            </p>

        </div>

    </footer>

</body>

</html>