<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

// Use your database.php connection
$conn = require_once 'database.php';

// Collect and sanitize POST data
$exercise = $_POST['exercise'] ?? null;
$duration = isset($_POST['duration']) ? (int)$_POST['duration'] : null;
$calories_burned = isset($_POST['calories_burned']) ? (int)$_POST['calories_burned'] : null;
$workout_date = $_POST['workout_date'] ?? null;

// Validate and sanitize date
if ($workout_date && DateTime::createFromFormat('Y-m-d', $workout_date) === false) {
    echo json_encode(["error" => "Invalid workout date format. Use YYYY-MM-DD."]);
    exit;
}

// Make sure all required fields are provided
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
    echo json_encode([
        "error" => "Missing or invalid input",
        "debug" => $_POST
    ]);
}

$conn->close();
?>
