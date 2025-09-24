<?php
session_start();
include("config/db.php");

// Fetch all announcements
$query = "SELECT * FROM announcements ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
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

  <section class="container">
    <h2>All Announcements</h2>

    <?php if (mysqli_num_rows($result) > 0): ?>
      <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="card">
          <h3><?php echo htmlspecialchars($row['title']); ?></h3>
          <p><strong>Date:</strong> <?php echo date("d M Y", strtotime($row['event_date'])); ?></p>
          <p><?php echo nl2br(htmlspecialchars(substr($row['content'], 0, 200))); ?>...</p>
          <a href="announcement_details.php?id=<?php echo $row['id']; ?>">Read more</a>
        </div>
      <?php } ?>
    <?php else: ?>
      <p>No announcements available at the moment.</p>
    <?php endif; ?>
  </section>

  <footer>
    <p>&copy; 2025 Masjid Al-Amin, Kampung Serigai, Putatan, Sabah</p>
  </footer>
</body>
</html>
