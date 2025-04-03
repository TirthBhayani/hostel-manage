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

$otr_number = $_SESSION['otr_number'];

// Fetch fee details for the user
$checkFees = "SELECT amount, status FROM fees WHERE otr_number = ?";
$stmt = $conn->prepare($checkFees);
$stmt->bind_param("s", $otr_number);
$stmt->execute();
$feesResult = $stmt->get_result();
$feesData = $feesResult->fetch_assoc();
$stmt->close();

$hasPendingFees = ($feesData && $feesData['status'] == 'pending');
$amountToPay = $feesData ? $feesData['amount'] : "N/A";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Fees</title>
   
    <link rel="stylesheet" href="../CSS/dashboard.css">
    <link rel="stylesheet" href="../CSS/hostel-fees.css">
    <script src="../javascript/script.js"></script>
</head>

<body>
    <?php include 'sidebar.php'; ?>
    <div class="content">
        <?php include 'topbar.php'; ?>

        <div class="main-content">
            <h2>Hostel Fees</h2>

            <p><strong>Total Fees: ₹<?php echo htmlspecialchars($amountToPay); ?></strong></p>

            <?php if ($hasPendingFees): ?>
                <p style="color: red;">⚠ Pending Fees: ₹<?php echo htmlspecialchars($amountToPay); ?></p>
                <button id="openModal">Pay Fees</button>
            <?php else: ?>
                <p style="color: green;">✅ No pending fees</p>
            <?php endif; ?>

            <h3>Your Approved Receipts</h3>
            <table>
                <thead>
                    <tr>
                        <th>OTR Number</th>
                        <th>Status</th>
                        <th>Receipt</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch approved receipts
                    $sql = "SELECT * FROM receipts WHERE  otr_number = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("s", $otr_number);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0):
                        while ($row = $result->fetch_assoc()):
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['otr_number']); ?></td>
                                <td><?php echo htmlspecialchars($row['status'])?></td>
                                <td>
    <?php if (htmlspecialchars($row['status']) == 'pending'): ?>
        No receipt Available
    <?php else: ?>
        <a href="<?php echo "../../../hm/uploads/receipts/" . htmlspecialchars($row['receipt_path']); ?>" 
           target="_blank" class="btn btn-primary">
            <i class="bi bi-download"></i> Download Receipt
        </a>
    <?php endif; ?>
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

        <?php if ($hasPendingFees): ?>
            <div id="modal" class="modal">
                <div class="modal-content">
                    <span class="close-btn" id="closeModal">&times;</span>
                    <h3>Bank Details</h3>
                    <img src="../../../photos/Gpay.png" alt="Hostel Fees" style="width: 100%; height: auto;">
                    <form id="receiptUploadForm" action="../../../backend/user/upload_receipt.php" method="POST"
                          enctype="multipart/form-data">
                        <input type="hidden" name="otr_number" value="<?php echo htmlspecialchars($otr_number); ?>">
                        <input type="hidden" name="amount" value="<?php echo htmlspecialchars($amountToPay); ?>">

                        <label for="upi_id">UPI ID:</label>
                        <input type="text" id="upi_id" name="upi_id" required>

                        <label for="transaction_id">Transaction ID:</label>
                        <input type="text" id="transaction_id" name="transaction_id" required>

                        <label for="amount">Amount:</label>
                        <input type="number" id="amount" name="amount" value="<?php echo htmlspecialchars($amountToPay); ?>" readonly>

                        <label for="receiptFile">Upload Receipt:</label>
                        <input type="file" id="receiptFile" name="receiptFile" accept=".jpg,.jpeg,.png,.pdf" required>

                        <button type="submit" id="uploadBtn">Upload Payment Details</button>
                    </form>
                </div>
            </div>
        <?php endif; ?>

    </div>

    <script>
      document.addEventListener("DOMContentLoaded", function () {
    var modal = document.getElementById('modal');
    var openModalBtn = document.getElementById('openModal');
    var closeModalBtn = document.getElementById('closeModal');

    if (openModalBtn) {
        openModalBtn.addEventListener('click', function () {
            modal.style.display = 'flex';
            localStorage.setItem("modalOpen", "true"); // Save modal state
        });
    }

    if (closeModalBtn) {
        closeModalBtn.addEventListener('click', function () {
            modal.style.display = 'none';
            localStorage.removeItem("modalOpen"); // Remove modal state
        });
    }

    window.onclick = function (event) {
        if (event.target === modal) {
            modal.style.display = 'none';
            localStorage.removeItem("modalOpen"); // Remove modal state
        }
    };

    // Ensure modal doesn't auto-open on page refresh
    if (localStorage.getItem("modalOpen") !== "true") {
        modal.style.display = 'none';
    }
});

    </script>
</body>

</html>

<?php
$conn->close();
?>
