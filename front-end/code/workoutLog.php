<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Workout Log</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

  <style>
    .container {
      max-width: 900px;
      margin: 0 auto;
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
  
  <div class="container mt-5">
    <h1 class="mb-4">Workout Log</h1>

    <!-- Workout Form -->
    <form id="workout-form" class="mb-4" method="post" action="javascript:void(0);">
      <div class="mb-3">
        <label for="exercise" class="form-label">Exercise Type</label>
        <input type="text" class="form-control" id="exercise" name="exercise" placeholder="E.g., Running, Cycling" required />
      </div>
      <div class="mb-3">
        <label for="duration" class="form-label">Duration (minutes)</label>
        <input type="number" class="form-control" id="duration" name="duration" placeholder="E.g., 30" required />
      </div>
      <div class="mb-3">
        <label for="calories-burned" class="form-label">Calories Burned</label>
        <input type="number" class="form-control" id="calories-burned" name="calories_burned" placeholder="E.g., 250" required />
      </div>
      <div class="mb-3">
        <label for="workout-date" class="form-label">Workout Date</label>
        <input type="date" class="form-control" id="workout-date" name="workout_date" placeholder= "2025-04-10" required />
      </div>
      <button type="submit" class="btn btn-success">Add Workout</button>
    </form>
  

    <h2>Logged Workouts</h2>
    <table id="workout-table" class="table table-striped">
      <thead>
        <tr>
          <th>Exercise</th>
          <th>Duration (mins)</th>
          <th>Calories Burned</th>
          <th>Workout Date</th>
        </tr>
      </thead>
      <tbody>
        <!-- Workout logs will be displayed here -->
      </tbody>
    </table>
  </div>

  <footer class="foot bg-light py-4 mt-5">
    <div class="container-fluid d-flex justify-content-between align-items-center">
      <a class="btn btn-dark" href="index.html">Home</a>
      <nav class="d-flex gap-3">
          <a href="whyUs.php" class="btn">Why Us</a>
          <a href="contact.php" class="btn">Contact Us</a>
      </nav>
      <div class="d-flex gap-3">
          <a href="https://www.facebook.com" target="_blank">
              <img src="Facebook_logo_(square).png" class="img-fluid" style="max-width: 30px;" alt="Facebook">
          </a>
          <a href="https://www.linkedin.com" target="_blank">
              <img src="linkedin.png" class="img-fluid" style="max-width: 30px;" alt="LinkedIn">
          </a>
          <a href="https://www.instagram.com" target="_blank">
              <img src="Insta-Logo.png" class="img-fluid" style="max-width: 30px;" alt="Instagram">
          </a>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
  <script>
     window.onload = function () {
    let loggedIn = localStorage.getItem("loggedIn") === "true";
    document.getElementById("signup-btn").classList.toggle("d-none", loggedIn);
    document.getElementById("profile-btn").classList.toggle("d-none", !loggedIn);
    document.getElementById("sleep-tracker-nav").classList.toggle("d-none", !loggedIn);
    document.getElementById("workout-tracker-nav").classList.toggle("d-none", !loggedIn);
    };

    $(document).ready(function () {
  // Function to load workouts from the database
  function loadWorkouts() {
    $.get('workouts.php', function(data) {
      let workouts = JSON.parse(data);
      let tableBody = $('#workout-table tbody');
      tableBody.empty(); // Clear the current workout logs

      workouts.forEach(function(workout) {
        // Log the raw workout_date to the console
        console.log("Raw workout_date:", workout.workout_date);

        // Check if workout_date exists and is a valid date
        let workoutDate = workout.workout_date ? new Date(workout.workout_date) : null;

        // Format the date to a readable format (MM/DD/YYYY)
        if (workoutDate && !isNaN(workoutDate)) {
          workoutDate = workoutDate.toLocaleDateString('en-US'); // 'en-US' gives MM/DD/YYYY format
        } else {
          workoutDate = 'No date available'; // Default message if no valid date
        }

        // Log the formatted workout_date
        console.log("Formatted workout_date:", workoutDate);

        // Append each workout entry to the table
        tableBody.append(
          `<tr>
            <td>${workout.exercise}</td>
            <td>${workout.duration}</td>
            <td>${workout.calories_burned}</td>
            <td>${workoutDate}</td> <!-- Display formatted workout date here -->
          </tr>`
        );
      });
    });
  }

  // Call loadWorkouts function on page load
  loadWorkouts();

  // Handle form submission
  $('#workout-form').on('submit', function(e) {
    e.preventDefault();

    // Get form values
    let exercise = $('#exercise').val();
    let duration = $('#duration').val();
    let caloriesBurned = $('#calories-burned').val();
    let workoutDate = $('#workout-date').val();

    // Prepare new workout data
    let newWorkout = {
      exercise: exercise,
      duration: parseInt(duration),
      calories_burned: parseInt(caloriesBurned),
      workout_date: workoutDate
    };

    console.log("Sending workout data:", newWorkout); // 👈 Add this for debugging

    $.ajax({
      url: 'add_workout.php',
      type: 'POST',
      data: newWorkout,
      success: function(response) {
        console.log("Raw server response:", response); // Log the raw response for debugging
        try {
          let data = JSON.parse(response); // Try to parse the response
          if (data.success) {
            $('#workout-form')[0].reset();
            loadWorkouts(); // Reload workouts after successful submission
          } else {
            alert("Error: " + data.error); // Show the error if available
          }
        } catch (e) {
          // Handle unexpected responses that aren't JSON
          loadWorkouts();
        }
      },
      error: function(xhr) {
        if (xhr.status === 401) {
          alert("You must be logged in to log your workout.");
          window.location.href = "signup.php"; // Optional: redirect to login
        } else {
          let message = "Something went wrong.";
          if (xhr.responseText) {
            try {
              let data = JSON.parse(xhr.responseText);
              message = data.error || message;
            } catch (e) {
              // If the response isn't valid JSON, just use the raw response
              message = xhr.responseText;
            }
          }
          alert("Error: " + message); // Show the error message
        }
      }
    });
  });
});





  </script>
</body>
</html>


