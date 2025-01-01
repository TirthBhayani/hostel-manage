<?php
include '../../../backend/adminpendingfees.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Allocation</title>
    <link rel="stylesheet" href="../CSS/dashboard.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="../javascript/script.js"></script>
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

    <div class="content">
        <div class="top-bar">
            <h1><a href="dashboard.php">SDHOSTEL</a></h1>
            <div class="user">
                
                <!-- Fixed the missing quote in the src attribute -->
                <img src="../photos/Gpay.png" alt="Profile Picture" class="profile-pic" onclick="toggleDropdown()">
                <div id="dropdown-menu" class="dropdown">
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </div>
        <div class="main-content">
           
        <h1>Pending fees Students</h1>

<!-- Student Dropdown -->

<hr>

<!-- Allocation List -->

<table id="roomAllocationTable">
<thead>
        <tr>
            <th>OTR Number</th>
            <th>Name</th>
            <th>Email</th>
           
            <th>Fees Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['otr_number']; ?></td>
                <td><?php echo $row['firstName']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['fees_status']; ?></td>
                <td>
    <form action="../../../backend/adminsend_reminder.php" method="POST">
        <input type="hidden" name="email" value="<?php echo htmlspecialchars($row['email']); ?>">
        <button type="submit" class="btn message-btn">Send Reminder</button>
    </form>
</td>

            </tr>
        <?php } ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#roomAllocationTable').DataTable();
    });
</script>

</body>
</html>



        </div>
    </div>
</body>

</html>
