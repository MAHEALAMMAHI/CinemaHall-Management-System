<?php
require_once "dbConnect.php";

function emailExists($email)
{
    global $conn;
    $sql = "SELECT * FROM customer WHERE customer_email = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "s", $email);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}
function registerCustomer($name, $email, $phone, $gender, $password)
{
    global $conn;

    $sql = "INSERT INTO customer (customer_name, customer_email, customer_phone, gender, password)
        VALUES(?,?,?,?,?)";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "sssss", $name, $email, $phone, $gender, $password);

    if (mysqli_stmt_execute($stmt)) {
        return true;
    } else {
        return false;
    }
}

function loginCustomer($email, $password)
{
    global $conn;

    $sql = "SELECT * FROM customer
    WHERE customer_email = ? AND password = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "ss", $email, $password);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 1) {
        return mysqli_fetch_assoc($result);
    } else {
        return false;
    }
}

function getCustomerById($customerId)
{
    global $conn;
    $sql = "SELECT * FROM customer WHERE customer_id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $customerId);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 1) {
        return mysqli_fetch_assoc($result);
    } else {
        return false;
    }
}

function emailExistsForOtherCustomer($email, $customerId)
{
    global $conn;
    $sql = "SELECT * FROM customer
    WHERE customer_email = ? AND customer_id != ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "si", $email, $customerId);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

function updateCustomer($customerId, $name, $email, $phone, $password)
{
    global $conn;

    $sql = "UPDATE customer 
    SET customer_name = ?, customer_email = ?, customer_phone = ?, password = ?
    WHERE customer_id = ? ";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "ssssi",
        $name,
        $email,
        $phone,
        $password,
        $customerId
    );

    if (mysqli_stmt_execute($stmt)) {
        return true;
    } else {
        return false;
    }
}
?>