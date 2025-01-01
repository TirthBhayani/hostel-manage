<?php
include 'dbconnection.php';
session_start();
// Fetch available students without a room
$query = "SELECT otr_number, firstName, email, otr_number, fees_status FROM users WHERE fees_status='unpaid'";
$result = $conn->query($query);
?>
