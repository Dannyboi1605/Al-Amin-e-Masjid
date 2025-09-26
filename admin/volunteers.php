<?php
session_start();
include("../config/db.php");

// Ensure only admins can access
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

// Fetch volunteer applications
$sql = "
    SELECT v.id, v.applied_at, v.status, v.notes,
           u.name AS user_name, u.email AS user_email,
           e.title AS event_title, e.date AS event_date
    FROM volunteers v
    JOIN users u ON v.user_id = u.id
    JOIN events e ON v.event_id = e.id
    ORDER BY v.applied_at DESC
";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Volunteer Applications</title>

      <?php include("includes/navbar.php"); ?>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f2f2f2; }
        form { display: inline; }
    </style>
</head>
<body>
    <h2>Volunteer Applications</h2>

    <table>
        <tr>
            <th>Event</th>
            <th>Volunteer</th>
            <th>Email</th>
            <th>Applied At</th>
            <th>Status</th>
            <th>Notes</th>
            <th>Action</th>
        </tr>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['event_title']) ?> (<?= $row['event_date'] ?>)</td>
                    <td><?= htmlspecialchars($row['user_name']) ?></td>
                    <td><?= htmlspecialchars($row['user_email']) ?></td>
                    <td><?= $row['applied_at'] ?></td>
                    <td><?= ucfirst($row['status']) ?></td>
                    <td><?= nl2br(htmlspecialchars($row['notes'])) ?></td>
                    <td>
                        <?php if ($row['status'] !== 'approved'): ?>
                            <form method="post" action="volunteer_action.php">
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                <input type="hidden" name="action" value="approve">
                                <button type="submit">Approve</button>
                            </form>
                        <?php endif; ?>

                        <?php if ($row['status'] !== 'rejected'): ?>
                            <form method="post" action="volunteer_action.php">
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                <input type="hidden" name="action" value="reject">
                                <button type="submit">Reject</button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="7">No volunteer applications found.</td></tr>
        <?php endif; ?>
    </table>
</body>
</html>
