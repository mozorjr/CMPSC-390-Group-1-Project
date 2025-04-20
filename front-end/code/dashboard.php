<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION['user_id'])) {
    echo "Session not set. Please log in.";
    exit;
}

require_once "database.php";

$userID = $_SESSION['user_id'];
$query = "SELECT u.UserName, u.Email, d.GenderValue, d.HeightValue, d.WeightValue, d.AgeValue, d.TargetWeight, d.Goal
          FROM Users u
          LEFT JOIN UserData d ON u.UserID = d.UserID
          WHERE u.UserID = ?";

$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f4f4f9;
            margin: 0;
            padding: 2rem;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        h1 {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }
        .stats, .update-form {
            background: #fff;
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 2rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        .stats p {
            margin: 0.5rem 0;
            font-size: 1.1rem;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 0.6rem;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        button {
            padding: 0.6rem 1.2rem;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        button:hover {
            background-color: #45a049;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            padding: 1rem;
            border-radius: 6px;
            margin-top: 1rem;
            display: none;
            animation: fadeIn 0.8s ease forwards;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .navbar {
            background-color: #ffffff;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
            padding: 1rem 2rem;
            margin-bottom: 2rem;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1000px;
            margin: 0 auto;
        }
        .nav-logo {
            font-size: 1.4rem;
            font-weight: bold;
            color: #333;
        }
        .nav-links {
            list-style: none;
            display: flex;
            gap: 1.5rem;
            margin: 0;
            padding: 0;
        }
        .nav-links a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        .nav-links a:hover {
            color: #4CAF50;
        }
    </style>
</head>
<body>
<nav class="navbar">
    <div class="nav-container">
        <div class="nav-logo">🏋️‍♂️ HealthHorizon</div>
        <ul class="nav-links">
            <li><a href="about.html">About</a></li>
            <li><a href="member.html">Memberships</a></li>
            <li><a href="RT.html">Request a Trainer</a></li>
            <li><a href="whyUs.html">Why Us</a></li>
            <li><a href="contact.html">Contact Us</a></li>
        </ul>
    </div>
</nav>

<div class="container">
    <h1>Welcome back, <?php echo htmlspecialchars($user['UserName']); ?> 👋</h1>

    <div class="stats">
        <h2>Your Current Stats</h2>
        <p><strong>Gender:</strong> <?php echo $user['GenderValue']; ?></p>
        <p><strong>Height:</strong> <?php echo $user['HeightValue']; ?> inches</p>
        <p><strong>Weight:</strong> <?php echo $user['WeightValue']; ?> lbs</p>
        <p><strong>Age:</strong> <?php echo $user['AgeValue']; ?> years old</p>
        <p><strong>Target Weight:</strong> <?php echo $user['TargetWeight'] ?? 'Not set'; ?> lbs</p>

        <!-- Display Goal -->
        <?php
        $goal = isset($user['Goal']) ? $user['Goal'] : 'lose'; // Default to lose if not set
        $goalText = $goal === 'lose' ? "Losing Weight" : "Gaining Weight";
        ?>
        <p><strong>Goal:</strong> <?php echo $goalText; ?></p>

        <?php
        if (!empty($user['TargetWeight']) && !empty($user['WeightValue']) && $user['TargetWeight'] != 0):
            $current = $user['WeightValue'];
$target = $user['TargetWeight'];

$progress = round((1 - abs($current - $target) / max($current, $target)) * 100);
$progress = min(max($progress, 0), 100);

        ?>
        <div style="margin-top: 1rem;">
            <strong>Progress to Weight Goal:</strong>
            <div style="background: #e0e0e0; height: 20px; border-radius: 10px;">
                <div style="width: <?php echo $progress; ?>%; background: #4CAF50; height: 100%; border-radius: 10px;"></div>
            </div>
            <p><?php echo $progress; ?>% complete</p>
        </div>
        <?php endif; ?>
    </div>

    <div class="update-form">
        <h2>Update Your Info</h2>
        <form method="post" action="save_data.php">
            <div class="form-group">
                <label for="gender">Gender</label>
                <input type="text" name="gender" id="gender" value="<?php echo htmlspecialchars($user['GenderValue'] ?? ''); ?>" placeholder="e.g. Male, Female, Other">
            </div>
            <div class="form-group">
                <label for="height">Height (inches)</label>
                <input type="number" name="height" id="height" step="0.1" value="<?php echo htmlspecialchars($user['HeightValue'] ?? ''); ?>">
            </div>
            <div class="form-group">
                <label for="weight">Current Weight (lbs)</label>
                <input type="number" name="weight" id="weight" step="0.1" value="<?php echo htmlspecialchars($user['WeightValue'] ?? ''); ?>">
            </div>
            <div class="form-group">
                <label for="target_weight">Target Weight (lbs)</label>
                <input type="number" name="target_weight" id="target_weight" step="0.1" value="<?php echo htmlspecialchars($user['TargetWeight'] ?? ''); ?>">
            </div>
            <div class="form-group">
                <label for="age">Age</label>
                <input type="number" name="age" id="age" value="<?php echo htmlspecialchars($user['AgeValue'] ?? ''); ?>">
            </div>
            <div class="form-group">
                <label for="goal">Goal</label>
                <select name="goal" id="goal">
                    <option value="lose" <?php echo ($goal === 'lose' ? 'selected' : ''); ?>>Lose Weight</option>
                    <option value="gain" <?php echo ($goal === 'gain' ? 'selected' : ''); ?>>Gain Weight</option>
                </select>
            </div>
            <button type="submit">Update Info</button>
        </form>
        <div class="success" id="successMessage">✅ Info updated successfully!</div>
    </div>
</div>

<script>
    const form = document.getElementById("updateForm");
    const successBox = document.getElementById("successMessage");

    form.addEventListener("submit", async (e) => {
        e.preventDefault();

        const formData = new FormData(form);

        const response = await fetch("save_data.php", {
            method: "POST",
            body: formData
        });

        const result = await response.text();
        if (result.trim() === "success") {
            successBox.style.display = "block";
            setTimeout(() => {
                successBox.style.display = "none";  // Fade out after 2 seconds
                location.reload();  // Reload the page
            }, 2000);
        }
    });
</script>

</body>
</html>
