<?php
session_start();
include("../config/db.php");

// Fetch data
$result = $conn->query("SELECT * FROM about_masjid LIMIT 1");
$about = $result->fetch_assoc();

// Update when form submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $vision = $conn->real_escape_string($_POST['vision']);
    $mission = $conn->real_escape_string($_POST['mission']);

    $conn->query("UPDATE about_masjid SET vision='$vision', mission='$mission' WHERE id=1");
    header("Location: manage_about.php?success=1");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage About Masjid</title>
      <?php include("includes/navbar.php"); ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
    <h2>Manage About Masjid</h2>
    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success">Updated successfully!</div>
    <?php endif; ?>
    <form method="post">
        <div class="mb-3">
            <label class="form-label">Vision</label>
            <textarea name="vision" class="form-control" rows="4"><?= $about['vision'] ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Mission</label>
            <textarea name="mission" class="form-control" rows="4"><?= $about['mission'] ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
    <a href="dashboard.php">Back to Dashboard</a>
</body>
</html>
