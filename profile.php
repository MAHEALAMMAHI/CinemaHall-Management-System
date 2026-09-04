<?php

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST['password'] ?? "";
    $confirm = $_POST['confirm_password'] ?? "";

    if ($password != $confirm) {
        $message = "Passwords do not match!";
    } else {
        $message = "Profile updated successfully!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineVerse - User Profile</title>
    <link rel="stylesheet" href="profile_style.css">
</head>

<body>

    <main class="content-wrapper">

        <div class="profile-card">

            <h2 class="card-title">User Profile</h2>

            <?php if (!empty($message)): ?>
                <p class="status-alert">
                    <?php echo htmlspecialchars($message); ?>
                </p>
            <?php endif; ?>

            <form action="profile.php" method="POST" class="profile-form">

                <div class="form-row">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username">
                </div>

                <div class="form-row">
                    <label for="phone">Phone :</label>
                    <input type="text" id="phone" name="phone">
                </div>

                <div class="form-row">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email">
                </div>

                <div class="form-row">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password">
                </div>

                <div class="form-row">
                    <label for="confirm_password">Confirm Password :</label>
                    <input type="password" id="confirm_password" name="confirm_password">
                </div>

                <div class="btn-wrap">
                    <button type="submit" class="btn-update">Update</button>
                </div>

            </form>

        </div>

    </main>

</body>

</html>