<?php

require_once __DIR__ . "/../config/database.php";

function createBooking($user_id, $showtime_id, $total_amount)
{
    global $conn;

    $sql = "INSERT INTO bookings
            (user_id, showtime_id, total_amount)
            VALUES
            ('$user_id', '$showtime_id', '$total_amount')";

    if (mysqli_query($conn, $sql)) {
        return mysqli_insert_id($conn);
    }

    return false;
}


function addBookingSeat($booking_id, $showtime_id, $seat_id)
{
    global $conn;

    $sql = "INSERT INTO booking_seats
            (booking_id, showtime_id, seat_id)
            VALUES
            ('$booking_id', '$showtime_id', '$seat_id')";

    return mysqli_query($conn, $sql);
}


function getMyBookings($user_id)
{
    global $conn;

    $sql = "SELECT 
                bookings.id AS booking_id,
                movies.title,
                showtimes.show_date,
                showtimes.show_time,
                bookings.total_amount,
                bookings.booking_date
            FROM bookings
            JOIN showtimes 
                ON bookings.showtime_id = showtimes.id
            JOIN movies 
                ON showtimes.movie_id = movies.id
            WHERE bookings.user_id = '$user_id'
            ORDER BY bookings.id DESC";

    return mysqli_query($conn, $sql);
}


function getBookingSeats($booking_id)
{
    global $conn;

    $sql = "SELECT seats.seat_number
            FROM booking_seats
            JOIN seats 
                ON booking_seats.seat_id = seats.id
            WHERE booking_seats.booking_id = '$booking_id'";

    return mysqli_query($conn, $sql);
}

?>