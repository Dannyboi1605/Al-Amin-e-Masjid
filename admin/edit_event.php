<?php
session_start();

// Ensure only logged-in admins can access
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}
include("../config/db.php");

if (!isset($_GET['id'])) {
    header("Location: events.php");
    exit();
}

$id = intval($_GET['id']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $date = $conn->real_escape_string($_POST['date']);
    $status = $conn->real_escape_string($_POST['status']);
    $allow_volunteers = isset($_POST['allow_volunteers']) ? 1 : 0;
    $conn->query("UPDATE events SET title='$title', description='$description', date='$date', status='$status', allow_volunteers=$allow_volunteers WHERE id=$id");
    header("Location: events.php");
    exit();
}

$result = $conn->query("SELECT * FROM events WHERE id=$id");
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Event</title>
</head>
<body>
    <h2>Edit Event</h2>
    <form method="POST" action="">
        <label>Title:</label><br>
        <input type="text" name="title" value="<?php echo htmlspecialchars($row['title']); ?>" required><br><br>
        <label>Description:</label><br>
        <textarea name="description" rows="5" cols="40" required><?php echo htmlspecialchars($row['description']); ?></textarea><br><br>
        <label>Date:</label><br>
        <input type="datetime-local" name="date" value="<?php echo date('Y-m-d\TH:i', strtotime($row['date'])); ?>" required><br><br>
        <label>Status:</label><br>
        <select name="status" required>
            <option value="upcoming" <?php if($row['status']=='upcoming') echo 'selected'; ?>>Upcoming</option>
            <option value="live" <?php if($row['status']=='live') echo 'selected'; ?>>Live</option>
            <option value="past" <?php if($row['status']=='past') echo 'selected'; ?>>Past</option>
        </select><br><br>
        <label>
            <input type="checkbox" name="allow_volunteers" value="1" <?php if($row['allow_volunteers']) echo 'checked'; ?>> Allow Volunteers
        </label><br><br>
        <input type="submit" value="Update Event">
    </form>
    <br>
    <a href="events.php">Back to Events</a>
</body>
</html>
