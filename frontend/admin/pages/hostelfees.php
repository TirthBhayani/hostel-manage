<?php
// include '../../../backend/dbconnection.php';
include '../../../backend/adminhostelfees.php';
require_once('../../../fpdf186/fpdf.php');
require_once('../../../tfpdf/tfpdf.php');
require_once('../../../tFPDF/font/ttfonts.php');


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        th {
            color: #f2f2f2;
            background-color: #2c91c1;
        }
    </style>
    <!-- <link rel="stylesheet" href="../CSS/dashboard.css"> -->
    <link rel="stylesheet" href="../CSS/hostelfees.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css"
        integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <script>
        $(document).ready(function () {
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
                <img src="../photos/Gpay.png" alt="Profile Picture" onclick="toggleDropdown()">
                <div id="dropdown-menu" class="dropdown">
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </div>
        <div class="main-content">
            <h2>Manage Receipts</h2>
            <table id="example">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>OTR Number</th>
                        <th>File Path</th>
                        <th>UPI</th>
                        <th>Tracnsaction ID</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td>
                                    <?php echo htmlspecialchars($row['user_name']); ?>
                                </td>
                                <td><?php echo htmlspecialchars($row['otr_number']); ?></td>
                                <td>
                                    <a href="../../../uploads<?php echo htmlspecialchars($row['file_path']); ?>" target="_blank">View
                                        Receipt</a>
                                </td>
                                <td><?php echo htmlspecialchars($row['upi_id']); ?></td>
                                <td><?php echo htmlspecialchars($row['transaction_id']); ?></td>
                                <td><?php echo number_format($row['amount'], 2); ?></td>
                                <td><?php echo ucfirst($row['status']); ?></td>
                                <td>
                                    <?php if ($row['status'] == 'pending'): ?>
                                        <form method="POST" style="display:inline;">
                                            <input type="hidden" name="receipt_id" value="<?php echo $row['id']; ?>">
                                            <button type="submit" name="action" value="approve"
                                                style="padding: 5px 10px; background-color: green; color: white; border: none; cursor: pointer;">Approve</button>
                                            <button type="submit" name="action" value="reject"
                                                style="padding: 5px 10px; background-color: red; color: white; border: none; cursor: pointer;">Reject</button>
                                        </form>
                                    <?php else: ?>
                                        <span><?php echo ucfirst($row['status']); ?></span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7">No receipts found.</td>
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