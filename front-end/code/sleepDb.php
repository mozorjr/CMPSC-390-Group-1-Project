
<?php
//set to JSON
header('Content-Type: application/json');

//conncet to DB
$conn = new mysqli('localhost', 'root', '', 'sleep_tracker');

//check connection
//error message if failed
if ($conn->connect_error) {
    echo json_encode(['error' => 'Connection Failed: ' . $conn->connect_error]);
    exit;
}

//get values for date and hours from the form, if blank leave null
$date = $_POST['date'] ?? null;
$hours = $_POST['hours'] ?? null;

//check if the values are accepted
//start SQL qeury to insert into table
//"sd" stands for string and double for the values to be inputted
if ($date && $hours) {
    $stmt = $conn->prepare("INSERT INTO sleep_logs (date, hours) VALUES (?, ?)");
    $stmt->bind_param("sd", $date, $hours); 

    //complete the statement
    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["error" => "Failed to insert"]);
    }
    $stmt->close();
} else {
    echo json_encode(["error" => "Invalid input"]);
}

//end connection
$conn->close();
?>