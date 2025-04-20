<?php
include 'db.php';

$sql = "SELECT * FROM workouts ORDER BY workout_date DESC";
$stmt = $conn->query($sql);
$workouts = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<ul>";
foreach ($workouts as $workout) {
    echo "<li>" . $workout['exercise_type'] . " - " . $workout['duration'] . " min - " . $workout['calories_burned'] . " kcal on " . $workout['workout_date'] . "</li>";
}
echo "</ul>";
?>
