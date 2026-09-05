<?php
$movie = $_GET["movie"] ?? "";

$title = "";
$image = "";
$ticket = "";
$hall = "";

if ($movie == "spiderman") {
    $title = "SPIDER-MAN BRAND NEW DAY";
    $image = "spiderman.jpeg";
    $ticket = "10$";
    $hall = "01";
}
if ($movie == "frozen") {
    $title = "FROZEN";
    $image = "frozen.jpeg";
    $ticket = "10$";
    $hall = "02";
}
if ($movie == "batman") {
    $title = "THE BATMAN";
    $image = "batman.jpeg";
    $ticket = "10$";
    $hall = "03";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Ticket - CineVerse</title>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/booking.css">
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
            <span>Sadat Ishraq</span>
            <span class="profile-icon"></span>
        </div>

    </div>

    <div class="booking-section">
        <div class="movie-details">
            <img src="images/<?php echo $image; ?>" alt="<?php echo $title; ?>">
            <h1>><?php echo $title; ?></h1>
            <p>Ticket: <?php echo $ticket; ?></p>
            <p>Hall: <?php echo $hall; ?></p>
        </div>

        <div class="booking-options">
            <form action="../controllers/bookingController.php" method="post">
                <input type="hidden" name="movie" value="<?php echo $movie; ?>">

                <h1>Showtime</h1>
                <div class="showtime-container">
                    <div class="showtime">
                        <input type="radio" name="showtime" value="3pm-5.30pm" id="show1">
                        <label for="show1">3 p.m - 5:30 p.m</label>
                    </div>

                    <div class="showtime">
                        <input type="radio" name="showtime" value="3pm-5.30pm" id="show2">
                        <label for="show2">8 p.m - 10:30 p.m</label>
                    </div>
                </div>

                <h1>Seat</h1>
                <div class="seat-row">
                    <div class="seat">
                        <input type="checkbox" name="seats[]" value="A1" id="A1">
                        <label for="A1">A1</label>
                    </div>

                    <div class="seat">
                        <input type="checkbox" name="seats[]" value="A2" id="A2">
                        <label for="A2">A2</label>
                    </div>

                    <div class="seat">
                        <input type="checkbox" name="seats[]" value="A3" id="A3">
                        <label for="A3">A3</label>
                    </div>

                    <div class="seat">
                        <input type="checkbox" name="seats[]" value="A4" id="A4">
                        <label for="A4">A4</label>
                    </div>
                </div>



                <div class="seat-row">
                    <div class="seat">
                        <input type="checkbox" name="seats[]" value="B1" id="B1">
                        <label for="B1">B1</label>
                    </div>

                    <div class="seat">
                        <input type="checkbox" name="seats[]" value="B2" id="B2">
                        <label for="B2">B2</label>
                    </div>

                    <div class="seat">
                        <input type="checkbox" name="seats[]" value="B3" id="B3">
                        <label for="B3">B3</label>
                    </div>

                    <div class="seat">
                        <input type="checkbox" name="seats[]" value="B4" id="B4">
                        <label for="B4">B4</label>
                    </div>
                </div>




                <div class="seat-row">
                    <div class="seat">
                        <input type="checkbox" name="seats[]" value="C1" id="C1">
                        <label for="C1">C1</label>
                    </div>

                    <div class="seat">
                        <input type="checkbox" name="seats[]" value="C2" id="C2">
                        <label for="C2">C2</label>
                    </div>

                    <div class="seat">
                        <input type="checkbox" name="seats[]" value="C3" id="C3">
                        <label for="C3">C3</label>
                    </div>

                    <div class="seat">
                        <input type="checkbox" name="seats[]" value="C4" id="C4">
                        <label for="C4">C4</label>
                    </div>
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