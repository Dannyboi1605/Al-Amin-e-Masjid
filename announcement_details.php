<?php
session_start();
include("config/db.php");

if (!isset($_GET['id'])) {
    header("Location: announcements.php");
    exit();
}

$id = intval($_GET['id']);
$query = "SELECT * FROM announcements WHERE id = $id";
$result = mysqli_query($conn, $query);
$announcement = mysqli_fetch_assoc($result);

if (!$announcement) {
    echo "Announcement not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo htmlspecialchars($announcement['title']); ?> - Al-Amin E-Masjid</title>
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <?php include("includes/navbar.php"); ?>

  <section class="container">
    <h2><?php echo htmlspecialchars($announcement['title']); ?></h2>
    <p><strong>Date:</strong> <?php echo date("d M Y", strtotime($announcement['event_date'])); ?></p>
    <p><?php echo nl2br(htmlspecialchars($announcement['content'])); ?></p>
    <a href="announcements.php">⬅ Back to Announcements</a>
  </section>

  <footer>
    <p>&copy; 2025 Masjid Al-Amin, Kampung Serigai, Putatan, Sabah</p>
  </footer>
</body>
</html>
