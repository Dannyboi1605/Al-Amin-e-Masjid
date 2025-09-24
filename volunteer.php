<?php
session_start();
include "config/db.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Volunteer</title>
</head>
<body>
    <h2>Volunteer for an Event</h2>

    <?php if (!isset($_SESSION['user_id'])): ?>
        <p>You must <a href="login.php">log in</a> to apply as a volunteer.</p>
    <?php else: ?>
        <?php
        // Fetch events that allow volunteers
        $today = date('Y-m-d H:i:s');
        $stmt = $conn->prepare("SELECT id, title, date 
                                FROM events 
                                WHERE allow_volunteers = 1 
                                  AND date >= ? 
                                ORDER BY date ASC");
        $stmt->bind_param("s", $today);
        $stmt->execute();
        $result = $stmt->get_result();
        ?>

        <?php if ($result->num_rows === 0): ?>
            <p>No events are currently accepting volunteers.</p>
        <?php else: ?>
            <form method="POST" action="volunteer_apply.php">
                <label for="event_id">Choose Event:</label><br>
                <select name="event_id" id="event_id" required>
                    <option value="">-- Select an event --</option>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <option value="<?= $row['id'] ?>">
                            <?= htmlspecialchars($row['title']) ?> (<?= $row['date'] ?>)
                        </option>
                    <?php endwhile; ?>
                </select><br><br>

                <label>Notes (optional):</label><br>
                <textarea name="notes" rows="3" cols="40"></textarea><br><br>

                <input type="submit" value="Apply as Volunteer">
            </form>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>
