<?php
$conn = require __DIR__ . "/database.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $bio = $_POST['bio'] ?? '';
    $specialty = $_POST['specialty'] ?? '';
    $certifications = $_POST['certifications'] ?? '';
    $experience = $_POST['experience'] ?? 0;
    $uploadDir = '/opt/lampp/htdocs/CMPSC-390-Group-1-Project/front-end/code/trainer_pics/';
    
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $imageName = '';

    if (isset($_FILES['image'])) {
        if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $imageTmpPath = $_FILES['image']['tmp_name'];
            $originalName = basename($_FILES['image']['name']);
            $imageName = uniqid() . '_' . preg_replace("/[^a-zA-Z0-9.]/", "_", $originalName);
    
            // Make sure there's a trailing slash in the directory
            $destination = rtrim($uploadDir, '/') . '/' . $imageName;
    
            if (!move_uploaded_file($imageTmpPath, $destination)) {
                echo "Failed to move uploaded file.<br>";
                echo "Destination: $destination<br>";
                echo "Temp path: $imageTmpPath<br>";
                echo "Is upload dir writable? " . (is_writable($uploadDir) ? "Yes" : "No") . "<br>";
                die("Image upload failed at move_uploaded_file.");
            }
        } else {
            $uploadErrors = [
                UPLOAD_ERR_INI_SIZE   => 'The uploaded file exceeds the upload_max_filesize directive in php.ini.',
                UPLOAD_ERR_FORM_SIZE  => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.',
                UPLOAD_ERR_PARTIAL    => 'The uploaded file was only partially uploaded.',
                UPLOAD_ERR_NO_FILE    => 'No file was uploaded.',
                UPLOAD_ERR_NO_TMP_DIR => 'Missing a temporary folder.',
                UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk.',
                UPLOAD_ERR_EXTENSION  => 'A PHP extension stopped the file upload.',
            ];
    
            $errorCode = $_FILES['image']['error'];
            $errorMessage = $uploadErrors[$errorCode] ?? 'Unknown upload error.';
            die("Image upload error: $errorMessage (code $errorCode)");
        }
    } else {
        die("No file upload detected.");
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
