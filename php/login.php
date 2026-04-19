<?php
require_once("./connection.php");
require_once("./security_helper.php"); // Load your helper
session_start();

$loginSuccess = false;
$loginError = false;
$errorMsg = "";

// Generate CSRF token using your Helper
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = SecurityHelper::generateCsrfToken();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // CSRF Token Validation
    if (empty($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $loginError = true;
        $errorMsg = "Invalid request. Please try again.";
        SecurityHelper::logSecurityEvent("Failed CSRF attempt from IP: " . $_SERVER['REMOTE_ADDR']);
    } else {
        // Use your Helper for input validation
        $username = SecurityHelper::validateInput(trim($_POST["username"] ?? ''));
        $password = $_POST["password"] ?? '';
        
        if (empty($username) || empty($password)) {
            $loginError = true;
            $errorMsg = "Username and password are required.";
        } else {
            // Prepared Statement to prevent SQL Injection
            $stmt = $db->prepare("SELECT user_id, username, password FROM user WHERE username = ? LIMIT 1");
            
            if ($stmt) {
                $stmt->bind_param("s", $username);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                
                // Verify password against the hash in DB
                if ($row && password_verify($password, $row['password'])) {
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['user_id'] = $row['user_id']; // Fixed: Use user_id from query
                    $loginSuccess = true;
                } else {
                    $loginError = true;
                    $errorMsg = "Invalid username or password.";
                    SecurityHelper::logSecurityEvent("Failed login attempt for user: " . $username);
                }
                $stmt->close();
            } else {
                $loginError = true;
                $errorMsg = "Database error.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Hero Intern | Login</title>
    <link rel="stylesheet" href="../styles/login.css">
</head>

<body>
    <div class="login-container">
        <div class="rocket">🚀</div>
        <h2>Login to Hero Intern</h2>
        <p>Access your internship portal or <a href="./" style="color: blue; cursor: pointer;">Go Back</a></p>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" autocomplete="username" required />
            <input type="password" name="password" placeholder="Password" autocomplete="current-password" required />
            <!-- CSRF Token -->
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>" />
            <button type="submit" id="login-btn">LOGIN</button>
        </form>
        <?php if ($loginSuccess): ?>
            <script>
                const lgbtn = document.querySelector("#login-btn");
                lgbtn.classList.add("login-btn");
            </script>
            <div class="message success">✅ Login successful! Welcome, <b><?= htmlspecialchars($username) ?></b>.
            <br>
            <a href="./dashboard.php" class="db-link"> Go to Dashboard </a>
            </div>
        <?php elseif ($loginError == true): ?>
            <div class="message error">❌ <?= htmlspecialchars($errorMsg) ?></div>
        <?php endif; ?>
    </div>
</body>

</html>