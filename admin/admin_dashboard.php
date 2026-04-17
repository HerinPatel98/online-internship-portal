<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}
require_once "./connection.php";

// Fetching results remains the same
$courses_result = mysqli_query($db, 'SELECT * FROM course');
$internships_result = mysqli_query($db, 'SELECT * FROM internship');
$jobs_result = mysqli_query($db, 'SELECT * FROM job');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | Hero Intern</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --sidebar-width: 260px;
            --primary-gradient: linear-gradient(135deg, #0061ff 0%, #60efff 100%);
            --bg-light: #f4f7fe;
            --card-shadow: 0 10px 20px rgba(0,0,0,0.05);
        }

        body {
            background-color: var(--bg-light);
            font-family: 'Inter', system-ui, sans-serif;
            overflow-x: hidden;
        }

        /* Sidebar Sidebar */
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
            background: var(--bg-light);
            color: #0061ff;
        }

        /* Main Content Area */
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
            margin-bottom: 2.5rem;
        }

        .table thead th {
            background: #f8fafc;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            color: #94a3b8;
            border: none;
            padding: 1.2rem;
        }

        .table td {
            vertical-align: middle;
            padding: 1.2rem;
            color: #334155;
            border-bottom: 1px solid #f1f5f9;
        }

        .btn-action {
            padding: 6px 16px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .btn-add {
            background: var(--primary-gradient);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 700;
            box-shadow: 0 4px 15px rgba(0, 97, 255, 0.2);
        }

        @media (max-width: 992px) {
            .sidebar { display: none; }
            .main-wrapper { margin-left: 0; padding: 1.5rem; }
        }
    </style>
</head>
<body>
    <aside class="sidebar">
        <a href="#" class="brand">🚀 Hero Admin</a>
        <nav>
            <a href="#courses" class="side-link">📚 Courses</a>
            <a href="#internships" class="side-link">🤝 Internships</a>
            <a href="#jobs" class="side-link">💼 Job Openings</a>
            <a href="allUsers.php" class="side-link">👥 User Management</a>
            <hr style="margin: 2rem 0; opacity: 0.1;">
            <a href="./admin_logout.php" class="side-link text-danger">Logout</a>
        </nav>
    </aside>

    <main class="main-wrapper">
        <header class="top-nav">
            <div>
                <h1 style="font-size: 1.75rem; font-weight: 800; margin: 0;">Dashboard Overview</h1>
                <p style="color: #64748b; margin: 0;">Welcome back, <strong><?php echo htmlspecialchars($_SESSION['admin']); ?></strong></p>
            </div>
            <!-- <a href="add_course.php" class="btn-add" style="text-decoration:none;">+ Create New</a> -->
        </header>

        <section id="courses" class="admin-card">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 style="font-size: 1.25rem; font-weight: 700; margin: 0;">Active Courses</h2>
                <a href="add_course.php" class="btn-add" style="text-decoration:none;">+ Create New</a>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Details</th>
                            <th>Price</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; while($row = mysqli_fetch_assoc($courses_result)): ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><strong><?php echo $row['title']; ?></strong><br><small class="text-muted"><?php echo $row['language']; ?></small></td>
                            <td><?php echo substr($row['description'], 0, 40); ?>...</td>
                            <td>₹<?php echo number_format($row['price']); ?></td>
                            <td class="text-end">
                                <a href="updateCourse.php?id=<?php echo $row['course_id']; ?>" class="btn btn-action btn-warning">Edit</a>
                                <a href="deleteCourse.php?id=<?php echo $row['course_id']; ?>" class="btn btn-action btn-outline-danger" onclick="return confirm('Delete course?')">Delete</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <section id="internships" class="admin-card">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 style="font-size: 1.25rem; font-weight: 700; margin: 0;">Internships</h2>
                <a href="add_internship.php" class="btn-add" style="text-decoration:none;">+ Create New</a>
            </div>
             <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Role</th>
                            <th>Language</th>
                            <th>Pricing</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; while($row = mysqli_fetch_assoc($internships_result)): ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><strong><?php echo $row['title']; ?></strong></td>
                            <td><?php echo $row['req_language']; ?></td>
                            <td>₹<?php echo number_format($row['price']); ?></td>
                            <td class="text-end">
                                <a href="updateInternship.php?id=<?php echo $row['internship_id']; ?>" class="btn btn-action btn-warning">Edit</a>
                                <a href="deleteInternship.php?id=<?php echo $row['internship_id']; ?>" class="btn btn-action btn-outline-danger">Delete</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </section>
        <section id="jobs" class="admin-card">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 style="font-size: 1.25rem; font-weight: 700; margin: 0;">Job Listings</h2>
                <a href="add_course.php" class="btn-add" style="text-decoration:none;">+ Create New</a>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Positions</th>
                            <th>Required Exp</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 1; 
                        while ($row = mysqli_fetch_assoc($jobs_result)) { 
                        ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td>
                                <strong><?php echo htmlspecialchars($row['title']); ?></strong>
                                <br>
                                <small class="text-muted"><?php echo substr($row['description'], 0, 30); ?>...</small>
                            </td>
                            <td><span class="badge bg-light text-dark border"><?php echo $row['position']; ?> Openings</span></td>
                            <td><span class="badge bg-info text-white"><?php echo $row['req_exp']; ?> Years</span></td>
                            <td class="text-end">
                                <a href="updateJob.php?id=<?php echo $row['job_id']; ?>" class="btn btn-action btn-warning">Edit</a>
                                <a href="deleteJob.php?id=<?php echo $row['job_id']; ?>" 
                                class="btn btn-action btn-outline-danger" 
                                onclick="return confirm('Are you sure you want to delete this job opening?')">
                                Delete
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>