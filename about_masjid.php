<?php
include("config/db.php");
$result = $conn->query("SELECT * FROM about_masjid LIMIT 1");
$about = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About Masjid Al-Amin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <h1 class="mb-4">About Masjid Al-Amin</h1>
    <h4>Vision</h4>
    <p><?= nl2br($about['vision']) ?></p>
    <h4>Mission</h4>
    <p><?= nl2br($about['mission']) ?></p>

    <h4 class="mt-4">Location</h4>
    <!-- Replace with your Google Maps embed -->
    <iframe src="https://www.google.com/maps/embed?pb=..."
            width="100%" height="400" style="border:0;" allowfullscreen loading="lazy"></iframe>
</div>
</body>
</html>
