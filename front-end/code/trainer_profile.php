<?php
$host = "localhost";
$dbname = "healthHorizon";
$username = "root";
$password = "";

if (isset($_GET['trainer_id'])) {
    $trainer_id = $_GET['trainer_id'];

    $query = "SELECT * FROM trainers WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $trainer_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $trainer = $result->fetch_assoc();

    if (!$trainer) {
        header("Location: trainers.php?error=trainer_not_found");
        exit;
    }
} else {
    header("Location: trainers.php?error=invalid_id");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Trainer Profile</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="static/styles.css">
  <style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background-color: #f2f4f8;
        margin: 0;
        padding: 20px;
        color: #333;
    }

    h1 {
        text-align: center;
        color: #2c3e50;
        margin-bottom: 30px;
    }

    .trainer-profile {
        background-color: white;
        max-width: 500px;
        margin: 0 auto;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        padding: 30px;
        text-align: center;
    }

    .trainer-profile img {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 50%;
        margin-bottom: 20px;
        border: 4px solid #e0e0e0;
    }

    .trainer-profile h2 {
        margin: 10px 0;
        font-size: 24px;
        color: #34495e;
    }

    .trainer-profile p {
        margin: 8px 0;
        font-size: 15px;
        color: #555;
    }

    .actions {
        text-align: center;
        margin-top: 20px;
    }

    .actions a {
        text-decoration: none;
        padding: 10px 20px;
        background-color: #3498db;
        color: white;
        border-radius: 6px;
        transition: background-color 0.3s ease;
        font-weight: bold;
    }

    .actions a:hover {
        background-color: #2980b9;
    }
  </style>
</head>
<body>

  <h1>Trainer Profile</h1>

  <div class="trainer-profile">
    <?php
    $imagePath = "static/uploads/" . $trainer['profile_pic'];
    if (!empty($trainer['profile_pic']) && file_exists($imagePath)) {
        echo '<img src="' . $imagePath . '" alt="Profile Picture">';
    } else {
        echo '<img src="static/default_profile.png" alt="No Profile Picture">';
    }
    ?>

    <h2><?php echo htmlspecialchars($trainer['name']); ?></h2>
    <p><strong>Specialty:</strong> <?php echo htmlspecialchars($trainer['specialty']); ?></p>
    <p><strong>Certifications:</strong> <?php echo htmlspecialchars($trainer['certifications']); ?></p>
    <p><strong>Experience:</strong> <?php echo htmlspecialchars($trainer['experience']); ?> years</p>
    <p><strong>Bio:</strong><br><?php echo nl2br(htmlspecialchars($trainer['bio'])); ?></p>
  </div>

  <div class="actions">
    <a href="trainers.php">← Back to Trainers</a>
  </div>

</body>
</html>

