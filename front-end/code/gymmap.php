<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
        <link rel="stylesheet" href="styles.css">
    </head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script type="module" src="https://unpkg.com/@googlemaps/extended-component-library"></script>
<gmpx-api-loader key ="AIzaSyAQdpij1r9XsDmRMgZaJxKVYHhbFJIPeN8"></gmpx-api-loader>

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
        <section>
            <div class="mainText">
                <h6 class="display-6 text-center">Partnered Gyms</h6>
            </div>
            </section>
            <div class="goalText">
                <p class="fs-5 text-center p-3 move">Health Horizon has partnered with several gyms in order to help clients complete their fitness goals.</p>
                <p class="fs-5 text-center p-3 move">We maded sure to partner with gyms that are welcoming, clean, and safe for all.</p>
                <p class="fs-5 text-center p-3 move">Some of the gyms were selected by our Trainers based on what machines and prices they offer.</p>
                <br>
                <br>
                <br>
            </div>
        </section>
   
    <div id="mapContainer"> 
        <h8>Saint Xavier University Shannon Center
            <br>
            <br>
        </h8>
        <div id="map">
            <gmpx-split-layout>
            <gmpx-place-overview slot="fixed" size="large" place="ChIJnQLTad06DogR8vrQgBuXdoI"></gmpx-place-overview>
            <gmp-map slot="main" width="350px" center="41.70677372896473, -87.71619689975361" zoom="17" map-id="Shannon">
            <gmp-advanced-marker position="41.70677372896473, -87.71619689975361"></gmp-advanced-marker>
        </div>
        <div id="mapText">
            The 85,000 sq. ft. facility's main arena seats 3,000 people for athletic events and special occasions such as graduation ceremonies, academic convocations and concerts.
            <br>
            The Shannon Center is a private campus facility free for SXU students, faculty/staff, and Sisters of Mercy with a current Cougar ID card. Check out our membership page for more information.
            <br>
            All patrons using the Shannon Center must have a current SXU ID and sign in and swipe in at the Shannon Center front desk located in the middle of the lobby.
            <br>
            The Shannon Athletic and Convocation Center contains: Fitness Center, Two Recreation Gyms, Indoor Running Track (1/8 mile), One Racquetball Court, Group Exercise/Dance Studio, Athletic Training Room - for SXU Athletes only, Offices for Coaches/Staff, Locker Rooms
        </div>
    </div>
    <br>
    <div id="mapContainer"> 
        <h8>Stone Age Athletic Club
            <br>
            <br>
        </h8>
        <div id="map">
            <gmpx-split-layout>
                <gmpx-place-overview slot="fixed" size="large" place="ChIJxZ3rCNI6DogRUKibAjTdxCo"></gmpx-place-overview>
                <gmp-map slot="main" center="41.707824063021064, -87.70182161820772" zoom="17" map-id="Stone_Age">
                <gmp-advanced-marker position="41.707824063021064, -87.70182161820772"></gmp-advanced-marker>
        </div>
        <div id="mapText">
            Stone Age Athletic Club was built on the idea of giving people their lives back, with better health, strength, and fitness. The idea isn’t top performance though, it’s about performing for a lifetime. As a Chicago Firefighter, I’ve seen firsthand what the ravages of time, neglect, and misinformation can do to a person’s physical self. We’ve made it our mission to help people get to retirement age, feeling energetic and confident. Adulthood should be spent playing with your kids, traveling or just remaining active and trying new things. The golden years aren’t meant to be spent in the doctor’s office, shuttling from appointment to appointment. Prescriptions aren’t getting any cheaper either!! There’s another life out there, a better one filled with optimism and courage. Knowing that you’re going to be ok, and being unafraid of getting older, is a very powerful feeling, but it eludes many. We exist to serve those that are willing to try AND learn. Most simply cannot do it on their own. With our help, you have a chance.
        </div>
    </div>
    <br>
    <div id="mapContainer"> 
        <h8>Planet Fitness
            <br>
            <br>
        </h8>
        <div id="map">
            <gmpx-split-layout>
                <gmpx-place-overview slot="fixed" size="large" place="ChIJ9avNZ2A6DogRQ09gHj4v6l4"></gmpx-place-overview>
                <gmp-map slot="main" center="41.7196268393727, -87.73884544052066" zoom="17" map-id="LA_Fitness">
                <gmp-advanced-marker position="41.7196268393727, -87.73884544052066"></gmp-advanced-marker>
        </div>
        <div id="mapText">
            We strive to create a workout environment where everyone feels accepted and respected. That’s why at Planet Fitness Oak Lawn, IL, we make sure our club is clean and welcoming, our team members are friendly, and our certified trainers are ready to help. Whether you’re a first-time gym user or a fitness veteran, you’ll always have a home in our Judgement Free Zone®. Download our free PF mobile app and get access to hundreds of workout videos, a personal fitness tracker, partner rewards and discounts and more.
            <br>
            Our certified fitness trainers will show you around the gym and provide instruction on our huge selection of cardio and strength machines. Our gym trainers also facilitate a wide variety of small group training sessions and are available to design an exercise program to help you meet your goals and get the most out of your workouts.
            <br>
            <br>
        </div>
    </div>
    
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
</body>
</html>