
<?php
session_start();
include("../config/db.php");

echo "<pre>";
print_r($_SESSION);
echo "</pre>";


// Ensure only logged-in admins can access
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

// Fetch all announcements
$result = mysqli_query($conn, "SELECT * FROM announcements ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Announcements</title>
  <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
  <h2>Manage Announcements</h2>
  <a href="add_announcement.php">➕ Add New Announcement</a>
  <table border="1" cellpadding="10">
    <tr>
      <th>ID</th>
      <th>Title</th>
      <th>Date</th>
      <th>Created</th>
      <th>Actions</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
      <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo htmlspecialchars($row['title']); ?></td>
        <td><?php echo $row['event_date']; ?></td>
        <td><?php echo $row['created_at']; ?></td>
        <td>
          <a href="edit_announcement.php?id=<?php echo $row['id']; ?>">✏️ Edit</a> |
          <a href="delete_announcement.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">🗑️ Delete</a>
        </td>
      </tr>
    <?php } ?>
  </table>
      <br>
    <a href="dashboard.php">Back to Dashboard</a>
</body>
</html>
