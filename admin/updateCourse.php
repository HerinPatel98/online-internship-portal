<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}
require_once "./connection.php";

$course_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$updateSuccess = false;
$updateError = false;

if ($course_id > 0) {
    $query = "SELECT * FROM course WHERE course_id = $course_id";
    $result = mysqli_query($db, $query);
    $course = mysqli_fetch_assoc($result);
    if (!$course) { $updateError = true; }
} else { $updateError = true; }

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$updateError) {
    $title = mysqli_real_escape_string($db, $_POST['title']);
    $description = mysqli_real_escape_string($db, $_POST['description']);
    $language = mysqli_real_escape_string($db, $_POST['language']);
    $duration = mysqli_real_escape_string($db, $_POST['duration']);
    $price = floatval($_POST['price']);
    
    $update_query = "UPDATE course SET title='$title', description='$description', language='$language', duration='$duration', price=$price WHERE course_id=$course_id";
    
    if (mysqli_query($db, $update_query)) {
        $updateSuccess = true;
        $course = ['title' => $title, 'description' => $description, 'language' => $language, 'duration' => $duration, 'price' => $price];
    } else { $updateError = true; }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Course | Hero Admin</title>
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

        .btn-cancel-custom {
            background: #f1f5f9;
            color: #64748b;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: 700;
            transition: 0.3s;
        }

        .btn-cancel-custom:hover {
            background: #fee2e2;
            color: #ef4444;
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

        .btn-update {
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

        .btn-update:hover {
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
                <h2>Update Course Details</h2>
                <p class="text-muted small mb-0">Modifying Course ID #<?= $course_id ?></p>
            </div>
            <a href="admin_dashboard.php" class="btn-cancel-custom">Cancel</a>
        </div>

        <?php if ($updateSuccess): ?>
            <div class="alert alert-success alert-custom">Course updated successfully.</div>
        <?php elseif ($updateError && $_SERVER['REQUEST_METHOD'] === 'POST'): ?>
            <div class="alert alert-danger alert-custom">Failed to update course. Please check your data.</div>
        <?php endif; ?>

        <?php if (!$updateError || $updateSuccess): ?>
        <form method="post">
            <div class="mb-3">
                <label class="form-label">Course Title</label>
                <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($course['title']); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="4" required><?= htmlspecialchars($course['description']); ?></textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Instruction Language</label>
                    <input type="text" name="language" class="form-control" value="<?= htmlspecialchars($course['language']); ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Duration</label>
                    <input type="text" name="duration" class="form-control" value="<?= htmlspecialchars($course['duration']); ?>" required>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Course Fee (INR)</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0">₹</span>
                    <input type="number" step="0.01" name="price" class="form-control border-start-0" value="<?= htmlspecialchars($course['price']); ?>" required>
                </div>
            </div>

            <button type="submit" class="btn-update">Save Course Changes</button>
        </form>
        <?php else: ?>
            <div class="text-center py-5">
                <h4 class="text-danger">Course not found.</h4>
                <a href="admin_dashboard.php" class="btn btn-secondary mt-3">Back to Dashboard</a>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>