<?php
session_start();

// Allow access only if user is logged in AND has role 'admin'
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gallery - Al-Amin E-Masjid</title>
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include("includes/navbar.php"); ?>
    <!-- Navbar -->
    <header>
    <h1>Al-Amin E-Masjid</h1>
    <nav>
      <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="about.html">About</a></li>
        <li><a href="announcements.html">Announcements</a></li>
        <li><a href="donations.html">Donations</a></li>
        <li><a href="volunteer.html">Volunteer</a></li>
        <li><a href="gallery.html">Gallery</a></li>
        <li><a href="contact.html">Contact</a></li>
      </ul>
    </nav>
    <div class="prayer-bar">
      <span><strong>Subuh:</strong> 5:15 AM</span>
      <span><strong>Zohor:</strong> 12:30 PM</span>
      <span><strong>Asar:</strong> 4:00 PM</span>
      <span><strong>Maghrib:</strong> 6:25 PM</span>
      <span><strong>Isyak:</strong> 7:45 PM</span>
    </div>
  </header>
  <div class="container">
    <section>
      <h2>Gallery</h2>
      <div class="gallery">
        <img src="https://via.placeholder.com/400x300?text=Event+1" alt="Event 1">
        <img src="https://via.placeholder.com/400x300?text=Event+2" alt="Event 2">
        <img src="https://via.placeholder.com/400x300?text=Event+3" alt="Event 3">
        <img src="https://via.placeholder.com/400x300?text=Event+4" alt="Event 4">
        <img src="https://via.placeholder.com/400x300?text=Event+5" alt="Event 5">
        <img src="https://via.placeholder.com/400x300?text=Event+6" alt="Event 6">
      </div>
    </section>
  </div>
  <!-- Footer -->
  <footer>
    <p>&copy; 2025 Masjid Al-Amin, Kampung Serigai, Putatan, Sabah</p>
  </footer>
</body>
</html>
