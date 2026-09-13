<?php

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'customer') {
    echo "Access Denied";
    exit();
}

require_once "../../config/database.php";

$movie_id = $_GET['movie_id'] ?? null;
$showtime_id = $_GET['showtime_id'] ?? null;

if ($showtime_id) {

    $sql = "SELECT showtimes.*, movies.title
            FROM showtimes
            JOIN movies ON showtimes.movie_id = movies.id
            WHERE showtimes.id = '$showtime_id'";

    $result = mysqli_query($conn, $sql);
    $showtime = mysqli_fetch_assoc($result);

    if (!$showtime) {
        echo "Showtime not found.";
        exit();
    }

    $sql = "SELECT * FROM seats ORDER BY id";
    $seats_result = mysqli_query($conn, $sql);

    $booked_sql = "SELECT seat_id FROM booking_seats
                   WHERE showtime_id = '$showtime_id'";

    $booked_result = mysqli_query($conn, $booked_sql);

    $booked_seats = [];

    while ($row = mysqli_fetch_assoc($booked_result)) {
        $booked_seats[] = $row['seat_id'];
    }

} else {

    if (!$movie_id) {
        echo "Movie not found.";
        exit();
    }

    $sql = "SELECT * FROM movies
            WHERE id = '$movie_id'";

    $result = mysqli_query($conn, $sql);
    $movie = mysqli_fetch_assoc($result);

    if (!$movie) {
        echo "Movie not found.";
        exit();
    }

    $sql = "SELECT * FROM showtimes
            WHERE movie_id = '$movie_id'
            ORDER BY show_date, show_time";

    $showtimes = mysqli_query($conn, $sql);
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Seats</title>

    <link rel="stylesheet" href="../../public/style.css">

</head>

<body>

<div class="container">

<?php if (!$showtime_id) { ?>

    <div class="profile-box">

        <h2>Showtimes</h2>

        <p>
            Movie:
            <b><?php echo $movie['title']; ?></b>
        </p>

    </div>

    <?php if (mysqli_num_rows($showtimes) > 0) { ?>

        <?php while ($time = mysqli_fetch_assoc($showtimes)) { ?>

            <div class="movie-card">

                <h3>
                    <?php echo $movie['title']; ?>
                </h3>

                <p>
                    <b>Date:</b>
                    <?php echo $time['show_date']; ?>
                </p>

                <p>
                    <b>Time:</b>
                    <?php echo $time['show_time']; ?>
                </p>

                <p>
                    <b>Price:</b>
                    <?php echo $time['price']; ?>
                </p>

                <a href="seats.php?showtime_id=<?php echo $time['id']; ?>">
                    Select Seats
                </a>

            </div>

        <?php } ?>

    <?php } else { ?>

        <p>No showtimes available for this movie.</p>

    <?php } ?>

    <div class="center">

        <a href="movies.php">
            Back to Movies
        </a>

    </div>

<?php } else { ?>

    <div class="profile-box">

        <h2>Select Seats</h2>

        <p>
            <b>Movie:</b>
            <?php echo $showtime['title']; ?>
        </p>

        <p>
            <b>Date:</b>
            <?php echo $showtime['show_date']; ?>
        </p>

        <p>
            <b>Time:</b>
            <?php echo $showtime['show_time']; ?>
        </p>

        <p>
            <b>Price per seat:</b>
            <?php echo $showtime['price']; ?>
        </p>

    </div>

    <form method="POST" action="../../controllers/BookingController.php">

        <input
            type="hidden"
            name="showtime_id"
            value="<?php echo $showtime_id; ?>"
        >

        <h3>Select Your Seats</h3>

        <?php if (mysqli_num_rows($seats_result) > 0) { ?>

            <?php while ($seat = mysqli_fetch_assoc($seats_result)) { ?>

                <?php if (in_array($seat['id'], $booked_seats)) { ?>

                    <span class="seat">
                        <?php echo $seat['seat_number']; ?>
                        <br>
                        Booked
                    </span>

                <?php } else { ?>

                    <label class="seat">

                        <input
                            type="checkbox"
                            name="seats[]"
                            value="<?php echo $seat['id']; ?>"
                        >

                        <?php echo $seat['seat_number']; ?>

                    </label>

                <?php } ?>

            <?php } ?>

        <?php } else { ?>

            <p>No seats available.</p>

        <?php } ?>

        <br><br>

        <input
            type="submit"
            name="book_seats"
            value="Book Selected Seats"
        >

    </form>

    <div class="center">

        <a href="seats.php?movie_id=<?php echo $showtime['movie_id']; ?>">
            Back to Showtimes
        </a>

        <br><br>

        <a href="dashboard.php">
            Back to Dashboard
        </a>

    </div>

<?php } ?>

</div>

</body>

</html>