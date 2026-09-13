<?php

require_once __DIR__ . "/../config/database.php";

function registerUser($name, $email, $password)
{
    global $conn;

    $check_sql = "SELECT id FROM users WHERE email = '$email'";

    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        return "email_exists";
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, email, password)
            VALUES ('$name', '$email', '$password')";

    if (mysqli_query($conn, $sql)) {
        return true;
    }

    return false;
}

function loginUser($email, $password)
{
    global $conn;

    $sql = "SELECT * FROM users WHERE email = '$email'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {

        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {
            return $user;
        }
    }

    return false;
}

function getUserById($id)
{
    global $conn;

    $sql = "SELECT * FROM users WHERE id = '$id'";

    $result = mysqli_query($conn, $sql);

    return mysqli_fetch_assoc($result);
}

function updateProfile($id, $name, $email)
{
    global $conn;

    $sql = "UPDATE users SET
            name = '$name',
            email = '$email'
            WHERE id = '$id'";

    return mysqli_query($conn, $sql);
}

function checkCurrentPassword($id, $password)
{
    global $conn;

    $sql = "SELECT password FROM users WHERE id = '$id'";

    $result = mysqli_query($conn, $sql);

    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        return true;
    }

    return false;
}

function changePassword($id, $new_password)
{
    global $conn;

    $new_password = password_hash($new_password, PASSWORD_DEFAULT);

    $sql = "UPDATE users SET
            password = '$new_password'
            WHERE id = '$id'";

    return mysqli_query($conn, $sql);
}

function addStaff($name, $email, $password)
{
    global $conn;

    $check_sql = "SELECT id FROM users WHERE email = '$email'";

    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        return "email_exists";
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users
            (name, email, password, role)
            VALUES
            ('$name', '$email', '$password', 'staff')";

    if (mysqli_query($conn, $sql)) {
        return true;
    }

    return false;
}

function getAllStaff()
{
    global $conn;

    $sql = "SELECT * FROM users
            WHERE role = 'staff'
            ORDER BY id DESC";

    return mysqli_query($conn, $sql);
}

function updateStaff($id, $name, $email)
{
    global $conn;

    $sql = "UPDATE users SET
            name = '$name',
            email = '$email'
            WHERE id = '$id'
            AND role = 'staff'";

    return mysqli_query($conn, $sql);
}

function deleteStaff($id)
{
    global $conn;

    $sql = "DELETE FROM users
            WHERE id = '$id'
            AND role = 'staff'";

    return mysqli_query($conn, $sql);
}

?>