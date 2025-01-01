<?php
include '../../../backend/user/confirm.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email Confirmation</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/confirm.css">
</head>
<body>
    <div class="container confirmation-wrapper">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="status-icon <?php echo $status; ?>">
                    <?php echo ($status === "success") ? "✅" : "❌"; ?>
                </div>
                <h2 class="display-4"><?php echo $message; ?></h2>
                <p class="lead"><?php echo $subMessage; ?></p>
                <p class="lead">Please <a href="login.php">Login</a> to continue.</p>
            </div>
        </div>
    </div>
</body>
</html>
