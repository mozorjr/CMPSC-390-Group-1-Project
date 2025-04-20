<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Set response format to JSON
header('Content-Type: application/json');

// Use DB connection
$conn = require_once 'database.php';

// Query the logs
$result = $conn->query("SELECT date, hours FROM sleep_logs ORDER BY date DESC");
$sleepLogs = [];

// Get data from rows and return
while ($row = $result->fetch_assoc()) {
    $sleepLogs[] = $row;
}

echo json_encode($sleepLogs);

// End connection
$conn->close();
?>
