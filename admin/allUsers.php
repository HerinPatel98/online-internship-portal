<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}
require_once "./connection.php";

$users_query = 'SELECT user_id, fname, lname, username, email, language1, language2, experience FROM user';
$users_result = mysqli_query($db, $users_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management | Hero Intern</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --sidebar-width: 260px;
            --primary: #6366f1;
            --bg-light: #f4f7fe;
            --card-shadow: 0 10px 20px rgba(0,0,0,0.05);
        }

        body {
            background-color: var(--bg-light);
            font-family: 'Inter', system-ui, sans-serif;
            margin: 0;
        }

        /* Reusing Sidebar Styles for Consistency */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: #ffffff;
            border-right: 1px solid #e2e8f0;
            padding: 2rem 1.5rem;
            z-index: 1000;
        }

        .sidebar .brand {
            font-size: 1.5rem;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 3rem;
            display: block;
            text-decoration: none;
        }

        .side-link {
            display: flex;
            align-items: center;
            padding: 0.8rem 1rem;
            color: #64748b;
            text-decoration: none;
            border-radius: 12px;
            margin-bottom: 0.5rem;
            transition: all 0.3s;
            font-weight: 600;
        }

        .side-link:hover, .side-link.active {
            background: #f1f5f9;
            color: var(--primary);
        }

        /* Main Content */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            padding: 2rem 3rem;
        }

        .top-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .admin-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: var(--card-shadow);
            border: none;
        }

        .table thead th {
            background: #f8fafc;
            text-transform: uppercase;
            font-size: 0.7rem;
            letter-spacing: 0.05em;
            color: #94a3b8;
            padding: 1.2rem;
            border: none;
        }

        .table td {
            vertical-align: middle;
            padding: 1rem;
            font-size: 0.9rem;
            border-bottom: 1px solid #f1f5f9;
        }

        .user-avatar {
            width: 35px;
            height: 35px;
            background: #e0e7ff;
            color: var(--primary);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            margin-right: 10px;
        }

        .btn-action {
            padding: 5px 12px;
            font-size: 0.8rem;
            border-radius: 8px;
            font-weight: 600;
        }

        @media (max-width: 992px) {
            .sidebar { display: none; }
            .main-wrapper { margin-left: 0; padding: 1.5rem; }
        }
    </style>
</head>
<body>

    <aside class="sidebar">
        <a href="admin_dashboard.php" class="brand">🚀 Hero Admin</a>
        <nav>
            <a href="admin_dashboard.php" class="side-link">📊 Dashboard</a>
            <a href="allUsers.php" class="side-link active">👥 User Management</a>
            <hr style="margin: 2rem 0; opacity: 0.1;">
            <a href="admin_logout.php" class="side-link text-danger">Logout</a>
        </nav>
    </aside>

    <main class="main-wrapper">
        <header class="top-nav">
            <div>
                <h1 style="font-size: 1.75rem; font-weight: 800; margin: 0;">User Directory</h1>
                <p style="color: #64748b; margin: 0;">Manage and monitor registered platform members.</p>
            </div>
            <a href="../php/register.php" class="btn btn-primary" style="border-radius: 12px; padding: 10px 20px; font-weight: 700;">+ New User</a>
        </header>

        <section class="admin-card">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Contact</th>
                            <th>Expertise</th>
                            <th>Experience</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($users_result)): ?>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="user-avatar"><?php echo strtoupper(substr($row['fname'], 0, 1)); ?></div>
                                    <div>
                                        <strong><?php echo htmlspecialchars($row['fname'] . " " . $row['lname']); ?></strong><br>
                                        <small class="text-muted">@<?php echo htmlspecialchars($row['username']); ?></small>
                                    </div>
                                </div>
                            </td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td>
                                <span class="badge bg-light text-dark border"><?php echo htmlspecialchars($row['language1']); ?></span>
                                <span class="badge bg-light text-dark border"><?php echo htmlspecialchars($row['language2']); ?></span>
                            </td>
                            <td><strong><?php echo htmlspecialchars($row['experience']); ?></strong> <small class="text-muted">yrs</small></td>
                            <td class="text-end">
                                <a href="viewApplications.php?id=<?php echo $row['user_id']; ?>" class="btn btn-action btn-primary">View</a>
                                <a href="updateUser.php?id=<?php echo $row['user_id']; ?>" class="btn btn-action btn-warning">Edit</a>
                                <a href="deleteUser.php?id=<?php echo $row['user_id']; ?>" class="btn btn-action btn-outline-danger" onclick="return confirm('Delete user?')">Delete</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>