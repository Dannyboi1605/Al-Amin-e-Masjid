<?php
session_start();
include("../config/db.php");

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM announcements WHERE id=$id");
$announcement = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $event_date = $_POST['event_date'];

    $sql = "UPDATE announcements SET title='$title', content='$content', event_date='$event_date' WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        header("Location: announcements.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<form method="POST">
  <label>Title:</label><br>
  <input type="text" name="title" value="<?php echo htmlspecialchars($announcement['title']); ?>" required><br><br>
  
  <label>Content:</label><br>
  <textarea name="content" rows="5" required><?php echo htmlspecialchars($announcement['content']); ?></textarea><br><br>
  
  <label>Event Date:</label><br>
  <input type="date" name="event_date" value="<?php echo $announcement['event_date']; ?>" required><br><br>
  
  <button type="submit">Update</button>
</form>
