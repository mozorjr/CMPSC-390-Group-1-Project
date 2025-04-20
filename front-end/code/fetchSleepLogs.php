<?php
//set to JSON
header('Content-Type: application/json');

//conncet to DB
$conn = new mysqli('localhost', 'root', '', 'sleep_tracker');

//check for connection
if ($conn->connect_error) {
    echo json_encode([]);
    exit;
}

//Query the logs
$result = $conn->query("SELECT date, hours FROM sleep_logs ORDER BY date DESC");
$sleepLogs = [];

//get all data from the rows and return them
while ($row = $result->fetch_assoc()) {
    $sleepLogs[] = $row;
}
echo json_encode($sleepLogs);

//end connection
$conn->close();
?>
