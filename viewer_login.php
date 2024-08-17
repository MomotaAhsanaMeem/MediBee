<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CareCompass-Admin Page</title>
</head>

<body class="bg-light" style="background-image: url('https://png.pngtree.com/background/20221202/original/pngtree-medical-healthcare-hospital-theme-background-picture-image_1978478.jpg');">
    <div class="container">
        <center>
            <img class="nav-logo" src="Medicare(1).png">
            <h1>Log in</h1>
            <div class="form-container">
                <?php if (isset($_SESSION['message'])) : ?>
                    <p><?php echo $_SESSION['message'];
                        unset($_SESSION['message']); ?></p>
                <?php endif; ?>
                <form name="form" action="connection_access.php" method="POST">
                    <label><i>Name</i></label>
                    <input type="text" name="customer_name" required><br>
                    <label><i>Password</i></label>
                    <input type="password" name="password" required><br><br>
                    <button type="submit" name="viewer_login">Login</button>
                </form>
                <a href="viewer_signup.php" class="signup-link">Back</a>
            </div>
        </center>
    </div>
</body>

</html>