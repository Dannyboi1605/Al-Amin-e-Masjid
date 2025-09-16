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
    <li><a href="logout.php">Logout</a></li>
  </ul>
</body>
</html>
