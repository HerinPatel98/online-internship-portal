<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}
require_once "./connection.php";

$job_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$updateSuccess = false;
$updateError = false;

if ($job_id > 0) {
    // Fetch job details
    $query = "SELECT * FROM job WHERE job_id = $job_id";
    $result = mysqli_query($db, $query);
    $job = mysqli_fetch_assoc($result);
    if (!$job) {
        $updateError = true;
    }
} else {
    $updateError = true;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$updateError) {
    $title = mysqli_real_escape_string($db, $_POST['title']);
    $description = mysqli_real_escape_string($db, $_POST['description']);
    $position = mysqli_real_escape_string($db, $_POST['position']);
    $req_exp = mysqli_real_escape_string($db, $_POST['req_exp']);
    $update_query = "UPDATE job SET title='$title', description='$description', position='$position', req_exp='$req_exp' WHERE job_id=$job_id";
    if (mysqli_query($db, $update_query)) {
        $updateSuccess = true;
        // Refresh job data
        $job = [
            'title' => $title,
            'description' => $description,
            'position' => $position,
            'req_exp' => $req_exp
        ];
    } else {
        $updateError = true;
    }
}
?>
<!DOCTYPE html>
<html class="h-100">
<head>
    <title>Update Job</title>
    <link rel="stylesheet" href="../styles/admin_dashboard.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/allUpdatePage.css">
    <style>
        :root {
            --primary: #6366f1;
            --bg-light: #f4f7fe;
            --card-radius: 24px;
        }

        body {
            background-color: var(--bg-light);
            font-family: 'Inter', system-ui, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            padding: 40px 20px;
        }

        .editor-card {
            background: #ffffff;
            width: 100%;
            max-width: 750px;
            padding: 3rem;
            border-radius: var(--card-radius);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05);
        }

        .editor-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 2.5rem;
            border-bottom: 1px solid #f1f5f9;
            padding-bottom: 20px;
        }

        .editor-header h2 { font-size: 1.5rem; font-weight: 800; color: #1e293b; }

        .btn-cancel {
            background: #f1f5f9;
            color: #64748b;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: 700;
        }

        .form-label { font-weight: 600; font-size: 0.85rem; color: #64748b; margin-bottom: 8px; }

        .form-control {
            padding: 12px 16px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
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
        }
    </style>
</head>
<body>
   <div class="editor-card">
    <div class="editor-header">
        <div>
            <h2>Update Job Opening</h2>
            <p class="text-muted small mb-0">Modifying Entry #<?= $job_id ?></p>
        </div>
        <a href="admin_dashboard.php" class="btn-cancel">Cancel</a>
    </div>

    <?php if ($updateSuccess): ?>
        <div class="alert alert-success border-0 rounded-3 shadow-sm mb-4">Job opening updated successfully.</div>
    <?php endif; ?>

    <?php if (!$updateError): ?>
    <form method="post">
        <div class="mb-4">
            <label class="form-label">Position Title</label>
            <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($job['title']); ?>" required>
        </div>
        <div class="mb-4">
            <label class="form-label">Full Job Description</label>
            <textarea name="description" class="form-control" rows="5" required><?= htmlspecialchars($job['description']); ?></textarea>
        </div>
        <div class="row">
            <div class="col-md-6 mb-4">
                <label class="form-label">Total Openings (Position)</label>
                <input type="number" name="position" class="form-control" value="<?= htmlspecialchars($job['position']); ?>" required>
            </div>
            <div class="col-md-6 mb-4">
                <label class="form-label">Required Experience (Years)</label>
                <input type="number" name="req_exp" class="form-control" value="<?= htmlspecialchars($job['req_exp']); ?>" required>
            </div>
        </div>
        <button type="submit" class="btn-save">Save Job Details</button>
    </form>
    <?php endif; ?>
</div>
</body>
</html>