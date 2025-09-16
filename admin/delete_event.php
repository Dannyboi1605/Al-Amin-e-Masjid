<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include("../config/db.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $conn->query("DELETE FROM events WHERE id=$id");
}
header("Location: events.php");
exit();
