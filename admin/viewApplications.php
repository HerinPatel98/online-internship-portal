<?php

session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}
require_once "./connection.php";

$user_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($user_id <= 0) {
    echo "<div style='color:red;'>Invalid user ID.</div>";
    exit();
}

$user_query = "SELECT user_id, fname, lname, username, email, language1, language2, experience FROM user WHERE user_id = $user_id";
$user_result = mysqli_query($db, $user_query);
$user = mysqli_fetch_assoc($user_result);

if (!$user) {
    echo "<div style='color:red;'>User not found.</div>";
    exit();
}

// Fetch user details
$user_query = "SELECT user_id, fname, lname, username, email, language1, language2, experience FROM user WHERE user_id = $user_id";

$user_result = mysqli_query($db, $user_query);
$user = mysqli_fetch_assoc($user_result);

if (!$user) {
    echo "<div style='color:red;'>User not found.</div>";
    exit();
}

// Remove application if requested
$remove_message = '';
if (isset($_GET['remove_type']) && isset($_GET['remove_id'])) {
    $remove_type = $_GET['remove_type'];
    $remove_id = intval($_GET['remove_id']);
    $success = false;
    if ($remove_type === 'course') {
        $delete_sql = "DELETE FROM user_course WHERE id = $remove_id AND user_id = $user_id";
    } elseif ($remove_type === 'internship') {
        $delete_sql = "DELETE FROM user_internship WHERE id = $remove_id AND user_id = $user_id";
    } elseif ($remove_type === 'job') {
        $delete_sql = "DELETE FROM user_job WHERE id = $remove_id AND user_id = $user_id";
    } else {
        $delete_sql = '';
    }
    if ($delete_sql) {
        $success = mysqli_query($db, $delete_sql);
    }
    $msg = $success ? 'Application removed successfully.' : 'Failed to remove application.';
    header("Location: viewApplications.php?id=$user_id&msg=" . urlencode($msg) . "&msgtype=" . ($success ? 'success' : 'danger'));
    exit();
}

// Fetch all course applications
$course_apps = [];
$sql = "SELECT uc.id, 'course' AS type, c.title, c.language, c.price as amount, uc.application_date, NULL as req_exp
        FROM user_course uc 
        JOIN course c 
        ON uc.course_id = c.course_id 
        WHERE uc.user_id = $user_id";

$res = mysqli_query($db, $sql);
while ($row = mysqli_fetch_assoc($res)) {
    $course_apps[] = $row;
}

// Fetch all internship applications
$internship_apps = [];
$sql = "SELECT ui.id, 'internship' AS type, i.title, i.req_language AS language, i.price as amount, ui.application_date, NULL as req_exp
        FROM user_internship ui
        JOIN internship i
        ON ui.internship_id = i.internship_id 
        WHERE ui.user_id = $user_id";

$res = mysqli_query($db, $sql);
while ($row = mysqli_fetch_assoc($res)) {
    $internship_apps[] = $row;
}

// Fetch all job applications
$job_apps = [];
$sql = "SELECT uj.id, 'job' AS type, j.title, NULL as language, j.req_exp, uj.application_date, NULL as amount
        FROM user_job uj 
        JOIN job j 
        ON uj.job_id = j.job_id 
        WHERE uj.user_id = $user_id";
$res = mysqli_query($db, $sql);
while ($row = mysqli_fetch_assoc($res)) {
    // For jobs, use req_exp as 'Experience Required' and leave language blank
    $row['price'] = $row['req_exp'];
    $row['language'] = '';
    $job_apps[] = $row;
}

// Merge all applications
$all_apps = array_merge($course_apps, $internship_apps, $job_apps);

// Sort by application_date desc
usort($all_apps, function ($a, $b) {
    return strtotime($b['application_date']) - strtotime($a['application_date']);
});

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Management Console | Hero Intern</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --bg-body: #f0f2f5;
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --accent: #10b981;
            --card-radius: 20px;
            --shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.02);
        }

        body {
            background-color: var(--bg-body);
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            color: #1e293b;
        }

        .main-container {
            max-width: 1300px;
            margin: 40px auto;
            padding: 0 20px;
        }

        /* Top Bar */
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .btn-back {
            background: #ffffff;
            color: #64748b;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 12px;
            text-decoration: none;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            background: #f8fafc;
            color: var(--primary);
            border-color: var(--primary);
        }

        /* Layout Grid */
        .dashboard-grid {
            display: grid;
            grid-template-columns: 350px 1fr;
            gap: 30px;
        }

        /* Profile Card */
        .profile-card {
            background: #ffffff;
            border-radius: var(--card-radius);
            padding: 30px;
            box-shadow: var(--shadow);
            height: fit-content;
            position: sticky;
            top: 40px;
        }

        .avatar-circle {
            width: 80px;
            height: 80px;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: 800;
            margin: 0 auto 20px;
        }

        .profile-name {
            text-align: center;
            font-size: 1.5rem;
            font-weight: 800;
            margin-bottom: 5px;
        }

        .profile-username {
            text-align: center;
            color: #64748b;
            display: block;
            margin-bottom: 25px;
        }

        .info-group {
            border-top: 1px solid #f1f5f9;
            padding: 15px 0;
        }

        .info-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            color: #94a3b8;
            font-weight: 700;
            display: block;
            margin-bottom: 5px;
        }

        .info-value {
            font-weight: 600;
            color: #334155;
            word-break: break-all;
        }

        /* Application List */
        .content-card {
            background: #ffffff;
            border-radius: var(--card-radius);
            padding: 30px;
            box-shadow: var(--shadow);
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 800;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Modern Table */
        .table-custom {
            margin-top: 10px;
        }

        .table-custom thead th {
            background: #f8fafc;
            border: none;
            color: #64748b;
            font-size: 0.75rem;
            text-transform: uppercase;
            padding: 15px;
        }

        .table-custom tbody td {
            padding: 20px 15px;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
        }

        .badge-type {
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.7rem;
            text-transform: uppercase;
        }

        .type-course { background: #e0e7ff; color: #4338ca; }
        .type-internship { background: #dcfce7; color: #15803d; }
        .type-job { background: #fef9c3; color: #854d0e; }

        .btn-remove {
            text-decoration: none;
            background: #fff1f2;
            color: #e11d48;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 700;
            transition: 0.3s;
        }

        .btn-remove:hover { background: #ffe4e6; transform: scale(1.05); }

        @media (max-width: 1000px) {
            .dashboard-grid { grid-template-columns: 1fr; }
            .profile-card { position: relative; top: 0; }
        }
    </style>
</head>
<body>

    <div class="main-container">
        <div class="top-bar">
            <h2 style="font-weight: 900; letter-spacing: -1px;">User Intelligence</h2>
            <a href="allUsers.php" class="btn-back">← Back to Directory</a>
        </div>

        <?php if (isset($_GET['msg'])): ?>
            <div class="alert alert-<?= htmlspecialchars($_GET['msgtype'] ?? 'info') ?> border-0 shadow-sm rounded-4 mb-4">
                <?= htmlspecialchars($_GET['msg']) ?>
            </div>
        <?php endif; ?>

        <div class="dashboard-grid">
            <aside class="profile-card">
                <div class="avatar-circle">
                    <?= strtoupper(substr($user['fname'], 0, 1)) ?>
                </div>
                <h3 class="profile-name"><?= htmlspecialchars($user['fname'] . ' ' . $user['lname']) ?></h3>
                <span class="profile-username">@<?= htmlspecialchars($user['username']) ?></span>

                <div class="info-group">
                    <span class="info-label">Email Address</span>
                    <span class="info-value"><?= htmlspecialchars($user['email']) ?></span>
                </div>
                <div class="info-group">
                    <span class="info-label">Tech Stack</span>
                    <div class="mt-2">
                        <span class="badge bg-light text-dark border"><?= htmlspecialchars($user['language1']) ?></span>
                        <span class="badge bg-light text-dark border"><?= htmlspecialchars($user['language2']) ?></span>
                    </div>
                </div>
                <div class="info-group">
                    <span class="info-label">Industry Experience</span>
                    <span class="info-value"><?= htmlspecialchars($user['experience']) ?> Years</span>
                </div>
                <div class="info-group">
                    <span class="info-label">System UID</span>
                    <span class="info-value">#<?= htmlspecialchars($user['user_id']) ?></span>
                </div>
            </aside>

            <section class="content-card">
                <h3 class="section-title">
                    <span>📋</span> Active Applications
                </h3>
                
                <div class="table-responsive">
                    <table class="table table-custom">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Listing Title</th>
                                <th>Pricing/Exp</th>
                                <th>Applied Date</th>
                                <th class="text-end">Management</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($all_apps as $app): ?>
                            <tr>
                                <td>
                                    <span class="badge-type type-<?= $app['type'] ?>">
                                        <?= $app['type'] ?>
                                    </span>
                                </td>
                                <td>
                                    <div style="font-weight: 700;"><?= htmlspecialchars($app['title']) ?></div>
                                    <small class="text-muted"><?= htmlspecialchars($app['language'] ?: 'N/A') ?></small>
                                </td>
                                <td>
                                    <?php if($app['type'] == 'job'): ?>
                                        <span style="color: #854d0e; font-weight: 700;"><?= htmlspecialchars($app['req_exp']) ?> Yrs Exp</span>
                                    <?php else: ?>
                                        <span style="color: #15803d; font-weight: 700;">₹<?= number_format($app['amount']) ?></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div style="font-size: 0.85rem; font-weight: 600; color: #64748b;">
                                        <?= date('M d, Y', strtotime($app['application_date'])) ?>
                                    </div>
                                </td>
                                <td class="text-end">
                                    <a href="viewApplications.php?id=<?= $user_id ?>&remove_type=<?= $app['type'] ?>&remove_id=<?= $app['id'] ?>" 
                                       class="btn-remove" 
                                       onclick="return confirm('Remove application permanently?')">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php if (empty($all_apps)): ?>
                                <tr><td colspan="5" class="text-center py-5 text-muted">No application records found for this user.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>

    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>