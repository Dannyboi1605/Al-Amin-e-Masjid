<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include("../config/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $date = $conn->real_escape_string($_POST['date']);
    $status = $conn->real_escape_string($_POST['status']);
    $allow_volunteers = isset($_POST['allow_volunteers']) ? 1 : 0;
    $conn->query("INSERT INTO events (title, description, date, status, allow_volunteers) VALUES ('$title', '$description', '$date', '$status', $allow_volunteers)");
    header("Location: events.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Event</title>
</head>
<body>
    <h2>Add New Event</h2>
    <form method="POST" action="">
        <label>Title:</label><br>
        <input type="text" name="title" required><br><br>
        <label>Description:</label><br>
        <textarea name="description" rows="5" cols="40" required></textarea><br><br>
        <label>Date:</label><br>
        <input type="datetime-local" name="date" required><br><br>
        <label>Status:</label><br>
        <select name="status" required>
            <option value="upcoming">Upcoming</option>
            <option value="live">Live</option>
            <option value="past">Past</option>
        </select><br><br>
        <label>
            <input type="checkbox" name="allow_volunteers" value="1"> Allow Volunteers
        </label><br><br>
        <input type="submit" value="Add Event">
    </form>
    <br>
    <a href="events.php">Back to Events</a>
</body>
</html>
