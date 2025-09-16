<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include("../config/db.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Events</title>
</head>
<body>
    <h2>Events</h2>
    <a href="add_event.php">Add New Event</a>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Title</th>
            <th>Date</th>
            <th>Status</th>
            <th>Volunteer Option</th>
            <th>Actions</th>
        </tr>
        <?php
        $result = $conn->query("SELECT * FROM events ORDER BY date DESC");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>".htmlspecialchars($row['title'])."</td>
                <td>".$row['date']."</td>
                <td>".$row['status']."</td>
                <td>".($row['allow_volunteers'] ? 'Enabled' : 'Disabled')."</td>
                <td>
                    <a href='edit_event.php?id=".$row['id']."'>Edit</a> |
                    <a href='delete_event.php?id=".$row['id']."' onclick=\"return confirm('Delete this event?');\">Delete</a> |
                    <a href='event_volunteers.php?event_id=".$row['id']."'>View Volunteers</a>
                </td>
            </tr>";
        }
        ?>
    </table>
    <br>
    <a href="dashboard.php">Back to Dashboard</a>
</body>
</html>
