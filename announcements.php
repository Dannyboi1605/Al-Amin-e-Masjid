<?php
include("config/db.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Announcements</title>
</head>
<body>
    <h2>Latest Announcements</h2>
    <?php
    $result = $conn->query("SELECT * FROM announcements ORDER BY date DESC");
    while ($row = $result->fetch_assoc()) {
        echo "<div style='border:1px solid #ccc; padding:10px; margin-bottom:15px;'>
            <h3>".htmlspecialchars($row['title'])."</h3>
            <small>".$row['date']."</small>
            <p>".nl2br(htmlspecialchars($row['content']))."</p>
        </div>";
    }
    ?>
</body>
</html>
