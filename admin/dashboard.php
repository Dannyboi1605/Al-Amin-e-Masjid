<?php
session_start();

// Allow access only if user is logged in AND has role 'admin'
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard</title>
</head>
<body>
  <h2>Welcome, <?php echo $_SESSION['user_name']; ?>!</h2>

  <?php include("includes/navbar.php"); ?>

  <p>Choose an option from the menu above.</p>
</body>
</html>
