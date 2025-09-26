<?php
session_start();
include("../config/db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $event_date = $_POST['event_date'];

    $sql = "INSERT INTO announcements (title, content, event_date) VALUES ('$title', '$content', '$event_date')";
    if (mysqli_query($conn, $sql)) {
        header("Location: announcements.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
  <?php include("includes/navbar.php"); ?>
<form method="POST">
  <label>Title:</label><br>
  <input type="text" name="title" required><br><br>
  
  <label>Content:</label><br>
  <textarea name="content" rows="5" required></textarea><br><br>
  
  <label>Event Date:</label><br>
  <input type="date" name="event_date" required><br><br>
  
  <button type="submit">Save</button>

</form>
