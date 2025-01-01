<?php
include '../../../backend/adminroom.php';
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
           
        <h1>Allocate Room to Students</h1>

<!-- Student Dropdown -->
<form method="POST" id="allocationForm">
    <label for="student">Select Student:</label>
    <select name="student_id" required>
        <option value="">Select Student</option>
        <?php while ($student = $students->fetch_assoc()): ?>
            <option value="<?= $student['id']; ?>"><?= $student['firstName']; ?> (<?= $student['otr_number']; ?>)</option>
        <?php endwhile; ?>
    </select>

    <label for="room">Select Room:</label>
    <select name="room_id" required>
        <option value="">Select Room</option>
        <?php while ($room = $rooms->fetch_assoc()): ?>
            <option value="<?= $room['room_id']; ?>">Room <?= $room['room_number']; ?> (<?= $room['occupants']; ?>/4)</option>
        <?php endwhile; ?>
    </select>

    <button type="submit" name="allocate">Allocate Room</button>
</form>

<hr>

<!-- Allocation List -->
<h2>Room Allocation List</h2>
<table id="roomAllocationTable">
    <thead>
        <tr>
            <th>Room Number</th>
            <th>Student Name</th>
            <th>OTR Number</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $allocationsQuery = "
            SELECT r.room_number, u.firstName, u.otr_number
            FROM users u
            JOIN rooms r ON u.room_id = r.room_id
            WHERE u.room_id IS NOT NULL
        ";
        $allocations = $conn->query($allocationsQuery);
        while ($allocation = $allocations->fetch_assoc()) {
            echo "<tr>
                    <td>{$allocation['room_number']}</td>
                    <td>{$allocation['firstName']}</td>
                    <td>{$allocation['otr_number']}</td>
                </tr>";
        }
        ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#roomAllocationTable').DataTable();
    });
</script>

</body>
</html>


<script src="../javascript/script.js"></script>

        </div>
    </div>
</body>

</html>
