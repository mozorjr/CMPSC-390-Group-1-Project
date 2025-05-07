<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="">
    <title>Memeberships</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
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

    <main>
        <section class="text-center mt-5">
          <h2 class="fw-bold mb-5">Memberships</h2>
          <div class="image-container">
            <img src="stock2.jpg" alt="member image">
      </section>
            
      <section class="container my-5">
        <h2 class="text-center fw-bold">Memberships</h2>
        <div class="row text-center">
            <div class="col-md-4">
                <div class="p-3 bg-light rounded shadow">
                    <a class="btn btn-dark btn-lg mb-3" href="purchase.html">Basic</a>
                    <p>$9.99/Month</p>
                    
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 bg-light rounded shadow">
                    <a class="btn btn-dark btn-lg mb-3" href="purchase.html">Simple</a>
                    <p>$19.99/Month</p>
                    
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 bg-light rounded shadow">
                    <a class="btn btn-dark btn-lg mb-3" href="purchase.html">Premium</a>
                    <p>$29.99/Month</p>
                    
                </div>
            </div>
        </div>
    </section>
    <section class="container my-5">
        <h2 class="text-center fw-bold">Membership Comparison</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Feature</th>
                    <th>Basic</th>
                    <th>Simple</th>
                    <th>Premium</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Monthly Cost</td>
                    <td>$9.99</td>
                    <td>$19.99</td>
                    <td>$29.99</td>
                </tr>
                <tr>
                    <td>Commitment</td>
                    <td>12 Months</td>
                    <td>6 Months</td>
                    <td>Monthly</td>
                </tr>
                <tr>
                    <td>Enrollment Fee</td>
                    <td>$50</td>
                    <td>$30</td>
                    <td>None</td>
                </tr>
                <tr>
                    <td>Access to Features</td>
                    <td>Basic</td>
                    <td>Limited</td>
                    <td>All Features</td>
                </tr>
                <tr>
                    <td>Progress Tracking</td>
                    <td>No</td>
                    <td>Yes</td>
                    <td>Yes</td>
                </tr>
            </tbody>
        </table>
    </section>

    <section class="container my-5">
        <h3 class="text-center mb-4">Exclusive Membership Perks</h3>
        <ul class="list-group">
          <li class="list-group-item">10% Off Your First Month</li>
          <li class="list-group-item">Referral Program: Get $10 for each friend you refer!</li>
          <li class="list-group-item">Exclusive Events & Workshops</li>
          <li class="list-group-item">Access to Premium Content</li>
        </ul>
      </section>

    <section class="bg-light py-5">
        <div class="container">
            <h3 class="fw-bold text-center mb-4">Have any questions or critiques</h3>
            <form action="submit.html" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Your Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Your Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Your Message</label>
                    <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-dark">Send Message</button>
            </form>
        </div>
    </section>

    <section class="container py-5 text-center">
        <h3 class="fw-bold mb-4">30-Day Money-Back Guarantee</h3>
        <p>If you're not satisfied with your membership within the first 30 days, we will refund your money. No questions asked.</p>
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
  </main>

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