<?php
require 'db.php'; 


if (isset($_GET['id'])) {
    $trainerId = $_GET['id'];

   
    $stmt = $conn->prepare("DELETE FROM trainers WHERE id = ?");
    $stmt->bind_param("i", $trainerId); 


    if ($stmt->execute()) {
        echo "Trainer deleted successfully.";

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

