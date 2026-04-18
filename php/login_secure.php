<?php
session_start();

// Database connection
require 'db_connection.php';

// Function to generate CSRF token
function generateCsrfToken() {
    return bin2hex(random_bytes(32));
}

// Setting CSRF token in session
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = generateCsrfToken();
}

// Rate limiting
$ip = $_SERVER['REMOTE_ADDR'];
$rateLimitKey = "login_attempts_" . $ip;
$attempts = isset($_SESSION[$rateLimitKey]) ? $_SESSION[$rateLimitKey] : 0;

if ($attempts >= 5) {
    die('Too many login attempts. Please try again later.');
}

// Handling POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $csrfToken = $_POST['csrf_token'];

    // CSRF protection
    if (!hash_equals($_SESSION['csrf_token'], $csrfToken)) {
        die('Invalid CSRF token');
    }

    // Prepare SQL statement
    $stmt = $pdo->prepare('SELECT password_hash FROM users WHERE username = :username');
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $hashedPassword = $stmt->fetchColumn();

    // Password verification
    if ($hashedPassword && password_verify($password, $hashedPassword)) {
        // Password is correct
        $_SESSION['username'] = $username;
        echo 'Login successful!';
        exit;
    } else {
        // Invalid credentials
        $_SESSION[$rateLimitKey] = $attempts + 1;
        echo 'Invalid username or password.';
    }
}
?>