<?php

session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}
require_once "./connection.php";

$user_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$updateSuccess = false;
$updateError = false;

if ($user_id > 0) {
    $query = "SELECT * FROM user WHERE user_id = $user_id";
    $result = mysqli_query($db, $query);
    $user = mysqli_fetch_assoc($result);
    if (!$user) { $updateError = true; }
} else { $updateError = true; }

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$updateError) {
    $fname = mysqli_real_escape_string($db, $_POST['fname']);
    $lname = mysqli_real_escape_string($db, $_POST['lname']);
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $language1 = mysqli_real_escape_string($db, $_POST['language1']);
    $language2 = mysqli_real_escape_string($db, $_POST['language2']);
    $experience = mysqli_real_escape_string($db, $_POST['experience']);
    
    $update_query = "UPDATE user SET fname='$fname', lname='$lname', username='$username', email='$email', language1='$language1', language2='$language2', experience='$experience' WHERE user_id=$user_id";
    
    if (mysqli_query($db, $update_query)) {
        $updateSuccess = true;
        $user = ['fname' => $fname, 'lname' => $lname, 'username' => $username, 'email' => $email, 'language1' => $language1, 'language2' => $language2, 'experience' => $experience];
    } else { $updateError = true; }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Profile | Hero Admin</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #6366f1;
            --bg-light: #f4f7fe;
            --card-radius: 24px;
        }

        body {
            background-color: var(--bg-light);
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            padding: 40px 20px;
        }

        .settings-card {
            background: #ffffff;
            width: 100%;
            max-width: 700px;
            padding: 3rem;
            border-radius: var(--card-radius);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05);
            border: none;
        }

        .settings-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 2.5rem;
        }

        .settings-header h2 {
            font-size: 1.5rem;
            font-weight: 800;
            color: #1e293b;
            margin: 0;
        }

        .btn-close-custom {
            background: #f1f5f9;
            color: #64748b;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: 700;
            transition: 0.3s;
        }

        .btn-close-custom:hover {
            background: #e2e8f0;
            color: #1e293b;
        }

        .form-label {
            font-weight: 600;
            font-size: 0.85rem;
            color: #64748b;
            margin-bottom: 8px;
        }

        .form-control {
            padding: 12px 16px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            font-size: 0.95rem;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
            outline: none;
        }

        .btn-save {
            background: var(--primary);
            color: white;
            border: none;
            padding: 14px;
            border-radius: 12px;
            font-weight: 700;
            width: 100%;
            margin-top: 1.5rem;
            transition: 0.3s;
        }

        .btn-save:hover {
            background: #4f46e5;
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.3);
        }

        .alert-custom {
            border: none;
            border-radius: 12px;
            padding: 15px 20px;
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>

    <div class="settings-card">
        <div class="settings-header">
            <div>
                <h2>Edit User Account</h2>
                <p class="text-muted small mb-0">Modify the professional details for this user ID #<?= $user_id ?></p>
            </div>
            <a href="allUsers.php" class="btn-close-custom">Cancel</a>
        </div>

        <?php if ($updateSuccess): ?>
            <div class="alert alert-success alert-custom">Account successfully updated.</div>
        <?php elseif ($updateError && $_SERVER['REQUEST_METHOD'] === 'POST'): ?>
            <div class="alert alert-danger alert-custom">System error. Please verify the input data.</div>
        <?php endif; ?>

        <?php if (!$updateError || $updateSuccess): ?>
        <form method="post">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">First Name</label>
                    <input type="text" name="fname" class="form-control" value="<?= htmlspecialchars($user['fname']); ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Last Name</label>
                    <input type="text" name="lname" class="form-control" value="<?= htmlspecialchars($user['lname']); ?>" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($user['username']); ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']); ?>" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Primary Tech Skill</label>
                    <input type="text" name="language1" class="form-control" value="<?= htmlspecialchars($user['language1']); ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Secondary Tech Skill</label>
                    <input type="text" name="language2" class="form-control" value="<?= htmlspecialchars($user['language2']); ?>">
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Years of Experience</label>
                <input type="number" name="experience" class="form-control" value="<?= htmlspecialchars($user['experience']); ?>">
            </div>

            <button type="submit" class="btn-save">Save Changes</button>
        </form>
        <?php else: ?>
            <div class="text-center py-5">
                <h4 class="text-danger">User profile not found.</h4>
                <a href="allUsers.php" class="btn btn-secondary mt-3">Back to Directory</a>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>