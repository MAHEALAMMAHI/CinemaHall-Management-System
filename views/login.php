<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Cineverse</title>
    <link rel="stylesheet" href="css/auth.css">
</head>

<body>
    <div class="left-section"></div>
    <div class="right-section">
        <div class="form-container">
            <h1>Login</h1>
            <form action="../controllers/loginController.php" method="post">
                <label for="email">Email</label>
                <input type="text" name="email" id="email">

                <span class="error">
                    <?php
                    if (isset($_GET["emailErr"])) {
                        echo $_GET["emailErr"];
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

                <span class="error">
                    <?php
                    if (isset($_GET["loginErr"])) {
                        echo $_GET["loginErr"];
                    }
                    ?>
                </span>

                <input type="submit" name="login" value="Login">

                <div class="login-link">
                    <span>Don't have an account?</span>
                    <a href="register.php">Register</a>
                </div>

            </form>
        </div>
    </div>
</body>

</html>