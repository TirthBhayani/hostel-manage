<?php
session_start();
date_default_timezone_set('Asia/Kolkata');

$con = new mysqli('localhost', 'root', '', 'hostel-manage');
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$status_message = '';
$image = '';
$isLate = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $otr_number = $_POST['otr_number'];

    $query = "SELECT status, date_from, out_time, in_time, check_out_time, check_out_date, check_in_time, check_in_date, late_entry FROM gatepass WHERE otr_number = ? ORDER BY id DESC";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $otr_number);
    $stmt->execute();
    $result = $stmt->get_result();
    $request = $result->fetch_assoc();

    if ($request) {
        if ($request['status'] === 'Approved') {
            $current_date = date('Y-m-d');
            $current_time = date('H:i:s');

            if (empty($request['check_out_time'])) {
                if ($current_date >= $request['date_from'] && $current_time >= $request['out_time']) {
                    $updateQuery = "UPDATE gatepass SET check_out_time = ?, check_out_date = ? WHERE otr_number = ?";
                    $stmt = $con->prepare($updateQuery);
                    $stmt->bind_param("sss", $current_time, $current_date, $otr_number);
                    $stmt->execute();
                    $stmt->close();

                    $status_message = 'Student has been checked out successfully.';
                    $image = 'right.png';
                } else {
                    $status_message = 'Request approved, but not yet time to leave.';
                    $image = 'cross.png';
                }
            } else {
                $lateTimeLimit = date('H:i:s', strtotime($request['in_time']));
                if ($current_time > $lateTimeLimit) {
                    $isLate = true;
                }
                $updateQuery = "UPDATE gatepass SET check_in_time = ?, check_in_date = ?, late_entry = ? WHERE otr_number = ?";
                $lateEntryValue = $isLate ? 1 : 0;
                $stmt = $con->prepare($updateQuery);
                $stmt->bind_param("ssis", $current_time, $current_date, $lateEntryValue, $otr_number);
                $stmt->execute();
                $stmt->close();

                $status_message = $isLate ? 'Student is late in checking in!' : 'Student has been checked in successfully.';
                $image = $isLate ? 'cross.png' : 'right.png';
            }
        } else {
            $status_message = 'Request not approved. Student cannot go outside.';
            $image = 'cross.png';
        }
    } else {
        $status_message = 'No request found for this OTR number.';
        $image = 'cross.png';
    }
}
$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gatekeeper Check</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
    <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { text-align: center; margin-top: 50px; }
        .status-message { font-size: 20px; margin-top: 20px; }
        img { width: 100px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Gatekeeper Security Check</h1>
        <form method="POST">
            <input type="text" id="otr_number" name="otr_number" placeholder="Enter OTR Number" required>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <?php if (!empty($status_message)): ?>
            <div class="status-message"> <?php echo $status_message; ?> </div>
            <img src="<?php echo $image; ?>" alt="Status Image">
        <?php endif; ?>
    </div>
    <script>
        function onScanSuccess(decodedText) {
            document.getElementById('otr_number').value = decodedText;
            document.forms[0].submit();
        }
        document.addEventListener("DOMContentLoaded", function () {
            const html5QrCode = new Html5Qrcode("reader");
            html5QrCode.start(
                { facingMode: "environment" },
                { fps: 10, qrbox: { width: 250, height: 250 } },
                onScanSuccess
            );
        });
    </script>
</body>
</html>
