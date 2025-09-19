<?php
ob_start();
session_start();
include("config/db.php");

$error = "";
$success = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate passwords
    if ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        // Check if email already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = "Email is already registered.";
        } else {
            // Hash the password before inserting
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'user')");
            $stmt->bind_param("sss", $name, $email, $hashed_password);

            if ($stmt->execute()) {
                header("Location: login.php?msg=Registration successful. Please login.");
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }
        }

        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <style>
    .password-toggle {
        position: relative;
        width: 250px;
    }
    .password-toggle input {
        width: 100%;
        padding-right: 36px; /* space for the icon */
    }
    .eye-icon {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        width: 22px;
        height: 22px;
    }
    </style>
</head>
<body>
    <?php include("includes/navbar.php"); ?>

    <h2>Register</h2>

    <?php if ($error): ?>
        <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label>Name:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" id="password" required>
        <label style="display:block; margin-top:8px;">
            <input type="checkbox" onclick="togglePassword('password')"> Show Password
        </label>
        <br><br>

        <label>Confirm Password:</label><br>
        <input type="password" name="confirm_password" id="confirm_password" required>
        <label style="display:block; margin-top:8px;">
            <input type="checkbox" onclick="togglePassword('confirm_password')"> Show Password
        </label>
        <br><br>

        <input type="submit" value="Register">
    </form>

    <br>
    <a href="login.php">Already have an account? Login</a>

    <script>
    function togglePassword(id) {
        var pwd = document.getElementById(id);
        pwd.type = pwd.type === "password" ? "text" : "password";
    }
    </script>
</body>
</html>
<?php ob_end_flush(); ?>
 
    </script>
</body>
</html>
<?php ob_end_flush(); ?>
