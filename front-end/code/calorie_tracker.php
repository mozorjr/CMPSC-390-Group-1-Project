<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calorie Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
        }

        .content {
            flex: 1;
            margin-top: 80px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 20px;
        }

        .calorie-tracker-box {
            width: 100%;
            max-width: 500px;
            padding: 40px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            background-color: white;
            border-radius: 8px;
        }

        footer {
            background-color: #f8f9fa;
            padding: 20px;
            margin-top: auto;
            width: 100%;
        }

        .footer-links a {
            margin-right: 10px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="btn btn-dark" href="index.html">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
            <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                <li class="nav-item"><a class="nav-link" href="member.php">Memberships</a></li>
                <li class="nav-item"><a class="nav-link" href="calorie_tracker.php">Calorie Tracker</a></li>
                <li class="nav-item"><a class="nav-link" href="dashboard.php">User Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="sleepLog.php">Sleep Log</a></li>
                <li class="nav-item"><a class="nav-link" href="workoutLog.php">Workout Log</a></li>
                <li class="nav-item"><a class="nav-link" href="RT.php">Request a Trainer</a></li>
                <li class="nav-item"><a class="nav-link" href="trainers.php">Apply For Trainer</a></li>
                <li class="nav-item"><a class="nav-link" href="gymmap.php">Gyms</a></li>
                <li class="nav-item"><a class="nav-link" href="whyUs.php">Why Us</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
            </ul>
            <?php if ($isLoggedIn): ?>
                <a class="btn btn-outline-danger ms-2" href="logout.php">Logout</a>
            <?php else: ?>
                <a class="btn btn-dark" href="signup.php">Signup/Login</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<section class="content">
    <div class="calorie-tracker-box p-4 shadow-sm rounded">
        <h1 class="text-center mb-4">Calorie Tracker</h1>
        <form id="calorieForm">
            <div class="mb-3">
                <label for="height" class="form-label">Height (cm):</label>
                <input type="number" class="form-control" id="height" name="height" required>
            </div>

            <div class="mb-3">
                <label for="weight" class="form-label">Current Weight (kg):</label>
                <input type="number" class="form-control" id="weight" name="weight" required>
            </div>

            <div class="mb-3">
                <label for="age" class="form-label">Age (years):</label>
                <input type="number" class="form-control" id="age" name="age" required>
            </div>

            <div class="mb-3">
                <label for="gender" class="form-label">Gender:</label>
                <select id="gender" name="gender" class="form-control">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="goal" class="form-label">Goal:</label>
                <select id="goal" name="goal" class="form-control">
                    <option value="maintain">Maintain Weight</option>
                    <option value="lose">Lose Weight</option>
                    <option value="gain">Gain Weight</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="target-weight" class="form-label">Target Weight (kg):</label>
                <input type="number" class="form-control" id="target-weight" name="target_weight">
                <small class="form-text text-muted">Leave empty if maintaining current weight.</small>
            </div>

            <button type="submit" class="btn btn-primary w-100">Calculate Calories</button>
        </form>

        <div id="calories-result" style="display:none; margin-top: 20px;">
            <h3>Your Recommended Daily Calorie Intake: <span id="calories"></span> kcal</h3>
        </div>
    </div>
</section>

<footer class="bg-light py-4 mt-5">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <a class="btn btn-dark" href="index.html">Home</a>
        <nav class="d-flex gap-3">
            <a href="whyUs.php" class="btn">Why Us</a>
            <a href="contact.php" class="btn">Contact Us</a>
        </nav>
    </div>
</footer>

<script>
document.getElementById("calorieForm").addEventListener("submit", function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch("calculate_calorie.php", {
        method: "POST",
        body: formData,
        credentials: "include"
    })
    .then(response => response.json())
    .then(data => {
        if (data.calories) {
            document.getElementById("calories").textContent = data.calories;
            document.getElementById("calories-result").style.display = "block";
        } else {
            alert(data.error || "Something went wrong.");
        }
    })
    .catch(error => {
        console.error("Error:", error);
        alert("Error calculating calories.");
    });
});
</script>

</body>
</html>
