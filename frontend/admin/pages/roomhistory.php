<?php
include '../../../backend/adminroomhistrory.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        <h3>Room Allocation List</h3>
<table id="roomAllocationTable" class="display">
    <thead>
        <tr>
            <th>Room Number</th>
            <th>Room ID</th>
            <th>Student Name</th>
            <th>OTR Number</th>
            <th>Allocated At</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "
            SELECT ra.room_id,ra.room_number, u.firstName AS student_name, u.otr_number, ra.status
            FROM rooms ra
            JOIN users u ON ra.room_id = u.room_id
        ";
        $result = $conn->query($query);
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['room_number']}</td>
                    <td>{$row['room_id']}</td>
                    <td>{$row['student_name']}</td>
                    <td>{$row['otr_number']}</td>
                    <td>{$row['status']}</td>
                  </tr>";
        }
        ?>
    </tbody>
</table>

    </div>
    
    <script>
        $(document).ready(function () {
            $('#userTable').DataTable();

            $('#allocate-btn').on('click', function () {
                const user_id = $('#user').val();
                const room_id = $('#room').val();

                if (!user_id || !room_id) {
                    $('#message').text('Please select both user and room').css('color', 'red');
                    return;
                }

                $.ajax({
                    url: 'room.php',
                    type: 'POST',
                    data: { allocate: true, user_id: user_id, room_id: room_id },
                    success: function (response) {
                        const res = JSON.parse(response);
                        if (res.status === 'success') {
                            $('#message').text(res.message).css('color', 'green');
                            setTimeout(() => location.reload(), 1000);
                        } else {
                            $('#message').text(res.message).css('color', 'red');
                        }
                    },
                    error: function () {
                        $('#message').text('An error occurred').css('color', 'red');
                    }
                });
            });
        });
    </script>
</body>
</html>
        </div>
</body>
</html>