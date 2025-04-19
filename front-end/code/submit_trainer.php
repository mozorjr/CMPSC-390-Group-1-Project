<?php
$host = "localhost";
$dbname = "healthHorizon";
$username = "root";
$password = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $bio = $_POST['bio'] ?? '';
    $specialty = $_POST['specialty'] ?? '';
    $certifications = $_POST['certifications'] ?? '';
    $experience = $_POST['experience'] ?? 0;
    $uploadDir = '/var/www/html/health-horizon-php/static/uploads/';
    
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $imageName = '';

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $imageTmpPath = $_FILES['image']['tmp_name'];
        $originalName = basename($_FILES['image']['name']);
        $imageName = uniqid() . '_' . preg_replace("/[^a-zA-Z0-9.]/", "_", $originalName);
        $destination = $uploadDir . $imageName;

        if (!move_uploaded_file($imageTmpPath, $destination)) {
            die("Image upload failed.");
        }
    }


    $stmt = $conn->prepare("INSERT INTO trainers (name, bio, specialty, certifications, experience, profile_pic) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssis", $name, $bio, $specialty, $certifications, $experience, $imageName);


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
