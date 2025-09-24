<?php
session_start();

// Ensure only logged-in admins can access
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}
include("../config/db.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $conn->query("DELETE FROM events WHERE id=$id");
}
header("Location: events.php");
exit();
