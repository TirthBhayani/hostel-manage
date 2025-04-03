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
<?php include 'admin_sidebar.php'; ?>

    <div class="content">
    <?php include 'admin_topbar.php'; ?>
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
