<?php

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    echo "Access Denied";
    exit();
}

require_once "../../models/User.php";

$staffs = getAllStaff();

?>

<!DOCTYPE html>
<html>

<head>

    <title>Staff Management - CineVerse</title>

    <link rel="stylesheet" href="../../public/style.css">

    <style>

        .staff-container {
            width: 90%;
            max-width: 1100px;
            margin: 35px auto;
            flex: 1;
        }

        .staff-header {
            background: rgba(255, 255, 255, 0.96);
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 5px 18px rgba(0, 0, 0, 0.3);
            margin-bottom: 25px;
        }

        .staff-header h1 {
            margin: 0 0 10px;
            color: #003b5c;
        }

        .staff-header p {
            margin: 0;
            font-size: 17px;
        }

        .message {
            background: #d4edda;
            color: #155724;
            padding: 14px;
            border-radius: 8px;
            text-align: center;
            margin-top: 20px;
            font-weight: bold;
        }

        .add-staff-box {
            background: rgba(255, 255, 255, 0.96);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 18px rgba(0, 0, 0, 0.25);
            margin-bottom: 25px;
        }

        .add-staff-box h2 {
            margin-top: 0;
            color: #003b5c;
            text-align: center;
        }

        .staff-form {
            max-width: 650px;
            margin: 20px auto 0;
            background: transparent;
            padding: 0;
            box-shadow: none;
        }

        .staff-form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .staff-form input {
            width: 100%;
            padding: 11px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 7px;
            font-size: 15px;
        }

        .staff-form input[type="submit"] {
            width: auto;
            display: inline-block;
            margin: 10px 0 0;
            background: #003b5c;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 7px;
            cursor: pointer;
            font-weight: bold;
        }

        .staff-form input[type="submit"]:hover {
            background: #00557f;
        }

        .back-staff-button {
            display: inline-block;
            margin-left: 10px;
            padding: 12px 25px;
            background: #555;
            color: white;
            border: none;
            border-radius: 7px;
            cursor: pointer;
            font-weight: bold;
            font-size: 15px;
        }

        .back-staff-button:hover {
            background: #333;
        }

        .add-staff-button {
            display: inline-block;
            padding: 12px 25px;
            background: #003b5c;
            color: white;
            border: none;
            border-radius: 7px;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
        }

        .add-staff-button:hover {
            background: #00557f;
        }

        .staff-list-title {
            background: rgba(255, 255, 255, 0.96);
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 20px;
        }

        .staff-list-title h2 {
            margin: 0;
            color: #003b5c;
        }

        .staff-card {
            background: rgba(255, 255, 255, 0.96);
            padding: 25px;
            border-radius: 14px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.25);
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 25px;
        }

        .staff-info {
            flex: 1;
        }

        .staff-info h3 {
            margin-top: 0;
            margin-bottom: 15px;
            color: #003b5c;
        }

        .staff-info p {
            margin: 8px 0;
        }

        .staff-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .edit-staff-button {
            display: inline-block;
            background: #003b5c;
            color: white;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 7px;
            font-weight: bold;
        }

        .edit-staff-button:hover {
            background: #00557f;
        }

        .delete-staff-button {
            display: inline-block;
            background: #dc3545;
            color: white;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 7px;
            font-weight: bold;
        }

        .delete-staff-button:hover {
            background: #b02a37;
        }

        .no-staff {
            background: rgba(255, 255, 255, 0.96);
            padding: 35px;
            border-radius: 12px;
            text-align: center;
            font-size: 18px;
        }

        .staff-navigation {
            background: rgba(255, 255, 255, 0.96);
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            margin-top: 25px;
            margin-bottom: 30px;
        }

        .staff-navigation a {
            display: inline-block;
            margin: 5px;
            padding: 11px 20px;
            background: #003b5c;
            color: white;
            text-decoration: none;
            border-radius: 7px;
            font-weight: bold;
        }

        .staff-navigation a:hover {
            background: #00557f;
        }

        @media (max-width: 600px) {

            .staff-container {
                width: 94%;
            }

            .staff-card {
                flex-direction: column;
                align-items: stretch;
            }

            .staff-actions {
                width: 100%;
                flex-direction: column;
            }

            .edit-staff-button,
            .delete-staff-button {
                width: 100%;
                text-align: center;
            }

            .add-staff-box {
                padding: 20px;
            }

            .back-staff-button {
                margin-left: 5px;
            }

        }

    </style>

</head>

<body>

<div class="navbar">

    <div class="logo">
        CineVerse
    </div>

    <div>

        <a href="dashboard.php">
            Dashboard
        </a>

        <a href="users.php">
            Customers
        </a>

        <a href="../../controllers/LogoutController.php">
            Logout
        </a>

    </div>

</div>


<div class="staff-container">

    <div class="staff-header">

        <h1>
            Staff Management
        </h1>

        <p>
            Welcome, <?php echo $_SESSION['name']; ?>!
        </p>

        <?php

        if (isset($_GET['success'])) {
            echo '<div class="message">
                    Staff added successfully!
                  </div>';
        }

        if (isset($_GET['update'])) {
            echo '<div class="message">
                    Staff updated successfully!
                  </div>';
        }

        if (isset($_GET['delete'])) {
            echo '<div class="message">
                    Staff deleted successfully!
                  </div>';
        }

        ?>

        <br>

        <button
            type="button"
            class="add-staff-button"
            onclick="showStaffForm()"
        >
            Add Staff
        </button>

    </div>


    <div
        class="add-staff-box"
        id="staffForm"
        style="display: none;"
    >

        <h2>
            Add New Staff
        </h2>

        <form
            class="staff-form"
            method="POST"
            action="../../controllers/AdminController.php"
        >

            <label>
                Name:
            </label>

            <input
                type="text"
                name="name"
                required
            >


            <label>
                Email:
            </label>

            <input
                type="email"
                name="email"
                required
            >


            <label>
                Password:
            </label>

            <input
                type="password"
                name="password"
                required
            >


            <input
                type="submit"
                name="add_staff"
                value="Add Staff"
            >

            <button
                type="button"
                class="back-staff-button"
                onclick="hideStaffForm()"
            >
                Back to Staff
            </button>

        </form>

    </div>


    <div class="staff-list-title">

        <h2>
            Registered Staff
        </h2>

    </div>


    <?php

    if (mysqli_num_rows($staffs) > 0) {

        while ($staff = mysqli_fetch_assoc($staffs)) {

    ?>

            <div class="staff-card">

                <div class="staff-info">

                    <h3>
                        <?php echo $staff['name']; ?>
                    </h3>

                    <p>
                        <b>Staff ID:</b>
                        <?php echo $staff['id']; ?>
                    </p>

                    <p>
                        <b>Name:</b>
                        <?php echo $staff['name']; ?>
                    </p>

                    <p>
                        <b>Email:</b>
                        <?php echo $staff['email']; ?>
                    </p>

                    <p>
                        <b>Role:</b>
                        <?php echo $staff['role']; ?>
                    </p>

                </div>


                <div class="staff-actions">

                    <a
                        class="edit-staff-button"
                        href="edit_staff.php?id=<?php echo $staff['id']; ?>"
                    >
                        Edit Staff
                    </a>

                    <a
                        class="delete-staff-button"
                        href="../../controllers/AdminController.php?delete_staff=<?php echo $staff['id']; ?>"
                    >
                        Delete Staff
                    </a>

                </div>

            </div>

    <?php

        }

    } else {

    ?>

        <div class="no-staff">

            No staff found.

        </div>

    <?php

    }

    ?>


    <div class="staff-navigation">

        <a href="dashboard.php">
            Back to Admin Dashboard
        </a>

        <a href="../../controllers/LogoutController.php">
            Logout
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
                Panthapath, Dhaka
            </p>

        </div>


        <div>

            <h3>Admin Panel</h3>

            <p>
                Manage Staff
            </p>

            <p>
                Add, Edit and Delete Staff
            </p>

        </div>

    </div>

</div>


<script>

function showStaffForm() {

    document.getElementById("staffForm").style.display = "block";

}

function hideStaffForm() {

    document.getElementById("staffForm").style.display = "none";

}

</script>

</body>

</html>