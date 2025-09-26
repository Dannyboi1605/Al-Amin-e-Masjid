<?php
session_start();


// Ensure only logged-in admins can access
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}
include("../config/db.php");

if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $conn->query("DELETE FROM users WHERE id=$delete_id");
    header("Location: users.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Users</title>
      <?php include("includes/navbar.php"); ?>
</head>
<body>
    <h2>Registered Users</h2>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Date Registered</th>
            <th>Actions</th>
        </tr>
        <?php
        $result = $conn->query("SELECT * FROM users ORDER BY date_registered DESC");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>".$row['id']."</td>
                <td>".htmlspecialchars($row['name'])."</td>
                <td>".htmlspecialchars($row['email'])."</td>
                <td>".$row['date_registered']."</td>
                <td>
                    <a href='users.php?delete_id=".$row['id']."' onclick=\"return confirm('Delete this user?');\">Delete</a>
                </td>
            </tr>";
        }
        ?>
    </table>
    <br>
    <a href="dashboard.php">Back to Dashboard</a>
</body>
</html>
