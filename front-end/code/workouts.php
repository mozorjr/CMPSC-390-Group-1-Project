<?php
// Use database connection
$conn = require_once 'database.php';

// Fetch all workouts from the database
$sql = "SELECT exercise, duration, calories_burned, workout_date FROM workouts";
$result = $conn->query($sql);

// Initialize an array to store workout data
$workouts = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $workouts[] = $row;
    }
}

// Return the data as JSON
echo json_encode($workouts);

// Close the connection
$conn->close();
?>
