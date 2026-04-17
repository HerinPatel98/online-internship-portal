<!-- PHP code for insert course (admin) -->
<?php
require_once "./connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs to prevent SQL Injection
    $title = mysqli_real_escape_string($db, $_POST['title']);
    $description = mysqli_real_escape_string($db, $_POST['description']);
    $language = mysqli_real_escape_string($db, $_POST['language']);
    $duration = mysqli_real_escape_string($db, $_POST['duration']);
    $price = mysqli_real_escape_string($db, $_POST['price']);

    $insert_query = "INSERT INTO course (title, description, language, duration, price) 
                     VALUES ('$title', '$description', '$language', '$duration', '$price')";

    if (mysqli_query($db, $insert_query)) {
        $success_message = "Course added successfully!";
    } else {
        $error_message = "Database Error: " . mysqli_error($db);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Course | Hero Admin</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #6366f1;
            --bg-light: #f4f7fe;
        }

        body {
            background-color: var(--bg-light);
            font-family: 'Inter', system-ui, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }

        .form-card {
            background: #ffffff;
            width: 100%;
            max-width: 600px;
            padding: 2.5rem;
            border-radius: 24px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05);
            border: none;
        }

        .form-header h2 {
            font-size: 1.5rem;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 0.5rem;
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
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
            outline: none;
        }

        .btn-submit {
            background: #6366f1;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 12px;
            font-weight: 700;
            width: 100%;
            margin-top: 1rem;
            transition: 0.3s;
        }

        .btn-submit:hover {
            background: #4f46e5;
            transform: translateY(-1px);
        }

        .btn-cancel {
            text-decoration: none;
            color: #64748b;
            font-size: 0.9rem;
            font-weight: 600;
            display: inline-block;
            margin-top: 1.5rem;
        }
    </style>
</head>
<body>

    <div class="form-card">
        <div class="form-header mb-4">
            <h2>Add New Course</h2>
            <p class="text-muted small">Fill in the details to list a new educational program.</p>
        </div>

        <?php if (isset($success_message)): ?>
            <div class="alert alert-success border-0 shadow-sm rounded-3"><?php echo $success_message; ?></div>
        <?php endif; ?>

        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger border-0 shadow-sm rounded-3"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Course Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="e.g. Advanced Web Development" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Course Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" placeholder="What will students learn?" required></textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="language" class="form-label">Teaching Language</label>
                    <input type="text" class="form-control" id="language" name="language" placeholder="e.g. English, Hindi" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="duration" class="form-label">Duration</label>
                    <input type="text" class="form-control" id="duration" name="duration" placeholder="e.g. 3 Months" required>
                </div>
            </div>

            <div class="mb-4">
                <label for="price" class="form-label">Price (INR)</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0">₹</span>
                    <input type="number" class="form-control border-start-0" id="price" name="price" placeholder="0.00" required>
                </div>
            </div>

            <button type="submit" class="btn-submit shadow-sm">Confirm & Add Course</button>
            
            <div class="text-center">
                <a href="admin_dashboard.php" class="btn-cancel">← Return to Dashboard</a>
            </div>
        </form>
    </div>

</body>
</html>