<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include("../config/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);
    $date = !empty($_POST['date']) ? $conn->real_escape_string($_POST['date']) : date('Y-m-d H:i:s');
    $conn->query("INSERT INTO announcements (title, content, date) VALUES ('$title', '$content', '$date')");
    header("Location: announcements.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Announcement</title>
    <script>
    function applyCurrentDate() {
        const now = new Date();
        // Format to yyyy-MM-ddTHH:mm for datetime-local
        const pad = n => n < 10 ? '0' + n : n;
        const formatted = now.getFullYear() + '-' +
            pad(now.getMonth() + 1) + '-' +
            pad(now.getDate()) + 'T' +
            pad(now.getHours()) + ':' +
            pad(now.getMinutes());
        document.querySelector('input[name="date"]').value = formatted;
    }
    </script>
</head>
<body>
    <h2>Add New Announcement</h2>
    <form method="POST" action="">
        <label>Title:</label><br>
        <input type="text" name="title" required><br><br>
        <label>Content:</label><br>
        <textarea name="content" rows="5" cols="40" required></textarea><br><br>
        <label>Date:</label><br>
        <input type="datetime-local" name="date">
        <button type="button" onclick="applyCurrentDate()">Apply</button><br><br>
        <input type="submit" value="Add Announcement">
    </form>
    <br>
    <a href="announcements.php">Back to Announcements</a>
</body>
</html>
