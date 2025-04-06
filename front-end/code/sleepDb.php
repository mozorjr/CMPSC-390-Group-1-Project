
<?php
header('Content-Type: application/json');

$conn = new mysqli('localhost', 'root', '', 'sleep_tracker');

if ($conn->connect_error) {
    echo json_encode(['error' => 'Connection Failed: ' . $conn->connect_error]);
    exit;
}
$date = $_POST['date'] ?? null;
$hours = $_POST['hours'] ?? null;

if ($date && $hours) {
    $stmt = $conn->prepare("INSERT INTO sleep_logs (date, hours) VALUES (?, ?)");
    $stmt->bind_param("sd", $date, $hours); 

    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["error" => "Failed to insert"]);
    }

    $stmt->close();
} else {
    echo json_encode(["error" => "Invalid input"]);
}

$conn->close();
?>