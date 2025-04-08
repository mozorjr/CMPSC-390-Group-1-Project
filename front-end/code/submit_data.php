<?php
// Database connection
$servername = "localhost"; // your MySQL server
$username = "root"; // your MySQL username
$password = ""; // your MySQL password
$dbname = "calorie_tracker"; // the database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $goal = $_POST['goal'];
    $target_weight = $_POST['target_weight'] ? $_POST['target_weight'] : NULL; // If target weight is empty, set as NULL

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO user_data (height, weight, age, gender, goal, target_weight) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iiisss", $height, $weight, $age, $gender, $goal, $target_weight);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Data saved successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
