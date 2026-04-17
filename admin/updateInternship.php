<?php
// Backend logic remains exactly as provided
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}
require_once "./connection.php";

$internship_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$updateSuccess = false;
$updateError = false;

if ($internship_id > 0) {
    $query = "SELECT * FROM internship WHERE internship_id = $internship_id";
    $result = mysqli_query($db, $query);
    $internship = mysqli_fetch_assoc($result);
    if (!$internship) { $updateError = true; }
} else { $updateError = true; }

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$updateError) {
    $title = mysqli_real_escape_string($db, $_POST['title']);
    $description = mysqli_real_escape_string($db, $_POST['description']);
    $req_language = mysqli_real_escape_string($db, $_POST['req_language']);
    $price = floatval($_POST['price']);
    $update_query = "UPDATE internship SET title='$title', description='$description', req_language='$req_language', price=$price WHERE internship_id=$internship_id";
    if (mysqli_query($db, $update_query)) {
        $updateSuccess = true;
        $internship = ['title' => $title, 'description' => $description, 'req_language' => $req_language, 'price' => $price];
    } else { $updateError = true; }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Internship | Hero Admin</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
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
                <h2>Update Internship Listing</h2>
                <p class="text-muted small mb-0">Modifying Entry #<?= $internship_id ?></p>
            </div>
            <a href="admin_dashboard.php" class="btn-cancel">Cancel Changes</a>
        </div>

        <?php if ($updateSuccess): ?>
            <div class="alert alert-success border-0 rounded-3 shadow-sm mb-4">Internship data updated successfully.</div>
        <?php endif; ?>

        <?php if (!$updateError): ?>
        <form method="post">
            <div class="mb-4">
                <label class="form-label">Internship Title</label>
                <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($internship['title']); ?>" required>
            </div>
            <div class="mb-4">
                <label class="form-label">Role Description</label>
                <textarea name="description" class="form-control" rows="5" required><?= htmlspecialchars($internship['description']); ?></textarea>
            </div>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <label class="form-label">Required Language/Skill</label>
                    <input type="text" name="req_language" class="form-control" value="<?= htmlspecialchars($internship['req_language']); ?>" required>
                </div>
                <div class="col-md-6 mb-4">
                    <label class="form-label">Stipend/Price (INR)</label>
                    <input type="number" step="0.01" name="price" class="form-control" value="<?= htmlspecialchars($internship['price']); ?>" required>
                </div>
            </div>
            <button type="submit" class="btn-save">Confirm & Update</button>
        </form>
        <?php endif; ?>
    </div>
</body>
</html>