<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
    <link rel="stylesheet" href="./css/bootstrap.css">
</head>

<body class="bg-light" style="background-image: url('https://png.pngtree.com/background/20221202/original/pngtree-medical-healthcare-hospital-theme-background-picture-image_1978478.jpg');">
    <center>
        <div class="container">
            <h1>Welcome to CareCompass SignUp Page</h1> <br>
            <form id="registrationForm" action="connection_access.php" method="post">
                <label for="username">Choose a Username:</label><br>
                <input type='text' name='username' id="username" placeholder="Your username" required /> <br>
                <label for="password">Choose a Password:</label><br>
                <input type='password' name='password' id="password" placeholder="Your password" required /> <br>
                <input type='submit' name='signup' value='Sign Up' /><br />
                <a href="./signup.php">Retry</a>
            </form>
            <a href="index.php" style="font-size: 24px;">Back</a>
        </div>
    </center>
</body>

</html>