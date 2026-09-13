<!DOCTYPE html>
<html>

<head>
    <title>Registration</title>
    <link rel="stylesheet" href="../../public/style.css">
</head>

<body>

<div class="navbar">
    <div class="logo">CineVerse</div>

    <div>
        <a href="login.php">Home</a>
        <a href="register.php">Register</a>
    </div>
</div>

<div class="card">

    <h2>Register Here</h2>

    <form method="POST" action="../../controllers/AuthController.php">

        <div class="form-group">
            <label>Username:</label>
            <input type="text" name="name" required>
        </div>

        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" required>
        </div>

        <div class="form-group">
            <label>Password:</label>
            <input type="password" name="password" required>
        </div>

        <div class="center">
            <input type="submit" name="register" value="Register">
        </div>

    </form>

</div>

<div class="footer">

    <div class="footer-content">

        <div>
            <h3>CineVerse</h3>
            <p>Level 8 of the Bashundhara City Shopping Complex</p>
            <p>Complex at 13/3 Ka, Panthapath, Tejgaon</p>
            <p>Dhaka 1205</p>
        </div>

        <div>
            <h3>Contact</h3>
            <p>cineverse@gmail.com</p>
            <p>017xxxxxxxx</p>
        </div>

    </div>

</div>

</body>

</html>