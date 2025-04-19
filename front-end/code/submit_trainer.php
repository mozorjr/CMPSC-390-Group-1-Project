<?php
require 'db.php'; // Database connection

// Ensure form was submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form inputs safely
    $name = $_POST['name'] ?? '';
    $bio = $_POST['bio'] ?? '';
    $specialty = $_POST['specialty'] ?? '';
    $certifications = $_POST['certifications'] ?? '';
    $experience = $_POST['experience'] ?? 0;

    // Define the absolute upload directory path
    $uploadDir = '/var/www/html/health-horizon-php/static/uploads/';
    
    // Ensure the directory exists, create if it doesn't
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $imageName = '';

    // Handle file upload if an image is provided
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $imageTmpPath = $_FILES['image']['tmp_name'];
        $originalName = basename($_FILES['image']['name']);
        $imageName = uniqid() . '_' . preg_replace("/[^a-zA-Z0-9.]/", "_", $originalName);
        $destination = $uploadDir . $imageName;

        // Attempt to move the uploaded file to the destination
        if (!move_uploaded_file($imageTmpPath, $destination)) {
            die("Image upload failed.");
        }
    }

    // Insert the trainer data into the database
    $stmt = $conn->prepare("INSERT INTO trainers (name, bio, specialty, certifications, experience, profile_pic) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssis", $name, $bio, $specialty, $certifications, $experience, $imageName);

    // Execute the query and handle success/failure
    if ($stmt->execute()) {
        header("Location: trainers.php");
        exit();
    } else {
        echo "Invalid request.";
    }

    $stmt->close();
    $conn->close();
}
?>
