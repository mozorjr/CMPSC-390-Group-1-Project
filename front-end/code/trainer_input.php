<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Trainer Input</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="static/styles.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Add Trainer Profile</h2>

        <form action="submit_trainer.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Trainer Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3">
                <label for="specialty" class="form-label">Specialty</label>
                <input type="text" class="form-control" id="specialty" name="specialty" required>
            </div>

            <div class="mb-3">
                <label for="bio" class="form-label">Short Bio</label>
                <textarea class="form-control" id="bio" name="bio" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label for="certifications" class="form-label">Certifications</label>
                <input type="text" class="form-control" id="certifications" name="certifications">
            </div>

            <div class="mb-3">
                <label for="experience" class="form-label">Years of Experience</label>
                <input type="number" class="form-control" id="experience" name="experience">
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Upload Image</label>
                <input class="form-control" type="file" id="image" name="image" accept="image/*" required>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-dark btn-lg">Submit Trainer</button>
            </div>
        </form>

        <div class="text-center mt-4">
            <a href="trainers.php" class="btn btn-outline-secondary">View All Trainers</a>
        </div>
    </div>
</body>
</html>

