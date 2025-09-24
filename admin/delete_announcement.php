<?php
session_start();
include("../config/db.php");

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM announcements WHERE id=$id");

header("Location: announcements.php");
exit();
