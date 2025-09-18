<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard</title>
</head>
<body>
  <h2>Welcome, <?php echo $_SESSION['admin']; ?>!</h2>
  <ul>
    <li><a href="announcements.php">Manage Announcements</a></li>
    <li><a href="events.php">Manage Events</a></li>
    <li><a href="donations.php">View Donations</a></li>
    <li><a href="volunteers.php">View Volunteers</a></li>
    <li><a href="gallery.php">Manage Gallery</a></li>
    <li><a href="prayer_times.php">Edit Prayer Times</a></li>
    <li><a href="users.php">Users</a></li>
    <li><a href="logout.php">Logout</a></li>
  </ul>
  <nav>
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="about.php">About</a></li>
      <li><a href="announcements.php">Announcements</a></li>
      <li><a href="donations.php">Donations</a></li>
      <li><a href="volunteer.php">Volunteer</a></li>
      <li><a href="gallery.php">Gallery</a></li>
      <li><a href="contact.php">Contact</a></li>
    </ul>
  </nav>
  <!-- Example internal link -->
  <a href="volunteer.php">Become a Volunteer</a>
</body>
</html>