<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
$isLoggedIn = isset($_SESSION['user_id']);

$mysqli = require __DIR__ . "/database.php";
$conn = $mysqli;
require "database.php";

$sql = "SELECT * FROM trainers";
$result = $conn->query($sql);
$trainers = [];

while ($row = $result->fetch_assoc()) {
    $trainers[] = $row;
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="frame.css">
    <title>Request a Trainer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        #info {
            width: 60%;            
            margin: 20px auto;     
            padding: 20px;       
            background-color: #f0f0f0;  
            border: 1px solid #ccc; 
            border-radius: 8px; 
        }
    </style>
    
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

<script>
    const trainerData = <?php echo json_encode($trainers); ?>;

    function displayInfo() {
        const select = document.getElementById('choices');
        const selectedId = select.value;
        const infoDiv = document.getElementById('info');

        if (selectedId === "") {
            infoDiv.innerHTML = "<p>Please select a trainer to see more information.</p>";
            return;
        }

        const trainer = trainerData.find(t => t.id == selectedId);

        if (trainer) {
            infoDiv.innerHTML = `
                <h4>${trainer.name}</h4>
                <p><strong>Specialty:</strong> ${trainer.specialty}</p>
                <p><strong>Certifications:</strong> ${trainer.certifications}</p>
                <p><strong>Experience:</strong> ${trainer.experience} years</p>
                <p><strong>Bio:</strong><br>${trainer.bio}</p>
            `;
        }
    }
</script>
</head>

    <main>
        <section class="text-center mt-5">
          <h2 class="fw-bold mb-5">Request A Trainer</h2>
          <div class="image-container">
            <img src="rtimg.jpg" alt="RT Image" class ="img-fluid">
      </section>
      <section class="bg-light py-5 mt-5">
        <div class="container d-flex flex-column flex-md-row align-items-center">
            <h4> We at Health Horizons make it a priority to insure that the consumer is able to make every chocie possible.</h4>
            <br><br>
            <h4>On this page you will be able to select any available trainer and see their experiences and sme information about them before you make your choice.</h4>
        </div>
    </section>
            </div>
            <section class="bg-light py-5 mt-5">
              <div class="container d-flex flex-column flex-md-row align-items-center">
                <form action="submit.php" method="POST">
                    <label for="choices">Request a Trainer Here:</label>
                    <select id="choices" name="choices" onchange="displayInfo()">
                    <option value="" disabled selected>Pick a Trainer</option>
                    <?php foreach ($trainers as $trainer): ?>
                        <option value="<?php echo $trainer['id']; ?>">
                            <?php echo htmlspecialchars($trainer['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                    
                    <br><br>
            
                    <input type="submit" value="Submit">
                </form>
              </div>
              <div id="info">
                <p>Please select an option to see more information.</p>
            </div>
          </section>
          
          <footer class="foot bg-light py-4 mt-5">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <a class="btn btn-dark" href="index.html">Home</a>
                <nav class="d-flex gap-3">
                    <a href="whyUs.php" class="btn">Why Us</a>
                    <a href="contact.php" class="btn">Contact Us</a>
                </nav>
                <div class="d-flex gap-3">
                    <a href="https://www.facebook.com/?stype=lo&flo=1&deoia=1&jlou=AfdjgGZOS83Ieqm0hmBi6nRSnGTFnPIg0QwQUkfn8PAQkKCD96hoN3jYiNbd3hWJl-w_fxz34f3OjXcnvltHSD4jO78MOHRtFU_ZZ9YpS4dHfA&smuh=24868&lh=Ac8iXpovKhmWYm_-UDk" target="_blank">
                        <img src="Facebook_logo_(square).png" class="img-fluid" style="max-width: 30px;" alt="Facebook">
                </a>
                <a href="https://www.linkedin.com/in/health-horizon-825a80351" target="_blank">
                <img src="linkedin.png" class="img-fluid" style="max-width: 30px;" alt="LinkedIn">
                        </a>
                        <a href="https://www.instagram.com/hea.lthhorizon/" target="_blank">
                    <img src="Insta-Logo.png" class="img-fluid" style="max-width: 30px;" alt="Instagram">
                        </a>
                </div>
            </div>
        </footer>
  </main>
</body>
</html>

        <script>
          window.onload = function() {
          let loggedIn = localStorage.getItem("loggedIn") === "true";
          let signupBtn = document.getElementById("signup-btn");
          let profileBtn = document.getElementById("profile-btn");
      
          if (loggedIn) {
              signupBtn.classList.add("d-none"); // Hide Signup button
              profileBtn.classList.remove("d-none"); // Show Profile icon
          }
      };
      </script>
    </main>
</body>

