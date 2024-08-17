<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CareCompass-Admin Page</title>
    <link rel="stylesheet" href="./css/bootstrap.css">
</head>

<body class="bg-light" style="background-image: url('https://png.pngtree.com/background/20221202/original/pngtree-medical-healthcare-hospital-theme-background-picture-image_1978478.jpg');">
    <div class="container">
        <center>
            <h1>Welcome to CareCompass Admin Page</h1>
            <img class="nav-logo" src="Medicare(1).png">
            <div class="form-container">
                <form name="form" action="connection_access.php" method="POST">
                    <label><i>UserName</i></label>
                    <input type="text" name="username" required><br>
                    <label><i>PassWord</i></label>
                    <input type="password" name="password" required><br><br>
                    <button type="submit" name="login">Login</button>
                </form>
                <a href="admin_signup.php" class="signup-link">SignUp</a>
            </div>
        </center>
    </div>
</body>

</html>