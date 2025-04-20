<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    die("You must be logged in.");
}

$mysqli = require __DIR__ . "/database.php";
$userID = $_SESSION['user_id'];

// Filter only non-empty inputs
$fields = [];
$params = [];
$types = "";

// Check for gender input
if (!empty($_POST['gender'])) {
    $fields[] = "GenderValue = ?";
    $params[] = $_POST['gender'];
    $types .= "s";
}

// Check for height input
if (!empty($_POST['height'])) {
    $fields[] = "HeightValue = ?";
    $params[] = (float)$_POST['height'];
    $types .= "d";
}

// Check for weight input
if (!empty($_POST['weight'])) {
    $fields[] = "WeightValue = ?";
    $params[] = (float)$_POST['weight'];
    $types .= "d";
}

// Check for age input
if (!empty($_POST['age'])) {
    $fields[] = "AgeValue = ?";
    $params[] = (int)$_POST['age'];
    $types .= "d";
}

// Check for target weight input
if (!empty($_POST['target_weight'])) {
    $fields[] = "TargetWeight = ?";
    $params[] = (float)$_POST['target_weight'];
    $types .= "d";
}

// Check for goal input
if (!empty($_POST['goal'])) {
    $fields[] = "Goal = ?";
    $params[] = $_POST['goal']; // lose or gain
    $types .= "s";
}

if (count($fields) === 0) {
    echo "No data to update.";
    exit;
}

$params[] = $userID;
$types .= "i";

// Check if user already has data
$checkSql = "SELECT 1 FROM UserData WHERE UserID = ?";
$checkStmt = $mysqli->prepare($checkSql);
$checkStmt->bind_param("i", $userID);
$checkStmt->execute();
$checkStmt->store_result();

if ($checkStmt->num_rows > 0) {
    // UPDATE
    $sql = "UPDATE UserData SET " . implode(", ", $fields) . " WHERE UserID = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param($types, ...$params);
} else {
    // INSERT – youll need ALL fields for insert
    if (count($params) < 6) {
        echo "Please fill out all fields to save your first entry.";
        exit;
    }
    $sql = "INSERT INTO UserData (GenderValue, HeightValue, WeightValue, AgeValue, TargetWeight, Goal, UserID)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param($types, ...$params);
}

if ($stmt->execute()) {
    // After a successful update or insert, redirect 
header("Location: dashboard.php");
exit;

} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$checkStmt->close();
$mysqli->close();
?>
