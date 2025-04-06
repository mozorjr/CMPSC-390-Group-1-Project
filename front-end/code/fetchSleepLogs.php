<?php
header('Content-Type: application/json');

$conn = new mysqli('localhost', 'root', '', 'sleep_tracker');

if ($conn->connect_error) {
    echo json_encode([]);
    exit;
}

$result = $conn->query("SELECT date, hours FROM sleep_logs ORDER BY date DESC");
$sleepLogs = [];

while ($row = $result->fetch_assoc()) {
    $sleepLogs[] = $row;
}

echo json_encode($sleepLogs);

$conn->close();
?>
