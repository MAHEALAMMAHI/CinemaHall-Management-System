<?php

require_once __DIR__ . "/../config/database.php";


function createPayment($booking_id, $amount, $payment_method)
{
    global $conn;

    $sql = "INSERT INTO payments
            (booking_id, amount, payment_method, payment_status)
            VALUES
            ('$booking_id', '$amount', '$payment_method', 'paid')";

    return mysqli_query($conn, $sql);
}


function getPaymentByBookingId($booking_id)
{
    global $conn;

    $sql = "SELECT * FROM payments
            WHERE booking_id = '$booking_id'";

    $result = mysqli_query($conn, $sql);

    return mysqli_fetch_assoc($result);
}

?>