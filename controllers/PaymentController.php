<?php

session_start();

require_once "../config/database.php";
require_once "../models/Payment.php";

if (isset($_POST['make_payment'])) {

    if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'customer') {

        echo "Access Denied";
        exit();

    }

    $booking_id = $_POST['booking_id'];
    $amount = $_POST['amount'];
    $payment_method = $_POST['payment_method'];

    if (createPayment($booking_id, $amount, $payment_method)) {

        header("Location: ../views/customer/payment_success.php?booking_id=" . $booking_id . "&amount=" . $amount . "&method=" . urlencode($payment_method));
        exit();

    } else {

        echo "Payment failed!";

    }

}

?>