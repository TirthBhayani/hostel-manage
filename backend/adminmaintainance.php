<?php
session_start(); // Start the session

// Database connection
include 'dbconnection.php';

// Fetch maintenance issues from the database
$sql = "SELECT id, otr_number, issue, submitted_at FROM maintenance_issues ORDER BY submitted_at DESC"; // You can adjust the order as needed
$result = $conn->query($sql);
?>
