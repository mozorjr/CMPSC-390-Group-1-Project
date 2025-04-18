<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require __DIR__ . "sleepDb.php";
    
    $sql = "SELECT * FROM user WHERE email = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $_POST["email"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    
    if ($user && password_verify($_POST["password"], $user["password_hash"])) {
        session_regenerate_id(true);
        $_SESSION["user_id"] = $user["id"];
        header("Location: index.php");
        exit;
    }
    
    $is_invalid = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script type="text/javascript" src="validation.js" defer></script>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="btn btn-dark" href="index.html">Home</a>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav mx-auto">
        <li classsss="nav-item"><a class="nav-link" href="about.html">About</a></li>
          <li class="nav-item"><a class="nav-link" href="member.html">Memberships</a></li>
          <li class="nav-item"><a class="nav-link" href="calorie_tracker.html">Calorie Tracker</a></li>
          <li class="nav-item"><a class="nav-link" href="RT.html">Request a Trainer</a></li>
          <li class="nav-item"><a class="nav-link" href="gymmap.html">Gyms</a></li>
          <li class="nav-item"><a class="nav-link" href="whyUs.html">Why Us</a></li>
          <li class="nav-item"><a class="nav-link" href="contact.html">Contact Us</a></li>
        </ul>
        <a class="btn btn-dark" href="signup.html">Signup</a>
      </div>
    </div>
  </nav>

  <main class="container text-center my-5">
    <section>
      <h3 style="font-size: 80px;">Login Page</h3>
    </section>

    <p id="error-message"></p>

    <form onsubmit="auth(event)" id="form" class="mx-auto" style="max-width: 400px;">
      <div>
        <label for="email-input">
          <span>@</span>
        </label>
        <input type="email" name="email" id="email-input" placeholder="Email">
      </div>
      <div>
        <label for="password-input">
          <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f"><path d="M240-80q-33 0-56.5-23.5T160-160v-400q0-33 23.5-56.5T240-640h40v-80q0-83 58.5-141.5T480-920q83 0 141.5 58.5T680-720v80h40q33 0 56.5 23.5T800-560v400q0 33-23.5 56.5T720-80H240Zm240-200q33 0 56.5-23.5T560-360q0-33-23.5-56.5T480-440q-33 0-56.5 23.5T400-360q0 33 23.5 56.5T480-280ZM360-640h240v-80q0-50-35-85t-85-35q-50 0-85 35t-35 85v80Z"/></svg>
        </label>
        <input type="password" name="password" id="password-input" placeholder="Password">
      </div>
      <div>
        <button>Log in</button>
      </div>
    </form>

    <p class="text">Need to create an account?<a href="signup.html">Signup</a></p>
  </main>

  <script>
  function auth(event) {
    event.preventDefault();

    var email = document.getElementById('email-input').value;
    var password = document.getElementById('password-input').value;

    if(email==='admin@gmail.com' && password=== "12345678"){
        localStorage.setItem("loggedIn", "true");
          window.location.href = 'index.html';
      }
      else{
          alert("invalid info");
          return;
      }

    fetch("login.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: `email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}`
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        localStorage.setItem("loggedIn", "true");
        window.location.href = 'index.html';
      } else {
        alert("Invalid credentials");
      }
    });
  }
  </script>
</body>
</html>