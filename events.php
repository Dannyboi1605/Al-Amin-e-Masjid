<?php
include("config/db.php");

function show_events($conn, $status, $heading) {
    $result = $conn->query("SELECT * FROM events WHERE status='$status' ORDER BY date DESC");
    if ($result->num_rows > 0) {
        echo "<h3>$heading</h3>";
        while ($row = $result->fetch_assoc()) {
            echo "<div style='border:1px solid #ccc; padding:10px; margin-bottom:15px;'>
                <h4>".htmlspecialchars($row['title'])."</h4>
                <small>".date('d M Y H:i', strtotime($row['date']))."</small>
                <p>".nl2br(htmlspecialchars($row['description']))."</p>";
            if ($row['allow_volunteers']) {
                echo "<a href='register_volunteer.php?event_id=".$row['id']."'><button>Register as Volunteer</button></a>";
            }
            echo "</div>";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Events</title>
</head>
<body>
    <h2>Events</h2>
    <?php
    show_events($conn, 'upcoming', 'Upcoming Events');
    show_events($conn, 'live', 'Live Events');
    show_events($conn, 'past', 'Past Events');
    ?>
</body>
</html>
