<?php
include("config/db.php");

if (!isset($_GET['event_id'])) {
    echo "Invalid event.";
    exit();
}

$event_id = intval($_GET['event_id']);
$event = $conn->query("SELECT title FROM events WHERE id=$event_id")->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $conn->query("INSERT INTO event_volunteers (event_id, name, email, phone) VALUES ($event_id, '$name', '$email', '$phone')");
    echo "<h3>Thank you for registering as a volunteer for ".htmlspecialchars($event['title']).".</h3>";
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register as Volunteer</title>
</head>
<body>
    <h2>Register as Volunteer for "<?php echo htmlspecialchars($event['title']); ?>"</h2>
    <form method="POST" action="">
        <label>Name:</label><br>
        <input type="text" name="name" required><br><br>
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>
        <label>Phone:</label><br>
        <input type="text" name="phone" required><br><br>
        <input type="submit" value="Register">
    </form>
    <br>
    <a href="events.php">Back to Events</a>
</body>
</html>
