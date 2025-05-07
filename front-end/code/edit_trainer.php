<?php
$conn = require __DIR__ . "/database.php";

if (!isset($_GET['id'])) {
    die("Trainer ID missing.");
}

$trainer_id = intval($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $bio = $_POST['bio'];
    $specialty = $_POST['specialty'];
    $certifications = $_POST['certifications'];
    $experience = $_POST['experience'];

    $stmt = $conn->prepare("UPDATE trainers SET name=?, bio=?, specialty=?, certifications=?, experience=? WHERE id=?");
    $stmt->bind_param("sssssi", $name, $bio, $specialty, $certifications, $experience, $trainer_id);
    $stmt->execute();
    $stmt->close();

    header("Location: trainers.php");
    exit;
} else {
    $stmt = $conn->prepare("SELECT * FROM trainers WHERE id = ?");
    $stmt->bind_param("i", $trainer_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $trainer = $result->fetch_assoc();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Trainer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Edit Trainer Profile</h2>
    <form action="edit_trainer.php?id=<?php echo $trainer_id; ?>" method="POST">
        <div class="mb-3">
            <label>Name:</label>
            <input class="form-control" type="text" name="name" value="<?php echo htmlspecialchars($trainer['name']); ?>" required>
        </div>
        <div class="mb-3">
            <label>Bio:</label>
            <textarea class="form-control" name="bio" required><?php echo htmlspecialchars($trainer['bio']); ?></textarea>
        </div>
        <div class="mb-3">
            <label>Specialty:</label>
            <input class="form-control" type="text" name="specialty" value="<?php echo htmlspecialchars($trainer['specialty']); ?>" required>
        </div>
        <div class="mb-3">
            <label>Certifications:</label>
            <input class="form-control" type="text" name="certifications" value="<?php echo htmlspecialchars($trainer['certifications']); ?>">
        </div>
        <div class="mb-3">
            <label>Experience (years):</label>
            <input class="form-control" type="number" name="experience" value="<?php echo htmlspecialchars($trainer['experience']); ?>">
        </div>
        <button class="btn btn-success" type="submit">Update Trainer</button>
        <a class="btn btn-secondary" href="trainers.php">Cancel</a>
    </form>
</body>
</html>
