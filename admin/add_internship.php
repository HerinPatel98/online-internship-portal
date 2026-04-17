<?php
require_once "./connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize user inputs for security
    $title = mysqli_real_escape_string($db, $_POST['title']);
    $description = mysqli_real_escape_string($db, $_POST['description']);
    $req_language = mysqli_real_escape_string($db, $_POST['req_language']);
    $price = mysqli_real_escape_string($db, $_POST['price']);

    $insert_query = "INSERT INTO internship (title, description, req_language, price) 
                     VALUES ('$title', '$description', '$req_language', '$price')";

    if (mysqli_query($db, $insert_query)) {
        $success_message = "Internship opportunity added successfully!";
    } else {
        $error_message = "System Error: " . mysqli_error($db);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Internship | Hero Admin</title>
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
            padding: 20px;
        }

        .form-card {
            background: #ffffff;
            width: 100%;
            max-width: 650px;
            padding: 3rem;
            border-radius: 24px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .form-header h2 {
            font-size: 1.6rem;
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
            padding: 14px;
            border-radius: 12px;
            font-weight: 700;
            width: 100%;
            margin-top: 1.5rem;
            transition: 0.3s;
        }

        .btn-submit:hover {
            background: #4f46e5;
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.3);
        }

        .btn-cancel {
            text-decoration: none;
            color: #64748b;
            font-size: 0.9rem;
            font-weight: 600;
            display: inline-block;
            margin-top: 2rem;
        }
    </style>
</head>
<body>

    <div class="form-card">
        <div class="form-header text-center mb-5">
            <h2>Post New Internship</h2>
            <p class="text-muted">Create a new professional opportunity for your students.</p>
        </div>

        <?php if (isset($success_message)): ?>
            <div class="alert alert-success border-0 shadow-sm rounded-3 mb-4"><?php echo $success_message; ?></div>
        <?php endif; ?>

        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger border-0 shadow-sm rounded-3 mb-4"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-4">
                <label for="title" class="form-label">Internship Role Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="e.g. Software Engineering Intern" required>
            </div>

            <div class="mb-4">
                <label for="description" class="form-label">Role Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" placeholder="Detail the responsibilities and project scope..." required></textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <label for="req_language" class="form-label">Required Skills/Language</label>
                    <input type="text" class="form-control" id="req_language" name="req_language" placeholder="e.g. Python, Java, PHP" required>
                </div>
                <div class="col-md-6 mb-4">
                    <label for="price" class="form-label">Stipend/Price (INR)</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0">₹</span>
                        <input type="number" class="form-control border-start-0" id="price" name="price" placeholder="25000" required>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn-submit">Publish Internship</button>
            
            <div class="text-center">
                <a href="admin_dashboard.php" class="btn-cancel">← Back to Admin Console</a>
            </div>
        </form>
    </div>

</body>
</html>