<?php
$conn = require __DIR__ . "/database.php";

$sql = "SELECT * FROM trainers";
$result = $conn->query($sql);
$trainers = [];

while ($row = $result->fetch_assoc()) {
    $trainers[] = $row;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Trainer List</title>
    <link rel="stylesheet" href="static/styles.css">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f7f9fc;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .top-bar {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 30px;
        }

        .btn-add, .btn-home {
            padding: 10px 20px;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .btn-add {
            background-color: #27ae60;
        }

        .btn-add:hover {
            background-color: #219150;
        }

        .btn-home {
            background-color: #2980b9;
        }

        .btn-home:hover {
            background-color: #216a9a;
        }

        .trainer-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .trainer-card {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            padding: 20px;
            width: 280px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .trainer-card:hover {
            transform: translateY(-5px);
        }

        .trainer-card img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 15px;
        }

        .trainer-card h3 {
            margin: 10px 0 5px;
            font-size: 20px;
            color: #34495e;
        }

        .trainer-card p {
            margin: 4px 0;
            font-size: 14px;
            color: #555;
        }

        .button-group {
            margin-top: 15px;
            display: flex;
            justify-content: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 8px 14px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            color: white;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .btn-view { background-color: #3498db; }
        .btn-edit { background-color: #f39c12; }
        .btn-delete { background-color: #e74c3c; }

        .btn:hover {
            filter: brightness(0.9);
        }

        form {
            display: inline;
        }
    </style>
</head>
<body>
    <h1>Trainer List</h1>

    <div class="top-bar">
        <a href="about.php" class="btn-home">← Back to Home</a>
        <a href="trainer_input.php" class="btn-add">+ Add New Trainer</a>
    </div>

    <div class="trainer-container">
        <?php foreach ($trainers as $trainer): ?>
            <div class="trainer-card">
                <?php if (!empty($trainer['profile_pic'])): ?>
                    <img src="trainer_pics/<?php echo htmlspecialchars($trainer['profile_pic']); ?>" alt="Profile Picture">
                <?php else: ?>
                    <img src="static/default_profile.png" alt="No Picture">
                <?php endif; ?>

                <h3><?php echo htmlspecialchars($trainer['name']); ?></h3>
                <p><strong>Specialty:</strong> <?php echo htmlspecialchars($trainer['specialty']); ?></p>

                <div class="button-group">
                    <a href="trainer_profile.php?trainer_id=<?php echo $trainer['id']; ?>" class="btn btn-view">View</a>
                    <a href="edit_trainer.php?id=<?php echo $trainer['id']; ?>" class="btn btn-edit">Edit</a>
                    <form action="delete_trainer.php?id=<?php echo $trainer['id']; ?>" method="post" onsubmit="return confirm('Are you sure you want to delete this trainer?');">
                        <button type="submit" class="btn btn-delete">Delete</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
