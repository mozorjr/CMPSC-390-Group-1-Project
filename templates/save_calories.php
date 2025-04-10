<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "calorie_tracker";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $goal = $_POST['goal'];
    $target_weight = $_POST['target_weight'];

    // Calculate BMR using Mifflin-St Jeor Equation
    if ($gender == "male") {
        $bmr = 10 * $weight + 6.25 * $height - 5 * $age + 5;
    } else {
        $bmr = 10 * $weight + 6.25 * $height - 5 * $age - 161;
    }

    // Adjust calorie intake based on goal
    $recommended_calories = $bmr * 1.2; // Sedentary by default
    if ($goal == 'lose') {
        $recommended_calories *= 0.8;
    } elseif ($goal == 'gain') {
        $recommended_calories *= 1.2;
    }

    if (!empty($target_weight)) {
        $weight_difference = $target_weight - $weight;
        $calorie_adjustment = $weight_difference > 0 ? 500 : -500;
        $recommended_calories += $calorie_adjustment;
    }

    // Insert into the database
    $sql = "INSERT INTO calorie_data (height, weight, age, gender, goal, target_weight, recommended_calories) 
            VALUES ('$height', '$weight', '$age', '$gender', '$goal', '$target_weight', '$recommended_calories')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

