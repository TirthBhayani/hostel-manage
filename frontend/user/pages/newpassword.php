<?php
// resetPassword.php

// Retrieve the email and token from the URL parameters
$email = isset($_GET['email']) ? $_GET['email'] : '';
$token = isset($_GET['token']) ? $_GET['token'] : '';

// Optionally handle error messages
$msg = '';
if (isset($_GET['mp']) && $_GET['mp'] === 'false') {
    $msg = 'Passwords do not match.';
} elseif (isset($_GET['mp']) && $_GET['mp'] === 'invalid') {
    $msg = 'Password does not meet the required strength.';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Set New Password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
</head>
<body>
    <div class="container text-center" style="padding-top:4%;">
        <h3 class="display-4">Reset Password</h3>
        
        <?php if ($msg): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo htmlspecialchars($msg); ?>
            </div>
        <?php endif; ?>

        <form action="../../../backend/user/setPass.php" method="post">
            <p>Reset password for <?php echo htmlspecialchars($email); ?></p><br>
            <input type="password" class="form-control" placeholder="New password" name="password" id="password" required/> <br>
            <input type="password" class="form-control" placeholder="Re-enter new password" name="password2" id="password2" required/> <br>
            <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>" />
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>" />
            <input type="submit" name="submit" class="btn btn-primary" />
        </form>
    </div>
</body>
</html>
