<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Donations - Al-Amin E-Masjid</title>
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include("includes/navbar.php"); ?>
    <!-- Navbar -->
    <header>
    <h1>Al-Amin E-Masjid</h1>
    <nav>
      <div class="burger" id="burger">
        <span></span>
        <span></span>
        <span></span>
      </div>
      <ul id="nav-list">
        <li><a href="index.html">Home</a></li>
        <li><a href="about.html">About</a></li>
        <li><a href="announcements.html">Announcements</a></li>
        <li><a href="donation.html">Donations</a></li>
        <li><a href="contact.html">Contact</a></li>
                <li><a href="gallery.html">Gallery</a></li>
        <li><a href="volunteer.html">Volunteer</a></li>
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

  <!-- Donations Section -->
  <section class="container">
    <h2>Support Masjid Al-Amin</h2>
    <div class="card">
      <p>
        Your generosity sustains our mosque, community programs, and ongoing improvements.
        Choose your donation type and method below. Thank you for your support!
      </p>
    </div>
    <div class="card">
      <form class="donation-form">
        <div class="form-group">
          <label for="name"><span>Full Name</span></label>
          <input type="text" id="name" name="name" placeholder="e.g. Ahmad bin Ali" required>
        </div>
        <div class="form-group">
          <label for="email"><span>Email</span></label>
          <input type="email" id="email" name="email" placeholder="e.g. ahmad@email.com" required>
        </div>
        <div class="form-group">
          <label for="amount"><span>Amount (RM)</span></label>
          <input type="number" id="amount" name="amount" min="1" placeholder="e.g. 50" required>
        </div>
        <div class="form-group">
          <label for="type"><span>Donation Type</span></label>
          <select id="type" name="type" required>
            <option value="">Select type</option>
            <option value="zakat">Zakat</option>
            <option value="sadaqah">Sadaqah</option>
            <option value="waqf">Waqf</option>
            <option value="other">Other</option>
          </select>
        </div>
        <div class="form-group">
          <label for="method"><span>Payment Method</span></label>
          <select id="method" name="method" required>
            <option value="">Select method</option>
            <option value="online">Online Banking</option>
            <option value="cash">Cash</option>
            <option value="transfer">Bank Transfer</option>
          </select>
        </div>
        <button type="submit" class="donate-btn">Donate Now</button>
      </form>
    </div>
    <div class="card">
      <h3>Bank Details</h3>
      <p><strong>Bank Name:</strong> Maybank</p>
      <p><strong>Account No:</strong> 1234567890</p>
      <p><strong>Account Name:</strong> Masjid Al-Amin</p>
      <p>For bank transfer, please email your receipt to <a href="mailto:info@masjidalamin.com">info@masjidalamin.com</a>.</p>
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
