<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!-- Navbar -->
<header>
     <div class="user-info-absolute">
        <?php if (isset($_SESSION['user_id'])): ?>
            Assalammualaikum, <?php echo htmlspecialchars($_SESSION['user_name']); ?>
            <a href="logout.php" style="margin-left:10px;">Logout</a>
        <?php else: ?>
            <a href="login.php"><button>Login</button></a>
        <?php endif; ?>
    </div>
  <h1>Al-Amin E-Masjid</h1>
  <nav>
    <div class="burger" id="burger">
      <span></span>
      <span></span>
      <span></span>
    </div>
    <ul id="nav-list">
      <li><a href="index.php">Home</a></li>
      <li><a href="about.php">About</a></li>
      <li><a href="announcements.php">Announcements</a></li>
      <li><a href="donations.php">Donations</a></li>
      <li><a href="contact.php">Contact</a></li>
      <li><a href="gallery.php">Gallery</a></li>
      <li><a href="volunteer.php">Volunteer</a></li>
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
<div style="text-align:right; margin: 10px 20px 0 0;">
<?php if (isset($_SESSION['user_id'])): ?>
    Assalammualaikum, <?php echo htmlspecialchars($_SESSION['user_name']); ?>
    <a href="logout.php" style="margin-left:10px;">Logout</a>
<?php else: ?>
    <a href="login.php"><button>Login</button></a>
<?php endif; ?>
</div>
