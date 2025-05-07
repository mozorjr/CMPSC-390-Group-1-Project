<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
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

    <main class="container text-center my-5">
        <h2 class="display-4">Contact Us</h2>
        <img src="contactIMG.jpg" style="max-width: 30%;" alt="Contact Image">
        <p class="fs-4">Contact us with any questions you may have. Fill out the form below and we will get back to you as soon as possible!</p>
        <div class="cForm">
        <form form action="https://api.web3forms.com/submit" method="post" class="myForm mx-auto" style="max-width: 600px;">
            <input type="hidden" name="access_key" value="032ec40b-c7e8-4c3f-b100-bfc06a3f1e10">
            <input type="hidden" id="ticketNumber" name="ticketNumber">
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message:</label>
                <textarea id="message" name="message" class="form-control" required></textarea>
            </div>
            <input type="submit" value="Submit" class="btn btn-dark w-100">
        </form>
    </div>
        <div id="response" class="mt-3"></div>
    </main>
    
        <footer class="foot bg-light py-4 mt-5">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <a class="btn btn-dark" href="index.html">Home</a>
                <nav class="d-flex gap-3">
                    <a href="whyUs.php" class="btn">Why Us</a>
                    <a href="contact.php" class="btn">Contact Us</a>
                </nav>
                <div class="d-flex gap-3">
                    <a href="https://www.facebook.com/?stype=lo&flo=1&deoia=1&jlou=AfdjgGZOS83Ieqm0hmBi6nRSnGTFnPIg0QwQUkfn8PAQkKCD96hoN3jYiNbd3hWJl-w_fxz34f3OjXcnvltHSD4jO78MOHRtFU_ZZ9YpS4dHfA&smuh=24868&lh=Ac8iXpovKhmWYm_-UDk" target="_blank">
                        <img src="Facebook_logo_(square).png" style="max-width: 30px;" alt="Facebook">
                </a>
                <a href="https://www.linkedin.com/in/health-horizon-825a80351" target="_blank">
                <img src="linkedin.png" style="max-width: 30px;" alt="LinkedIn">
                        </a>
                        <a href="https://www.instagram.com/hea.lthhorizon/" target="_blank">
                    <img src="Insta-Logo.png" style="max-width: 30px;" alt="Instagram">
                        </a>
                </div>
            </div>
        </footer>

<script>
    document.querySelector("form").addEventListener("submit", function(event) {
        event.preventDefault();

        const ticketNumber = Math.floor(100000 + Math.random() * 900000);
        const message = document.getElementById("message").value;
        const updatedMessage = message + "\n\nTicket Number: " + ticketNumber;
    
        document.getElementById("ticketNumber").value = ticketNumber;
        document.getElementById("message").value = updatedMessage;

        alert("Your ticket number is: " + ticketNumber);
        this.submit();
    });

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
</body>
</html>
