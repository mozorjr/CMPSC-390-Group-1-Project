<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

echo "Script started.<br>";

if (empty($_POST["name"])) {
    die("Name is required");
}

if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Valid email is required");
}

if (strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 characters");
}

if (!preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least one letter");
}

if (!preg_match("/[0-9]/", $_POST["password"])) {
    die("Password must contain at least one number");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Passwords must match");
}

echo "Form validation passed!<br>";

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$mysqli = require __DIR__ . "/database.php";

// Debugging: Check database connection
if (!$mysqli) {
    die("Database connection failed!<br>");
} else {
    echo "Database connection successful!<br>";
}

$sql = "INSERT INTO Users (UserName, Email, UserPasswordHash, Height, Age, Weight)
        VALUES (?, ?, ?, 0.00, 0, 0)";

$stmt = $mysqli->stmt_init();

// Debugging: Check SQL preparation
if (!$stmt->prepare($sql)) {
    die("SQL prepare error: " . $mysqli->error . "<br>");
} else {
    echo "SQL prepared successfully!<br>";
}

$stmt->bind_param("sss", $_POST["name"], $_POST["email"], $password_hash);

// Debugging: Check query execution
if ($stmt->execute()) {
    echo "User successfully inserted into the database!<br>";
    header("Location: signup-success.html");
    exit;
} else {
    die("Execution failed: " . $mysqli->error . " (" . $mysqli->errno . ")<br>");
}

