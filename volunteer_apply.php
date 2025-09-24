<?php
session_start();
include "config/db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = intval($_SESSION['user_id']);
$event_id = intval($_POST['event_id'] ?? 0);
$notes = trim($_POST['notes'] ?? '');

// Validate event_id
if ($event_id <= 0) {
    die("Invalid event selected.");
}

// Ensure event allows volunteers
$stmt = $conn->prepare("SELECT id FROM events WHERE id=? AND allow_volunteers=1");
$stmt->bind_param("i", $event_id);
$stmt->execute();
$res = $stmt->get_result();
if ($res->num_rows === 0) {
    die("This event is not open for volunteers.");
}

// Prevent duplicate application
$stmt = $conn->prepare("SELECT id FROM volunteers WHERE user_id=? AND event_id=?");
$stmt->bind_param("ii", $user_id, $event_id);
$stmt->execute();
if ($stmt->get_result()->num_rows > 0) {
    die("You have already applied for this event.");
}

// Insert application
$stmt = $conn->prepare("INSERT INTO volunteers (user_id, event_id, notes) VALUES (?, ?, ?)");
$stmt->bind_param("iis", $user_id, $event_id, $notes);

if ($stmt->execute()) {
    echo "Application submitted successfully! <a href='volunteer.php'>Go back</a>";
} else {
    echo "Error submitting application: " . $stmt->error;
}
