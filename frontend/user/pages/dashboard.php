<?php
include '../../../backend/user/dashboard.php'; // Fetch user data from backend
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SDHostel - Dashboard</title>
    <link rel="stylesheet" href="../CSS/dashboard.css">
    <link rel="stylesheet" href="../CSS/dash.css">
    <script src="../javascript/script.js"></script>
</head>

<body>
    <?php include 'sidebar.php'; ?>
    <div class="content">
        <?php include 'topbar.php'; ?>

        <div class="main-content">
            <h2>Welcome back, <?php echo htmlspecialchars($userData['firstName']); ?> 👋</h2>

            <div class="dashboard-cards">
                <div class="card">
                    <h3>Room Number</h3>
                    <p><?php echo htmlspecialchars($userData['room_number']); ?></p>
                </div>
                <div class="card">
                    <h3>Room Status</h3>
                    <p><?php echo htmlspecialchars($userData['room_status']); ?></p>
                </div>
                <div class="card">
                    <h3>Maintenance Requests</h3>
                    <p>2 Pending</p>
                </div>
                <div class="card">
                    <h3>Fees Status</h3>
                    <p><?php echo htmlspecialchars($userData['fees_status']); ?></p>
                </div>
            </div>

            <div class="section">
                <h3>Latest Notices 📢</h3>
                <table class="notice-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Notice</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>2025-04-01</td>
                            <td>Water supply will be off from 10 AM to 1 PM.</td>
                        </tr>
                        <tr>
                            <td>2025-03-28</td>
                            <td>Submit your maintenance complaints by 30th March.</td>
                        </tr>
                        <tr>
                            <td>2025-03-25</td>
                            <td>Common area cleaning scheduled for Saturday.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
