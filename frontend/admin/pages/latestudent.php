<?php
include '../../../backend/adminlatestudent.php'
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SDHostel</title>
    <link rel="stylesheet" href="../CSS/dashboard.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script>
        $(document).ready(function(){
            $('#example').DataTable();
        })
    </script>
   
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
                <img src="../photos/Gpay.png" alt="Profile Picture" class="profile-pic" onclick="toggleDropdown()">
                <div id="dropdown-menu" class="dropdown">
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </div>

        <div class="main-content">
            <h2>Late Student History</h2>

            <?php if (!empty($late_students)): ?>
                <table id="example" class="table">
                    <thead>
                        <tr>
                            <th>OTR Number</th>
                            <th>Name</th>
                            <th>Check-out_date</th>
                            <th>Check_out_time</th>
                            <th>Check_in_date</th> <th>check_in_time</th>
                            <th>Late Entry</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($late_students as $student): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($student['otr_number']); ?></td>
                                <td><?php echo htmlspecialchars($student['name']); ?></td>
                                <td><?php echo htmlspecialchars($student['check_out_date']); ?></td>
                                <td><?php echo htmlspecialchars($student['check_out_time']); ?></td>
                                <td><?php echo htmlspecialchars($student['check_in_date']); ?></td>
                                <td><?php echo htmlspecialchars($student['check_in_time']); ?></td>
                                <td>Yes</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No late students found.</p>
            <?php endif; ?>
        </div>
    </div>
    <script src="../javascript/script.js"></script>
</body>

</html>
