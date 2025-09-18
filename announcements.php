<?php
include("config/db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Announcements - Al-Amin E-Masjid</title>
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include("includes/navbar.php"); ?>
  <!-- Announcements -->
  <section class="container">
    <h2>Latest Announcements</h2>

    <div class="card">
      <h4>Weekly Friday Prayer</h4>
      <div class="date">📅 12 September 2025 | 🕐 12:30 PM</div>
      <p>Join us for Jumaat prayers and khutbah by Ustaz Ahmad at Masjid Al-Amin.</p>
    </div>

    <div class="card">
      <h4>Donation Drive for Orphans</h4>
      <div class="date">📅 Ongoing Campaign</div>
      <p>Support the community by contributing to our monthly charity drive for orphans and families in need.</p>
    </div>

    <div class="card">
      <h4>Community Gotong-Royong</h4>
      <div class="date">📅 20 September 2025 | 🕐 8:00 AM</div>
      <p>All are welcome to join us for a mosque cleaning and community service event. Breakfast will be provided.</p>
    </div>

  </section>

  <!-- Footer -->
  <footer>
    <p>&copy; 2025 Masjid Al-Amin, Kampung Serigai, Putatan, Sabah</p>
  </footer>

  <script>
    const burger = document.getElementById('burger');
    const navList = document.getElementById('nav-list');
    burger.addEventListener('click', function() {
      navList.classList.toggle('active');
    });
  </script>
</body>
</html>
    <div class="card">
      <h4>Donation Drive for Orphans</h4>
      <div class="date">📅 Ongoing Campaign</div>
      <p>Support the community by contributing to our monthly charity drive for orphans and families in need.</p>
    </div>

    <div class="card">
      <h4>Community Gotong-Royong</h4>
      <div class="date">📅 20 September 2025 | 🕐 8:00 AM</div>
      <p>All are welcome to join us for a mosque cleaning and community service event. Breakfast will be provided.</p>
    </div>

  </section>

  <!-- Footer -->
  <footer>
    <p>&copy; 2025 Masjid Al-Amin, Kampung Serigai, Putatan, Sabah</p>
  </footer>

  <script>
    const burger = document.getElementById('burger');
    const navList = document.getElementById('nav-list');
    burger.addEventListener('click', function() {
      navList.classList.toggle('active');
    });
  </script>
</body>
</html>

