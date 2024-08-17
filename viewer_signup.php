<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
</head>

<body class="bg-light" style="background-image: url('https://png.pngtree.com/background/20221202/original/pngtree-medical-healthcare-hospital-theme-background-picture-image_1978478.jpg');">
    <center>
        <div class="container">
            <h1>Sign up before placing your order</h1> <br>
            <?php if (isset($_SESSION['message'])): ?>
                <p><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></p>
            <?php endif; ?>            
            <form id="registrationForm" action="connection_access.php" method="post">
                <label for="customer_name">Your Name:</label><br>
                <input type='text' name='customer_name' id="customer_name" placeholder="Your name" required /><br>
                <label for="email">Email:</label><br>
                <input type='email' name='email' id="email" placeholder="Your email" required /><br>
                <label for="password">Choose a Password:</label><br>
                <input type='password' name='password' id="password" placeholder="Your password" required /><br>
                <input type='submit' name='viewer_signup' value='Sign Up' /><br />
                <a href="./viewer_signup.php">Retry</a>
            </form>
            Already have an account?
            <a href="viewer_login.php" class="signin-link">Login</a><br>
            <a href="index.php" style="font-size: 24px;">Back</a>
        </div>
    </center>
</body>

</html>