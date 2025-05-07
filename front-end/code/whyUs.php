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
    <title>Why Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
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
      <h2 class="fw-bold mb-5">Why Us</h2>
      <div class="image-container">
        <img src="stock.jpg" alt="Why Us Image">
  </section>
        
        </div>
        <section class="bg-light py-5 mt-5">
          <div class="container d-flex flex-column flex-md-row align-items-center">
              <img src="Designer.jpeg" class="img-fluid rounded-circle me-md-5 mb-4 mb-md-0" style="max-width: 200px;" alt="Why Us Image">
              <div>
                  <p class="fs-5">We provide top-tier health tracking solutions tailored to individual needs.</p>
                  <p class="fs-5">Our programs and trainers will work well with any and all levels of participants.</p>
                  <p class="fs-5">Join us and to start the first step of your journey.</p>
              </div>
          </div>
      </section>

</section>
          <section class="bg-light py-5">
            <div class="container">
                <h3 class="fw-bold text-center mb-4">Why Choose Us</h3>
                <div class="row text-center">
                    <div class="col-md-4 mb-4">
                        <div class="p-4 bg-white rounded shadow">
                            <i class="fas fa-user-friends fa-3x mb-3"></i>
                            <h4>Personalized Plans</h4>
                            <p>We tailor every fitness program to suit your individual needs.</p>
                            <img src="personalized.jpg" class="img-fluid rounded mt-3" alt="Personalized Plans">
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="p-4 bg-white rounded shadow">
                            <i class="fas fa-cogs fa-3x mb-3"></i>
                            <h4>Professional Trainers</h4>
                            <p>Our trainers are certified, experienced, and ready to help you reach your goals.</p>
                            <img src="personaltr.jpg" class="img-fluid rounded mt-3" alt="Professional Trainers">
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="p-4 bg-white rounded shadow">
                            <i class="fas fa-chart-line fa-3x mb-3"></i>
                            <h4>Progress Tracking</h4>
                            <p>Monitor your improvements through our advanced tracking systems.</p>
                            <img src="progress.jpg" class="img-fluid rounded mt-3" alt="Progress Tracking">
                        </div>
                    </div>
                </div>
            </div>
        </section>

         
    <section class="bg-light py-5 mt-5">
      <div class="container">
          <h3 class="fw-bold text-center mb-4">What Our Clients Say</h3>
          <div class="row">
              <div class="col-md-4 mb-4">
                  <div class="card">
                      <div class="card-body">
                          <p class="fs-5">"This service transformed my life! The trainers are supportive and knowledgeable."</p>
                          <p><strong>- John Doe</strong></p>
                      </div>
                  </div>
              </div>
              <div class="col-md-4 mb-4">
                  <div class="card">
                      <div class="card-body">
                          <p class="fs-5">"I achieved my fitness goals faster than I ever imagined, thanks to this team!"</p>
                          <p><strong>- Jane Smith</strong></p>
                      </div>
                  </div>
              </div>
              <div class="col-md-4 mb-4">
                  <div class="card">
                      <div class="card-body">
                          <p class="fs-5">"The progress tracking is amazing, and I feel motivated to continue my journey!"</p>
                          <p><strong>- Mark Johnson</strong></p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
    
    <section class="bg-light py-5 mt-5">
      <div class="container d-flex flex-column flex-md-row align-items-center">
    <h3 class="fw-bold mb-4">Ready to Begin Your Fitness Journey?</h3>
    <p class="fs-5 mb-4">Join thousands of people who have already transformed their lives with our services.</p>
    <a href="signup.php" class="btn btn-dark btn-lg">Sign Up Now</a>
 </div>
</section>
      
<section class="py-5">
  <div class="container">
      <h3 class="fw-bold text-center mb-4">Frequently Asked Questions</h3>
      <div class="accordion" id="faqAccordion">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    What services do you offer?
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    We offer a variety of fitness and health tracking services, from personal training to group fitness classes and health monitoring.
                </div>
            </div>
        </div>
        
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    How do I book a session?
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    You can easily book a session through our website or contact our team directly to schedule a time.
                </div>
            </div>
        </div>
        
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    What are your payment options?
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    We accept credit cards, debit cards, PayPal, and bank transfers. Please contact our support for more details.
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
      
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
