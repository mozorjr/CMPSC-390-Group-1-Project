<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(["error" => "You must be logged in."]);
    exit;
}

header('Content-Type: application/json');

// include and assign the return value to $conn
$conn = require_once 'database.php';

// get values for date and hours from the form, if blank leave null
$date = $_POST['date'] ?? null;
$hours = $_POST['hours'] ?? null;

if ($date && $hours) {
    $stmt = $conn->prepare("INSERT INTO sleep_logs (date, hours) VALUES (?, ?)");
    $stmt->bind_param("sd", $date, $hours);

    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["error" => "Failed to insert: " . $stmt->error]);
    }
    $stmt->close();
} else {
    echo json_encode(["error" => "Invalid input"]);
}

$conn->close();
