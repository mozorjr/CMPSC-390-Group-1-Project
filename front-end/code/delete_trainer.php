<?php
require 'db.php'; // Include your database connection

// Check if 'id' is passed in the URL
if (isset($_GET['id'])) {
    $trainerId = $_GET['id'];

    // Prepare the DELETE query
    $stmt = $conn->prepare("DELETE FROM trainers WHERE id = ?");
    $stmt->bind_param("i", $trainerId); // 'i' is for integer type

    // Execute the query
    if ($stmt->execute()) {
        echo "Trainer deleted successfully.";
        // Redirect to the trainers list page (or wherever you want to go after deletion)
        header("Location: trainers.php");
        exit();
    } else {
        echo "Error: Could not delete the trainer.";
    }

    $stmt->close();
} else {
    echo "No trainer ID provided.";
}

$conn->close();
?>

