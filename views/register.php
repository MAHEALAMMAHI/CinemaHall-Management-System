<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration - Cineverse</title>
    <link rel="stylesheet" href="css/auth.css">
</head>

<body>
    <div class="left-section"></div>
    <div class="right-section">
        <div class="form-container">
            <h1>Registration</h1>
            <form action="../controllers/registerController.php" method="post">

                <label for="name">Name</label>
                <input type="text" name="name" id="name">

                <span class="error">
                    <?php
                    if (isset($_GET["nameErr"])) {
                        echo $_GET["nameErr"];
                    }
                    ?>
                </span>

                <label for="email">Email</label>
                <input type="email" name="email" id="email">

                <span class="error">
                    <?php
                    if (isset($_GET["emailErr"])) {
                        echo $_GET["emailErr"];
                    }
                    ?>
                </span>

                <label for="phone">Phone</label>
                <div class="phone-input">
                    <span class="country-code">+88</span>

                    <input type="text" name="phone" id="phone" placeholder="01XXXXXXXXX">
                </div>

                <span class="error">
                    <?php
                    if (isset($_GET["phoneErr"])) {
                        echo $_GET["phoneErr"];
                    }
                    ?>
                </span>

                <label>Gender</label>
                <div class="gender-container">
                    <input type="radio" name="gender" value="male" id="male">
                    <label for="male" class="gender-label">Male</label>

                    <input type="radio" name="gender" value="female" id="female">
                    <label for="female" class="gender-label">Female</label>
                </div>

                <span class="error">
                    <?php
                    if (isset($_GET["genderErr"])) {
                        echo $_GET["genderErr"];
                    }
                    ?>
                </span>

                <label for="password">Password</label>
                <input type="password" name="password" id="password">

                <span class="error">
                    <?php
                    if (isset($_GET["passwordErr"])) {
                        echo $_GET["passwordErr"];
                    }
                    ?>
                </span>

                <label for="confirmPassword">Confirm Password</label>
                <input type="password" name="confirmPassword" id="confirmPassword">

                <span class="error">
                    <?php
                    if (isset($_GET["confirmPasswordErr"])) {
                        echo $_GET["confirmPasswordErr"];
                    }
                    ?>
                </span>

                <input type="submit" name="register" value="Register">

                <div class="login-link">
                    <span>Already have an account?</span>
                    <a href="login.php">Login here</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>