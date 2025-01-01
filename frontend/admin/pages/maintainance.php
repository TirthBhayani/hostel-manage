<?php
include '../../../backend/adminmaintainance.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Maintenance Issues</title>
    <link rel="stylesheet" href="../CSS/dashboard.css"> <!-- Link to your CSS file -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script>
        $(document).ready(function(){
            $('#example').DataTable();
        })
    </script>
    <script src ="../javascript/script.js"></script>
</head>
<body>
<div class="sidebar">
<ul class="menu">
            <li><a href="hostelfees.php">Hostel Fees</a></li>
            <li><a href="maintainance.php">Maintenance Issue</a></li>
            <li><a href="gate-pass.php">Gate Pass & Leave</a></li>
            <li><a href="latestudent.php">Late student History</a></li>
            <li><a href="room.php">Room Allocation</a></li>
            <li><a href="roomhistory.php">Room record</a></li>
            <li><a href="pendingfees.php">Pending fees Students</a></li>
        </ul>
    </div>
     <!-- Include your sidebar -->
    <div class="content">
    <div class="top-bar">
        <h1><a href="dashboard.php" style="color: white; text-decoration: none;">SDHOSTEL</a></h1>

            <div class="user">
               
                <img src="../photos/Gpay.png" alt="Profile Picture" class="profile-pic" onclick="toggleDropdown()">
                <div id="dropdown-menu" class="dropdown">
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </div>
        <div class="main-content">
            <h2>Maintenance Issues</h2>
            <table id="example">
                <thead>
                    <tr>
                    
                        <th>OTR Number</th>
                        <th>Issue</th>
                        <th>Submitted At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                
                                <td><?php echo htmlspecialchars($row['otr_number']); ?></td>
                                <td><?php echo htmlspecialchars($row['issue']); ?></td>
                                <td><?php echo htmlspecialchars($row['submitted_at']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">No maintenance issues submitted.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
