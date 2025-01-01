<?php
include '../../../backend/user/login.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Pateldham Hostel Management</title>
    <link rel="stylesheet" href="../CSS/index.css"> <!-- Link to main CSS -->
    <link rel="stylesheet" href="../CSS/login.css"> <!-- Dedicated CSS for login page -->
</head>

<body>
    <header>
        <div class="logo">
            <a href="index.php"><h1>Pateldham Hostel</h1></a>
        </div>
    </header>
    
    <main class="login-container">
        <div class="login-box">
            <h2>Login</h2>
            <?php if ($msg != "") echo $msg . "<br>"; ?>
            <form method="post" action="login.php">
                <input class="form-control" name="email" type="email" placeholder="Email..." required><br>
                <input class="form-control" name="password" type="password" placeholder="Password..." required><br>
                <input class="btn-primary" type="submit" name="submit" value="Log In">
            </form>
            <p>New user? <a href="register.php">Register</a> | <a href="forgetpass.php">Forgot password?</a></p>
        </div>
    </main>
    
    <footer>
        <p>© 2024 Pateldham Hostel Management. All rights reserved.</p>
    </footer>
</body>
</html>
