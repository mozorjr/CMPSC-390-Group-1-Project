<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>html, body {
        height: 100%;
        margin: 0;
        display: flex;
        flex-direction: column;
    }
    
    .container {
        flex: 1;
    }
    
    footer {
        width: 100%;
        margin-top: auto;
    }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sleep Log</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

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

  <div class="container mt-5">
    <h1 class="mb-4">Sleep Tracker</h1>
    <p >Track your sleep everyday. </p>

    <form id="sleep-form" class="mb-4" action="sleepDb.php" method="post">
      <div class="mb-3">
        <label for="date" class="form-label">Date</label>
        <input type="date" class="form-control" id="date" required name="date"/>
      </div>
      <div class="mb-3">
        <label for="sleep-hours" class="form-label">Hours Slept</label>
        <input type="number" class="form-control" id="sleep-hours" placeholder="E.g., 7.5" step="0.1" required name="hours"/>
      </div>
      <button type="submit" class="btn btn-primary">Log Sleep</button>
    </form>

    <h4>Average Sleep Duration: <span id="average-sleep">0</span> hours</h4>
    <h2>Your Sleep Log</h2>
    <ul id="sleep-list" class="list-group mb-3"></ul>
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
    document.getElementById("sleep-form").addEventListener("submit", function (e) {
    e.preventDefault(); 

    //get the data from the form and send to the sleepDb.php
    let formData = new FormData(this);

    fetch("sleepDb.php", {
    method: "POST",
    body: formData
})
.then(response => response.text()) // ← get raw response
.then(text => {
    console.log("Raw server response:", text); // ← see what PHP actually returns
    let data = JSON.parse(text); // now try to parse it
    console.log("Parsed JSON:", data);

    if (data.success) {
        document.getElementById("sleep-form").reset();
        loadSleepLogs();
    } else {
        alert("Error: " + data.error);
    }
})
.catch(error => console.error("Parsing error:", error));


});

//get the sleep logs from the DB by calling the fetchSleepLogs.php
function loadSleepLogs() {
    fetch("fetchSleepLogs.php") 
    .then(response => response.json())
    .then(data => {
        let sleepList = document.getElementById("sleep-list");
        let totalHours = 0;

        sleepList.innerHTML = ""; 

        //put the data at the bottom of the page in descending order
        data.forEach(log => {
            let listItem = document.createElement("li");
            listItem.classList.add("list-group-item");
            listItem.textContent = `Date: ${log.date}, Hours Slept: ${log.hours}`;
            sleepList.appendChild(listItem);
            totalHours += parseFloat(log.hours);
        });
        //avg sleep
        let averageSleep = data.length ? (totalHours / data.length).toFixed(1) : 0;
        document.getElementById("average-sleep").textContent = averageSleep;
    })
    .catch(error => console.error("Error fetching sleep logs:", error));
}

window.onload = function () {
    //loads user sleep logs on window load page
    loadSleepLogs(); 
    let loggedIn = localStorage.getItem("loggedIn") === "true";
    document.getElementById("signup-btn").classList.toggle("d-none", loggedIn);
    document.getElementById("profile-btn").classList.toggle("d-none", !loggedIn);
    document.getElementById("sleep-tracker-nav").classList.toggle("d-none", !loggedIn);
    };
    </script>
</body>
</html>