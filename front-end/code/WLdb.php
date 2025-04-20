
<?php
header('Content-Type: application/json');

$conn = new mysqli('localhost', 'root', '', 'workout_log');

if ($conn->connect_error) {
    echo json_encode(['error' => 'Connection Failed: ' . $conn->connect_error]);
    exit;
}
$exercise = $_POST['exercise'] ?? null;
$duration = $_POST['duration'] ?? null;
$calBurned = $_POST['calBurned'] ?? null;

if ($exercise && $duration && $calBurned) {
    $stmt = $conn->prepare("INSERT INTO workoutlog (exercise, duration, calBurned) VALUES (?, ?, ?)");
    $stmt->bind_param("sid", $exercise, $duration, $calBurned); 

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