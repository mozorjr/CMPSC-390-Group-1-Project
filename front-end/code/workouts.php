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

// Fetch all workouts from the database
$sql = "SELECT exercise, duration, calories_burned, workout_date FROM workouts";
$result = $conn->query($sql);

// Initialize an array to store workout data
$workouts = array();

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $workouts[] = $row;
    }
} else {
    echo "0 results";
}

// Return the data as JSON
echo json_encode($workouts);

// Close the connection
$conn->close();
?>
