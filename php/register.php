<?php
require_once("./connection.php");
session_start();

$registerSuccess = false;
$registerError = false;
$errors = [];

// Generate CSRF token if not exists
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if (isset($_POST['submit'])) {
    // CSRF Token Validation
    if (empty($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $registerError = true;
        $errors[] = "Invalid request. Please try again.";
    } else {
        $firstname = trim($_POST["firstname"] ?? '');
        $lastname = trim($_POST["lastname"] ?? '');
        $email = trim($_POST["email"] ?? '');
        $username = trim($_POST["username"] ?? '');
        $password = $_POST["password"] ?? '';
        $language1 = trim($_POST["language1"] ?? '');
        $language2 = trim($_POST["language2"] ?? '');
        $experience = trim($_POST["experience"] ?? '');
        
        // Validation
        if (empty($firstname) || empty($lastname) || empty($email) ||
            empty($username) || empty($password) || empty($language1) ||
            empty($language2) || empty($experience)) {
            $registerError = true;
            $errors[] = "All fields are required.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $registerError = true;
            $errors[] = "Invalid email address.";
        } elseif (strlen($password) < 8) {
            $registerError = true;
            $errors[] = "Password must be at least 8 characters.";
        } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password)) {
            $registerError = true;
            $errors[] = "Password must contain uppercase, lowercase, number, and special character (@$!%*?&).";
        } else {
            // Hash the password using bcrypt (cost 12)
            require_once("./security_helper.php");
            $hashedPassword = SecurityHelper::hashPassword($password, PASSWORD_BCRYPT, ['cost' => 12]);
            
            // Prepared Statement with mysqli - Prevents SQL Injection
            $stmt = $db->prepare("INSERT INTO user (fname, lname, username, password, email, language1, language2, experience) 
                                 VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            
            if ($stmt) {
                $stmt->bind_param("ssssssss", $firstname, $lastname, $username, $hashedPassword, $email, $language1, $language2, $experience);
                
                if ($stmt->execute()) {
                    $registerSuccess = true;
                } else {
                    if (strpos($stmt->error, 'Duplicate entry') !== false) {
                        $registerError = true;
                        $errors[] = "Username or email already exists.";
                    } else {
                        $registerError = true;
                        $errors[] = "Registration failed. Please try again.";
                    }
                }
                $stmt->close();
            } else {
                $registerError = true;
                $errors[] = "Database error. Please try again later.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Hero Intern | Registration</title>
    <link rel="stylesheet" href="../styles/register.css">
</head>

<body>
    <div class="register-container">
        <div class="rocket">🚀</div>
        <h2>Create Your Account</h2>
        <p>Join the Hero Intern Community</p>
        <form method="POST">
            <div class="form-row">
                <input type="text" name="firstname" placeholder="First Name" autofocus required>
                <input type="text" name="lastname" placeholder="Last Name" required>
            </div>
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password (8+ chars: uppercase, lowercase, number, special)" required>
            <div class="form-row">
                <input type="text" name="language1" placeholder="Language 1" required>
                <input type="text" name="language2" placeholder="Language 2" required>
            </div>
            <input type="text" name="experience" placeholder="Experience" required>
            <!-- CSRF Token -->
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>" />
            <button type="submit" name="submit" value="register">REGISTER</button>
        </form>

        <?php if ($registerSuccess): ?>
            <div class="message success">✅ Registration successful! You can now <a href="./login.php">login</a>.</div>
        <?php elseif ($registerError): ?>
            <div class="message error">
                <?php foreach ($errors as $error): ?>
                    <div>❌ <?= htmlspecialchars($error) ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>