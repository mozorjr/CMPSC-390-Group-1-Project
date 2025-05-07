<?php
$host = 'localhost'; // Database host (e.g., localhost)
$db = 'workout_log'; // Database name
$user = 'root'; // Database username
$pass = ''; // Database password (default is empty for local development)

try {
    // Establishing a database connection
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
