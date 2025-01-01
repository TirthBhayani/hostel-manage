<?php
include 'dbconnection.php';
// Start the session
session_start();
// if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== 1 || $_SESSION['role'] !== 'admin') {
//     header('Location: login.php');
//     exit();
// }

date_default_timezone_set('Asia/Kolkata');

$query = "
    SELECT g.otr_number, g.check_out_date, g.check_out_time, g.check_in_date, g.check_in_time,g.in_time,u.firstName As name
    FROM gatepass g
    JOIN users u ON g.otr_number = u.otr_number
    WHERE g.late_entry = 1
";
$result = $conn->query($query);

// Check if the query execution was successful
if (!$result) {
    // If the query failed, show the error message
    die("Query failed: " . $conn->error);
}

// Check if there are late students
$late_students = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $late_students[] = $row;
    }
}
$conn->close();

?>
