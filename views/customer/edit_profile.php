<?php

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'customer') {
    echo "Access denied!";
    exit();
}

require_once "../../config/database.php";

$user_id = $_SESSION['user_id'];

$message = "";

if (isset($_POST['update_profile'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];

    $sql = "UPDATE users SET name='$name', email='$email' WHERE id='$user_id'";

    if (mysqli_query($conn, $sql)) {

        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;

        $message = "Profile updated successfully!";

    } else {

        $message = "Profile update failed!";

    }
}

if (isset($_POST['delete_profile'])) {

    $sql = "DELETE FROM users WHERE id='$user_id'";

    if (mysqli_query($conn, $sql)) {

        session_destroy();

        header("Location: ../auth/login.php");
        exit();

    } else {

        $message = "Profile delete failed!";

    }
}

$sql = "SELECT name, email FROM users WHERE id='$user_id'";

$result = mysqli_query($conn, $sql);

$user = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html>

<head>

    <title>Edit Profile - CineVerse</title>

    <link rel="stylesheet" href="../../public/style.css">

    <style>

        .update-section {
            text-align: center;
            margin: 20px 0;
        }

        .update-form {
            display: none;
        }

        .back-button {
            display: inline-block;
            padding: 10px 22px;
            background: #777;
            color: white;
            text-decoration: none;
            border-radius: 7px;
            font-size: 15px;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }

        .back-button:hover {
            background: #555;
        }

    </style>

</head>

<body>

<div class="navbar">

    <div class="logo">
        CineVerse
    </div>

    <div>

        <a href="dashboard.php">Dashboard</a>

        <a href="movies.php">Movies</a>

        <a href="my_bookings.php">My Bookings</a>

        <a href="edit_profile.php">Edit Profile</a>

        <a href="../../controllers/LogoutController.php">
            Logout
        </a>

    </div>

</div>


<div class="card">

    <h2>My Profile</h2>

    <?php if ($message != "") { ?>

        <p class="center">
            <?php echo $message; ?>
        </p>

    <?php } ?>


    <div class="profile-box">

        <h3>Name</h3>

        <p>
            <?php echo $user['name']; ?>
        </p>

        <h3>Email</h3>

        <p>
            <?php echo $user['email']; ?>
        </p>

    </div>


    <div class="update-section">

        <button type="button" onclick="showUpdateForm()">
            Update Profile
        </button>

    </div>


    <div id="updateForm" class="update-form">

        <hr>

        <h2>Update Profile</h2>

        <form method="POST">

            <div class="form-group">

                <label>Name:</label>

                <input
                    type="text"
                    name="name"
                    value="<?php echo $user['name']; ?>"
                    required
                >

            </div>


            <div class="form-group">

                <label>Email:</label>

                <input
                    type="email"
                    name="email"
                    value="<?php echo $user['email']; ?>"
                    required
                >

            </div>


            <div class="center">

                <input
                    type="submit"
                    name="update_profile"
                    value="Update Profile"
                >

            </div>


            <div class="center">

                <button
                    type="button"
                    class="back-button"
                    onclick="hideUpdateForm()"
                >
                    Back
                </button>

            </div>

        </form>

    </div>


    <hr>


    <h2>Account Security</h2>

    <div class="center">

        <a href="change_password.php">
            <button type="button">
                Change Password
            </button>
        </a>

    </div>


    <hr>


    <h2>Delete Profile</h2>

    <form method="POST">

        <div class="center">

            <input
                type="submit"
                name="delete_profile"
                value="Delete My Profile"
            >

        </div>

    </form>


    <div class="center">

        <a href="dashboard.php" class="back-button">
            Back to Dashboard
        </a>

    </div>

</div>


<div class="footer">

    <div class="footer-content">

        <div>

            <h3>CineVerse</h3>

            <p>
                Level 8 of the Bashundhara City Shopping Complex
            </p>

            <p>
                Complex at 13/3 Ka, Panthapath, Tejgaon
            </p>

            <p>
                Dhaka 1205
            </p>

        </div>


        <div>

            <h3>Contact</h3>

            <p>
                cineverse@gmail.com
            </p>

            <p>
                017xxxxxxxx
            </p>

        </div>

    </div>

</div>


<script>

function showUpdateForm() {
    document.getElementById("updateForm").style.display = "block";
}

function hideUpdateForm() {
    document.getElementById("updateForm").style.display = "none";
}

</script>

</body>

</html>