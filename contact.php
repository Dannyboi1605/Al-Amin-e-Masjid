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
  <title>Contact - Al-Amin E-Masjid</title>
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include("includes/navbar.php"); ?>

  <!-- Contact Section -->
  <section class="container">
    <h2>Contact Us</h2>
    <div class="card">
      <form class="contact-form">
        <div class="form-group">
          <label for="name">Full Name</label>
          <input type="text" id="name" name="name" placeholder="Enter your name" required>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="Enter your email" required>
        </div>
        <div class="form-group">
          <label for="message">Message</label>
          <textarea id="message" name="message" placeholder="Write your message..." required></textarea>
        </div>
        <button type="submit">Send Message</button>
      </form>
    </div>

    <!-- Mosque Info -->
    <div class="card info">
      <h3>Masjid Al-Amin</h3>
      <p><strong>Address:</strong> Kampung Serigai, Putatan, Sabah</p>
      <p><strong>Email:</strong> info@alaminemasjid.my</p>
      <p><strong>Phone:</strong> +60 12-345 6789</p>
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
        <button type="submit">Send Message</button>
      </form>
    </div>

    <!-- Mosque Info -->
    <div class="card info">
      <h3>Masjid Al-Amin</h3>
      <p><strong>Address:</strong> Kampung Serigai, Putatan, Sabah</p>
      <p><strong>Email:</strong> info@alaminemasjid.my</p>
      <p><strong>Phone:</strong> +60 12-345 6789</p>
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
