<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<div style="text-align:right; margin: 10px 20px 0 0;">
<?php if (isset($_SESSION['user_id'])): ?>
    Assalammualaikum, <?php echo htmlspecialchars($_SESSION['user_name']); ?>
    <a href="logout.php" style="margin-left:10px;">Logout</a>
<?php else: ?>
    <a href="login.php"><button>Login</button></a>
<?php endif; ?>
</div>
