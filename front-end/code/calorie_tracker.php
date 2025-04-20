<?php
header("Content-Type: application/json"); // Force JSON output
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Use your existing database connection file
$mysqli = require __DIR__ . "/database.php";

// Retrieve and sanitize form data via POST
$height = $_POST['height'] ?? null;
$weight = $_POST['weight'] ?? null;
$age = $_POST['age'] ?? null;
$gender = $_POST['gender'] ?? null;
$goal = $_POST['goal'] ?? null;
$target_weight = isset($_POST['target_weight']) && $_POST['target_weight'] !== '' ? floatval($_POST['target_weight']) : null;


// Check required fields
if (!$height || !$weight || !$age || !$gender || !$goal) {
    http_response_code(400);
    echo json_encode(["error" => "Missing required fields."]);
    exit;
}

// Calculate BMR using the Harris-Benedict formula
if ($gender === "male") {
    $bmr = 66.5 + (13.75 * $weight) + (5.003 * $height) - (6.75 * $age);
} else {
    $bmr = 655 + (9.563 * $weight) + (1.850 * $height) - (4.676 * $age);
}

// Adjust calories based on the goal
switch ($goal) {
    case "maintain":
        $calorieIntake = $bmr * 1.55;
        break;
    case "lose":
        $calorieIntake = $bmr * 1.2;
        break;
    case "gain":
        $calorieIntake = $bmr * 1.75;
        break;
    default:
        $calorieIntake = $bmr;
        break;
}

$query = "
    INSERT INTO calorie_results (height, weight, age, gender, goal, target_weight, calories)
    VALUES (?, ?, ?, ?, ?, ?, ?)
";

$stmt = $mysqli->prepare($query);

$target_weight_param = $target_weight ?? null;

$stmt = $mysqli->prepare($query);

if (!$stmt) {
    http_response_code(500);
    echo json_encode(["error" => "Failed to prepare SQL statement."]);
    exit;
}

$stmt->bind_param("ddisssd", $height, $weight, $age, $gender, $goal, $target_weight_param, $calorieIntake);



if ($stmt->execute()) {
    echo json_encode(["calories" => round($calorieIntake)]);
} else {
    http_response_code(500);
    echo json_encode(["error" => "Database insert failed."]);
}

$stmt->close();
$mysqli->close();
