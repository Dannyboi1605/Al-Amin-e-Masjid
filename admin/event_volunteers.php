<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include("../config/db.php");

if (!isset($_GET['event_id'])) {
    header("Location: events.php");
    exit();
}

$event_id = intval($_GET['event_id']);
$event = $conn->query("SELECT title FROM events WHERE id=$event_id")->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Event Volunteers</title>
      <?php include("includes/navbar.php"); ?>
</head>
<body>
    <h2>Volunteers for "<?php echo htmlspecialchars($event['title']); ?>"</h2>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Date Registered</th>
        </tr>
        <?php
        $result = $conn->query("SELECT * FROM event_volunteers WHERE event_id=$event_id ORDER BY date_registered DESC");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>".htmlspecialchars($row['name'])."</td>
                <td>".htmlspecialchars($row['email'])."</td>
                <td>".htmlspecialchars($row['phone'])."</td>
                <td>".$row['date_registered']."</td>
            </tr>";
        }
        ?>
    </table>
    <br>
    <a href="events.php">Back to Events</a>
</body>
</html>
