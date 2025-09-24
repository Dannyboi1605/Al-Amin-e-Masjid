<?php
session_start();
include("../config/db.php");

// Ensure only admins can access
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

$id = intval($_POST['id'] ?? 0);
$action = $_POST['action'] ?? '';

if ($id > 0 && in_array($action, ['approve','reject'])) {
    $status = ($action === 'approve') ? 'approved' : 'rejected';
    $stmt = $conn->prepare("UPDATE volunteers SET status=? WHERE id=?");
    $stmt->bind_param("si", $status, $id);
    $stmt->execute();
}

header("Location: volunteers.php");
exit();
