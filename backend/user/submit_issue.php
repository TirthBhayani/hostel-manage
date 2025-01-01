<?php
session_start(); // Start the session
include '../dbconnection.php';



// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['issue'])) {
    $issue = $_POST['issue'];
    $otr_number = $_SESSION['otr_number']; // Assuming OTR number is stored in session

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO maintenance_issues (otr_number, issue) VALUES (?, ?)");
    $stmt->bind_param("ss", $otr_number, $issue);

    // Execute the query
    if ($stmt->execute()) {
        // Successful submission
        echo "<script>
                alert('Maintenance issue submitted successfully.');
                window.location.href = '../../frontend/user/pages/maintenance-issue.php'; // Redirect to maintenance-issue.php
              </script>";
    } else {
        // Error occurred
        echo "<script>
                alert('Error: " . addslashes($stmt->error) . "');
              </script>";
    }

    $stmt->close();
}

$conn->close();
?>
