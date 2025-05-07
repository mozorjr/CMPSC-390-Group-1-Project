<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(["error" => "You must be logged in."]);
    exit;
}

header('Content-Type: application/json');


$conn = require_once 'database.php';

// Collect POST data
$exercise = $_POST['exercise'] ?? null;
$duration = $_POST['duration'] ?? null;
$calories_burned = $_POST['calories_burned'] ?? null;
$workout_date = $_POST['workout_date'] ?? null;

if ($exercise && $duration && $calories_burned && $workout_date) {
    $stmt = $conn->prepare("INSERT INTO workouts (exercise, duration, calories_burned, workout_date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siis", $exercise, $duration, $calories_burned, $workout_date); 

    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["error" => "Failed to insert: " . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(["error" => "Invalid input", "post" => $_POST]);
}

$conn->close();
?>
