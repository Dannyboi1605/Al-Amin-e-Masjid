<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include("../config/db.php");

if (!isset($_GET['id'])) {
    header("Location: announcements.php");
    exit();
}

$id = intval($_GET['id']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);
    $conn->query("UPDATE announcements SET title='$title', content='$content' WHERE id=$id");
    header("Location: announcements.php");
    exit();
}

$result = $conn->query("SELECT * FROM announcements WHERE id=$id");
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Announcement</title>
</head>
<body>
    <h2>Edit Announcement</h2>
    <form method="POST" action="">
        <label>Title:</label><br>
        <input type="text" name="title" value="<?php echo htmlspecialchars($row['title']); ?>" required><br><br>
        <label>Content:</label><br>
        <textarea name="content" rows="5" cols="40" required><?php echo htmlspecialchars($row['content']); ?></textarea><br><br>
        <input type="submit" value="Update Announcement">
    </form>
    <br>
    <a href="announcements.php">Back to Announcements</a>
</body>
</html>
