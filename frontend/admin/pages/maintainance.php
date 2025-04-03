<?php
include '../../../backend/adminmaintainance.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Maintenance Issues</title>
   
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <link rel="stylesheet" type="text/css" href="../CSS/dashboard.css?v=<?php echo time(); ?>">

    <script>
        $(document).ready(function(){
            $('#example').DataTable();
        });
    </script>
    <script src ="../javascript/script.js"></script>
</head>
<body>
<?php include 'admin_sidebar.php'; ?>
    <div class="content">
    <?php include 'admin_topbar.php'; ?>
        <h2>Maintenance Issues</h2>
        <table id="example">
            <thead>
                <tr>
                    <th>OTR Number</th>
                    <th>Issue Type</th>
                    <th>Issue</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Submitted At</th>
                    <th>Solved At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['otr_number']); ?></td>
                            <td><?php echo htmlspecialchars($row['issue_type']); ?></td>
                            <td><?php echo htmlspecialchars($row['issue']); ?></td>
                            <td>
                                <?php if (!empty($row['image_path'])): ?>
                                    <a href="../../../<?php echo htmlspecialchars($row['image_path']); ?>" target="_blank">
                                        <img src="../../../<?php echo htmlspecialchars($row['image_path']); ?>" alt="Issue Image" width="50" height="50">
                                    </a>
                                <?php else: ?>
                                    No Image
                                <?php endif; ?>
                            </td>
                            <td><?php echo htmlspecialchars($row['status']); ?></td>
                            <td><?php echo htmlspecialchars($row['submitted_at']); ?></td>
                            <td><?php echo htmlspecialchars($row['solved_at'] ?? 'Pending'); ?></td>
                            <td>
    <form action="../../../backend/admin_update_status.php" method="post" class="action-form">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <select name="status" class="  ">
            <option value="Pending" <?php echo ($row['status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
            <option value="In Progress" <?php echo ($row['status'] == 'In Progress') ? 'selected' : ''; ?>>In Progress</option>
            <option value="Resolved">Resolved</option>
        </select>
        <button type="submit" class="btn-sm">Update</button>
    </form>
</td>

                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8">No maintenance issues submitted.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
