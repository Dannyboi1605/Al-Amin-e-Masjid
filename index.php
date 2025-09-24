<?php
session_start();
include("config/db.php"); // Database connection

// Check if user is logged in (optional - remove if homepage should be public)
if (!isset($_SESSION['user_id'])) {
    // header("Location: login.php");
    // exit();
}

// Fetch homepage settings (hero text etc.)
$hero_query = "SELECT * FROM homepage_settings LIMIT 1";
$hero_result = mysqli_query($conn, $hero_query);
$hero = mysqli_fetch_assoc($hero_result);

// Fetch latest announcements
$announcements_query = "SELECT * FROM announcements ORDER BY created_at DESC LIMIT 3";
$announcements_result = mysqli_query($conn, $announcements_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Al-Amin E-Masjid</title>
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include("includes/navbar.php"); ?>

  <!-- Hero -->
  <section class="hero">
    <h2><?php echo $hero['title'] ?? "Welcome to Al-Amin E-Masjid"; ?></h2>
    <p><?php echo $hero['subtitle'] ?? "Connecting the community through faith, events, and service."; ?></p>
  </section>

  <!-- Announcements -->
  <section>
    <h3>Latest Announcements</h3>
    <?php while ($row = mysqli_fetch_assoc($announcements_result)) { ?>
      <div class="card">
        <h4><?php echo htmlspecialchars($row['title']); ?></h4>
        <p><strong>Date:</strong> <?php echo date("d M Y", strtotime($row['event_date'])); ?></p>
        <p><?php echo htmlspecialchars($row['content']); ?></p>
        <a href="announcement_details.php?id=<?php echo $row['id']; ?>">Read more</a>
      </div>
    <?php } ?>
  </section>

  <!-- Donations -->
  <section>
    <h3>Support the Mosque</h3>
    <p>Your donations help us run programs and maintain the mosque.</p>
    <a href="donations.php" class="btn-donate">Donate Now</a>
  </section>

  <!-- Footer -->
  <footer>
    <p>&copy; 2025 Masjid Al-Amin, Kampung Serigai, Putatan, Sabah</p>
  </footer>

  <script>
    const burger = document.getElementById('burger');
    const navList = document.getElementById('nav-list');
    burger?.addEventListener('click', function() {
      navList.classList.toggle('active');
    });
  </script>
</body>
</html>
