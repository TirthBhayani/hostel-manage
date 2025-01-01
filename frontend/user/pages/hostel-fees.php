<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hostel-manage";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['otr_number'])) {
    die("OTR number is not set. Please log in again.");
}

if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo '<script>alert("Receipt uploaded successfully!");</script>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Fees</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css"
        integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/dashboard.css">
    <link rel="stylesheet" href="../CSS/hostel-fees.css">
    <style>
        /* Styles omitted for brevity. Same as your original code. */
    </style>

</head>

<body>
    <?php include 'sidebar.php'; ?>
    <div class="content">
        <?php include 'topbar.php'; ?>

        <div class="main-content">
            <h2>Hostel Fees</h2>
            <button id="openModal">Pay Fees</button>

            <h3>Your Approved Receipts</h3>
            <!-- Fetch and display approved receipts here -->
            <table>
                <thead>
                    <tr>
                        <th>OTR Number</th>
                        <th>Receipt</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch all approved receipts for the logged-in student
                    $otr_number = $_SESSION['otr_number'];
                    $sql = "SELECT * FROM receipts WHERE status = 'approved' AND otr_number = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $otr_number);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0):
                        while ($row = $result->fetch_assoc()):
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['otr_number']); ?></td>
                                <td>
                                    <table>
                                        <tr>
                                            <td>
                                                <?php
                                                // Build the full path to the receipt file
                                               // Build the full path to the receipt file (outside the frontend folder)
$receiptPath = __DIR__ . "/../../../hm/uploads/receipts/" . htmlspecialchars($row['receipt_path']);


                                                // Debugging: Print the file path being checked
                                                

                                                if (file_exists($receiptPath)):
                                                    ?>
                                                    <a href="<?php echo "../../../hm/uploads/receipts/" . htmlspecialchars($row['receipt_path']); ?>" 
   target="_blank" class="btn btn-primary">
   <i class="bi bi-download"></i> Download Receipt</a>

                                                <?php else: ?>
                                                    <span>Receipt not available</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <?php
                        endwhile;
                    else:
                        ?>
                        <tr>
                            <td colspan="2">No approved receipts available.</td>
                        </tr>
                        <?php
                    endif;
                    $stmt->close();
                    ?>
                </tbody>
            </table>

        </div>

        <div id="modal" class="modal">
            <div class="modal-content">
                <span class="close-btn" id="closeModal">&times;</span>
                <h3>Bank Details</h3>
                <img src="../../../photos/Gpay.png" alt="Hostel Fees" style="width: 100%; height: auto;">
                <div class="upload-section" id="uploadSection">
                    <form id="receiptUploadForm" action="../../../backend/user/upload_receipt.php" method="POST"
                        enctype="multipart/form-data">
                        <input type="hidden" name="otr_number" value="<?php echo htmlspecialchars($otr_number); ?>">

                        <div class="upload-section">
                            <h3>Upload Payment Details</h3>
                            <label for="upi_id">UPI ID:</label>
                            <input type="text" id="upi_id" name="upi_id" placeholder="Enter your UPI ID" required>

                            <label for="transaction_id">Transaction ID:</label>
                            <input type="text" id="transaction_id" name="transaction_id"
                                placeholder="Enter Transaction ID" required>

                            <label for="amount">Amount:</label>
                            <input type="number" id="amount" name="amount" placeholder="Enter Amount" step="0.01"
                                required>

                            <label for="receiptFile">Upload Receipt:</label>
                            <input type="file" id="receiptFile" name="receiptFile" accept=".jpg,.jpeg,.png,.pdf"
                                required>

                            <button type="submit" id="uploadBtn">Upload Payment Details</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>

    </div>

    <script>
        var modal = document.getElementById('modal');
        var openModalBtn = document.getElementById('openModal');
        var closeModalBtn = document.getElementById('closeModal');

        openModalBtn.addEventListener('click', function () {
            modal.style.display = 'flex';
        });
        closeModalBtn.addEventListener('click', function () {
            modal.style.display = 'none';
        });

        window.onclick = function (event) {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        }
    </script>
</body>

</html>

<?php
$conn->close();
?>