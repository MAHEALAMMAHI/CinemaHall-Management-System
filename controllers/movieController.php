<?php
require_once "../models/movieModel.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $movieName = trim($_POST["movieName"]);
    $duration = trim($_POST["duration"]);
    $status = $_POST["status"] ?? "";

    $fileError = $_FILES["thumbnail"]["error"];
    $fileType = $_FILES["thumbnail"]["type"];
    $fileSize = $_FILES["thumbnail"]["size"];
    $fileName = $_FILES["thumbnail"]["name"];

    $allowedType = ["image/jpeg", "image/png"];
    $maxSize = 2 * 1024 * 1024;

    $hasError = false;

    if ($movieName == "") {
        $hasError = true;
    }

    if ($duration == "") {
        $hasError = true;
    }

    if ($status == "") {
        $hasError = true;
    }

    if ($fileError == 4) {
        $hasError = true;
    } elseif (!in_array($fileType, $allowedType)) {
        $hasError = true;
    } elseif ($fileSize > $maxSize) {
        $hasError = true;
    }

    if (!$hasError) {
        $uploadDir = __DIR__ . "/../views/images/";

        $tempLoc = $_FILES["thumbnail"]["tmp_name"];

        $destination = $uploadDir . $fileName;

        $success = move_uploaded_file($tempLoc, $destination);

        if ($success) {
            if (addMovie($movieName, $duration, $fileName, $status)) {
                header("Location: ../views/staff/add_movie.php?success=Movie added successfully");
                exit();
            } else {
                echo "Movie could not be added";
            }
        } else {
            echo "Thumbnail upload failed";
        }
    } else {
        echo "Please fill all fields correctly";
    }
}
?>