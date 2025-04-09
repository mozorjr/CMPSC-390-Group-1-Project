<?php
// Database connection
$servername = "localhost"; // Change this to your database host if needed
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "workout_log"; // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get POST data from the form
$exercise = $_POST['exercise'];
$duration = $_POST['duration'];
$calories_burned = $_POST['calories_burned'];
$workout_date = $_POST['workout_date'];

$workout_date = date('MM-DD-YYYY', strtotime($workout_date));

// Validate and sanitize other inputs
$exercise = htmlspecialchars($exercise); // Prevent XSS
$duration = (int)$duration; // Cast to integer
$calories_burned = (int)$calories_burned; // Cast to integer

// Prepare and bind the SQL statement
$stmt = $conn->prepare("INSERT INTO workouts (exercise, duration, calories_burned, workout_date) VALUES (?, ?, ?, ?)");
$stmt->bind_param("siii", $exercise, $duration, $calories_burned, $workout_date);

// Execute the query
if ($stmt->execute()) {
    echo "New workout added successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close the connection
$stmt->close();
$conn->close();
?>


