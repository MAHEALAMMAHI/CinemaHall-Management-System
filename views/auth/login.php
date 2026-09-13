<!DOCTYPE html>
<html>

<head>

    <title>Login - CineVerse</title>

    <link rel="stylesheet" href="../../public/style.css">

</head>

<body>

<div class="navbar">

    <div class="logo">
        CineVerse
    </div>

    <div>
        <a href="login.php">Home</a>
        <a href="register.php">Register</a>
    </div>

</div>


<div class="card">

    <h2>Welcome to CineVerse</h2>

    <form method="POST" action="../../controllers/AuthController.php">

        <div class="form-group">

            <label>Email:</label>

            <input
                type="email"
                name="email"
                required
            >

        </div>


        <div class="form-group">

            <label>Password:</label>

            <input
                type="password"
                name="password"
                required
            >

        </div>


        <div class="center">

            <input
                type="submit"
                name="login"
                value="Log In"
            >

        </div>

    </form>


    <div class="center">

        <p>Create a new account</p>

        <a href="register.php">
            Register Now
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


</body>

</html>