<?php
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "healthHorizon";
//or do require db.php; -- I just couldnt make this work on my pc


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


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
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="btn btn-dark" href="/health-horizon-php/index.php">Home</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link" href="/health-horizon-php/static/about.html">About</a></li>
                <li class="nav-item"><a class="nav-link" href="/health-horizon-php/static/member.html">Memberships</a></li>
                <li class="nav-item"><a class="nav-link" href="/health-horizon-php/static/calorie_tracker.html">Calorie Tracker</a></li>
                <li class="nav-item"><a class="nav-link" href="/health-horizon-php/RT.php">Request a Trainer</a></li>
                <li class="nav-item"><a class="nav-link" href="/health-horizon-php/static/gymmap.html">Gyms</a></li>
                <li class="nav-item"><a class="nav-link" href="/health-horizon-php/static/whyUs.html">Why Us</a></li>
                <li class="nav-item"><a class="nav-link" href="/health-horizon-php/static/contact.html">Contact Us</a></li>
            </ul>
            <a class="btn btn-dark" href="/health-horizon-php/static/signup.html" id="signup-btn">Signup</a>
            <a href="profile.html" id="profile-btn" class="d-none">
                <svg xmlns="http://www.w3.org/2000/svg" height="30px" viewBox="0 -960 960 960" width="30px" fill="#1f1f1f">
                    <path d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Z"/>
                </svg>
            </a>
        </div>
    </div>
</nav>

<main>
    <section class="text-center mt-5">
        <h2 class="fw-bold mb-5">Request A Trainer</h2>
        <div class="container-fluid p-0">
            <img src="rtimg.jpg" alt="RT Image" class="img-fluid w-100">
        </div>
    </section>

    <section class="bg-light py-5 mt-5">
        <div class="container d-flex flex-column flex-md-row align-items-center">
            <h4> We at Health Horizons make it a priority to ensure that the consumer is able to make every choice possible.</h4>
            <br><br>
            <h4>On this page you will be able to select any available trainer and see their experiences and some information about them before you make your choice.</h4>
        </div>
    </section>

    <section class="bg-light py-5 mt-5">
        <div class="container d-flex flex-column flex-md-row align-items-center">
            <form action="submit_form.php" method="POST">
                <label for="choices">Request a Trainer Here:</label>
                <select id="choices" name="trainer_id" onchange="displayInfo()" class="form-select w-50 mx-auto" required>
                    <option value="" disabled selected>Pick a Trainer</option>
                    <?php foreach ($trainers as $trainer): ?>
                        <option value="<?php echo $trainer['id']; ?>">
                            <?php echo htmlspecialchars($trainer['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                
                <br><br>
                <input type="submit" value="Submit" class="btn btn-dark">
            </form>
        </div>

        <div id="info">
            <p>Please select an option to see more information.</p>
        </div>
    </section>

    <footer class="foot bg-light py-4 mt-5">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <a class="btn btn-dark" href="/health-horizon-php/index.php">Home</a>
            <nav class="d-flex gap-3">
                <a href="/health-horizon-php/static/whyUs.html" class="btn">Why Us</a>
                <a href="/health-horizon-php/static/contact.html" class="btn">Contact Us</a>
            </nav>
            <div class="d-flex gap-3">
                <a href="https://www.facebook.com" target="_blank">
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

<script>
    window.onload = function() {
        let loggedIn = localStorage.getItem("loggedIn") === "true";
        let signupBtn = document.getElementById("signup-btn");
        let profileBtn = document.getElementById("profile-btn");

        if (loggedIn) {
            signupBtn.classList.add("d-none"); 
            profileBtn.classList.remove("d-none");
        }
    };
</script>

</body>
</html>

<?php
$conn->close();
?>


