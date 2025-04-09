<?php
// Include database connection (Make sure you have a database connection setup)
// Example: include('db_connection.php');

// Connect to your database
$servername = "localhost";  // Replace with your database server
$username = "root";         // Replace with your database username
$password = "";             // Replace with your database password
$dbname = "calorie_tracker"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data via POST
$height = $_POST['height'];
$weight = $_POST['weight'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$goal = $_POST['goal'];
$target_weight = isset($_POST['target_weight']) ? $_POST['target_weight'] : null;

// Calculate BMR using the Harris-Benedict formula
if ($gender == "male") {
    $bmr = 66.5 + (13.75 * $weight) + (5.003 * $height) - (6.75 * $age);
} else {
    $bmr = 655 + (9.563 * $weight) + (1.850 * $height) - (4.676 * $age);
}

// Adjust calories based on the goal
if ($goal == "maintain") {
    $calorieIntake = $bmr * 1.55; // Moderately active for maintenance
} elseif ($goal == "lose") {
    $calorieIntake = $bmr * 1.2;  // Sedentary for weight loss
} else {
    $calorieIntake = $bmr * 1.75; // Active for weight gain
}

// Optionally, save the result to a database (e.g., if you want to track user data)
$sql = "INSERT INTO calorie_results (height, weight, age, gender, goal, target_weight, calories) 
        VALUES ('$height', '$weight', '$age', '$gender', '$goal', '$target_weight', '$calorieIntake')";

if ($conn->query($sql) === TRUE) {
    // Successfully inserted data into the database
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Output the result back to the frontend
echo json_encode(array("calories" => round($calorieIntake)));

// Close the database connection
$conn->close();
?>



