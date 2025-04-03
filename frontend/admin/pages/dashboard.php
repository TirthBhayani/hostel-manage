<?php
include '../../../backend/dbconnection.php'; // Database connection

// Fetch total students
$studentQuery = "SELECT COUNT(*) AS total_students FROM users";
$studentResult = $conn->query($studentQuery);
$total_students = ($studentResult->num_rows > 0) ? $studentResult->fetch_assoc()['total_students'] : 0;

// Fetch total rooms
$roomQuery = "SELECT COUNT(*) AS total_rooms FROM rooms";
$roomResult = $conn->query($roomQuery);
$total_rooms = ($roomResult->num_rows > 0) ? $roomResult->fetch_assoc()['total_rooms'] : 0;

// Fetch available rooms
$availableRoomQuery = "SELECT COUNT(*) AS available_rooms FROM rooms WHERE status = 'available'";
$availableRoomResult = $conn->query($availableRoomQuery);
$available_rooms = ($availableRoomResult->num_rows > 0) ? $availableRoomResult->fetch_assoc()['available_rooms'] : 0;

// Fetch occupied rooms
$occupiedRoomQuery = "SELECT COUNT(*) AS occupied_rooms FROM rooms WHERE status = 'occupied'";
$occupiedRoomResult = $conn->query($occupiedRoomQuery);
$occupied_rooms = ($occupiedRoomResult->num_rows > 0) ? $occupiedRoomResult->fetch_assoc()['occupied_rooms'] : 0;

// Fetch pending fees
$pendingFeesQuery = "SELECT SUM(amount) AS total_pending FROM fees WHERE status = 'pending'";
$pendingFeesResult = $conn->query($pendingFeesQuery);
$total_pending_fees = ($pendingFeesResult->num_rows > 0) ? $pendingFeesResult->fetch_assoc()['total_pending'] : 0;

// Fetch maintenance issues
$maintenanceQuery = "SELECT COUNT(*) AS total_issues FROM maintenance_issues";
$maintenanceResult = $conn->query($maintenanceQuery);
$total_maintenance_issues = ($maintenanceResult->num_rows > 0) ? $maintenanceResult->fetch_assoc()['total_issues'] : 0;

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - SDHostel</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../CSS/dashboard.css">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
        }

        .dashboard-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 80vh;
            flex-direction: column;
        }

        .dashboard-row {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .dashboard-card {
            width: 300px;
            height: 200px;
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            color: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }
        .dashboard-card i {
            font-size: 2.5rem;
            margin-bottom: 10px;
            opacity: 0.5;
        }
        .students-card { background: linear-gradient(135deg, #007bff, #0056b3); }
        .rooms-card { background: linear-gradient(135deg, #28a745, #1e7e34); }
        .available-rooms-card { background: linear-gradient(135deg, #ffc107, #e0a800); }
        .occupied-rooms-card { background: linear-gradient(135deg, #dc3545, #a71d2a); }
        .pending-fees-card { background: linear-gradient(135deg, #6f42c1, #563d7c); }
        .maintenance-card { background: linear-gradient(135deg, #17a2b8, #117a8b); }

        .dashboard-card h3 {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .dashboard-card p { 
            font-size: 1.2rem;
            margin: 0;
        }
    </style>
   <script src="../javascript/script.js"></script>
</head>

<body>
    <?php include 'admin_sidebar.php'; ?>

    <div class="content">
        <?php include 'admin_topbar.php'; ?>

        <div class="dashboard-container">
            <!-- First row -->
            <div class="dashboard-row">
                <div class="dashboard-card students-card">
                    <i class="fas fa-user-graduate"></i>
                    <h3><?php echo $total_students; ?></h3>
                    <p>Total Students</p>
                </div>
                <div class="dashboard-card rooms-card">
                    <i class="fas fa-door-closed"></i>
                    <h3><?php echo $total_rooms; ?></h3>
                    <p>Total Rooms</p>
                </div>
                <div class="dashboard-card available-rooms-card">
                    <i class="fas fa-bed"></i>
                    <h3><?php echo $available_rooms; ?></h3>
                    <p>Available Rooms</p>
                </div>
            </div>
            <div class="dashboard-row">
                <div class="dashboard-card occupied-rooms-card">
                    <i class="fas fa-door-open"></i>
                    <h3><?php echo $occupied_rooms; ?></h3>
                    <p>Occupied Rooms</p>
                </div>
                <div class="dashboard-card pending-fees-card">
                    <i class="fas fa-coins"></i>
                    <h3>₹<?php echo number_format($total_pending_fees, 2); ?></h3>
                    <p>Pending Fees</p>
                </div>
                <div class="dashboard-card maintenance-card">
                    <i class="fas fa-tools"></i>
                    <h3><?php echo $total_maintenance_issues; ?></h3>
                    <p>Maintenance Issues</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
