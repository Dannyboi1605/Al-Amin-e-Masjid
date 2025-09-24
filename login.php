<?php
ob_start(); // Start output buffering
session_start();
include("config/db.php");

$error = "";

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Prepare statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Verify password
        if (password_verify($password, $row['password'])) {
            session_regenerate_id(true); // Prevent session fixation
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['role'] = $row['role'];


            // Redirect based on role
            if ($row['role'] === 'admin') {
                header("Location: admin/dashboard.php");
            } else {
                header("Location: index.php");
            }
            exit();
        } else {
            $error = "Invalid email or password.";
        }
    } else {
        $error = "Invalid email or password.";
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
    body {
        background: #f7f7f7;
        font-family: Arial, sans-serif;
    }
    .login-container {
        max-width: 350px;
        margin: 60px auto;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        padding: 32px 24px 24px 24px;
    }
    .login-container h2 {
        text-align: center;
        margin-bottom: 24px;
        color: #007bff;
    }
    .login-container label {
        font-weight: bold;
        margin-bottom: 6px;
        display: block;
    }
    .login-container input[type="email"],
    .login-container input[type="password"] {
        width: 100%;
        padding: 10px 36px 10px 10px;
        margin-bottom: 18px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 15px;
        box-sizing: border-box;
    }
    .login-container input[type="submit"] {
        width: 100%;
        background: #007bff;
        color: #fff;
        border: none;
        padding: 10px;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        margin-top: 8px;
        transition: background 0.2s;
    }
    .login-container input[type="submit"]:hover {
        background: #0056b3;
    }
    .login-container .register-link {
        text-align: center;
        margin-top: 18px;
    }
    .login-container .register-link a {
        color: #007bff;
        text-decoration: none;
    }
    .login-container .register-link a:hover {
        text-decoration: underline;
    }
    .error-msg {
        color: #d9534f;
        text-align: center;
        margin-bottom: 12px;
    }
    </style>
</head>
<body>


    <div class="login-container">
        <h2>Login</h2>

        <?php if ($error): ?>
            <div class="error-msg"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <?php if (isset($_GET['msg'])): ?>
            <div class="error-msg"><?php echo htmlspecialchars($_GET['msg']); ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <label>Email:</label>
            <input type="email" name="email" required>

            <label>Password:</label>
            <input type="password" name="password" id="password" required>
            <label style="display:block; margin-top:8px;">
                <input type="checkbox" onclick="togglePassword()"> Show Password
            </label>
            <br><br>

            <input type="submit" value="Login">
        </form>
        <div class="register-link">
            <a href="register.php">Don't have an account? Register</a>
        </div>
    </div>
    <script>
    function togglePassword() {
        var pwd = document.getElementById('password');
        pwd.type = pwd.type === "password" ? "text" : "password";
    }
    </script>
</body>
</html>
<?php ob_end_flush(); ?>

        
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        window.togglePassword = function() {
            var pwd = document.getElementById('password');
            var icon = document.getElementById('eyeIcon');
            if (pwd.type === "password") {
                pwd.type = "text";
                icon.style.fill = "#007bff";
            } else {
                pwd.type = "password";
                icon.style.fill = "gray";
            }
        }
    });
    </script>
</body>
</html>
<?php ob_end_flush(); ?>
