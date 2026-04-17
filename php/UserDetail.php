<?php 
    include_once('header.php');
?>
<?php 
    // Logic remains untouched
    session_start();
    if (!isset($_SESSION['username'])) {
        echo "<script>alert('You need to login first!'); window.location.href = 'login.php';</script>";
        exit();
    }
    require_once "./connection.php";
    extract($_SESSION);
    
    $user_query = "SELECT user_id, username FROM user WHERE username = '$username'";
    $user_result = mysqli_query($db, $user_query);
    $user_row = mysqli_fetch_array($user_result);
    $row_user_id = $user_row['user_id'];

    $courses_result = mysqli_query($db, "SELECT * FROM vw_user_course WHERE user_id = '$row_user_id'");
    $internships_result = mysqli_query($db, "SELECT * from vw_user_internship WHERE user_id = '$row_user_id'");
    $jobs_result = mysqli_query($db, "SELECT * FROM vw_user_job WHERE user_id = '$row_user_id'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Hero Intern</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --bg-color: #f4f7fe;
            --primary: #6366f1;
            --card-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
        }

        body {
            background-color: var(--bg-color);
            font-family: 'Inter', system-ui, sans-serif;
            color: #1e293b;
        }

        /* Modern Dashboard Header */
        .dash-header {
            background: #ffffff;
            padding: 1.5rem 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e2e8f0;
        }

        .user-welcome h2 {
            font-size: 1.25rem;
            font-weight: 700;
            margin: 0;
        }

        .user-welcome span {
            font-size: 0.85rem;
            color: #64748b;
        }

        /* Navigation Tabs as Buttons */
        /* Explicitly fix the "Disappearing Text" bug */
.nav-pills .nav-link.active, 
.nav-pills .show > .nav-link {
    background-color: #6366f1 !important; /* Force the indigo background */
    color: #ffffff !important;            /* Force the text to stay white */
    box-shadow: 0 4px 14px 0 rgba(99, 102, 241, 0.39);
}

/* Ensure inactive tabs have visible text */
.nav-pills .nav-link {
    color: #64748b; /* Professional slate gray */
    background: #ffffff;
    border: 1px solid #e2e8f0;
    margin: 0 5px;
}

        /* Table Card Stylings */
        .data-card {
            background: #ffffff;
            border-radius: 16px;
            border: none;
            box-shadow: var(--card-shadow);
            padding: 1.5rem;
            margin-top: 2rem;
        }

        .table thead {
            background-color: #f8fafc;
            border-bottom: 2px solid #e2e8f0;
        }

        .table th {
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            color: #64748b;
            padding: 1rem;
        }

        .table td {
            vertical-align: middle;
            padding: 1rem;
            font-size: 0.9rem;
        }

        .badge-date {
            background: #e0e7ff;
            color: #4338ca;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 600;
        }
    </style>
    <style>
    .action-link {
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 600;
        padding: 8px 20px;
        border-radius: 10px;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
    }
    
    .action-link.secondary {
        color: #64748b;
        background: #f1f5f9;
        border: 1px solid #e2e8f0;
    }
    
    .action-link.secondary:hover {
        background: #e2e8f0;
        color: #1e293b;
    }
    
    .action-link.primary {
        color: white;
        background: #6366f1;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
    }
    
    .action-link.primary:hover {
        background: #4f46e5;
        transform: translateY(-1px);
        box-shadow: 0 6px 15px rgba(99, 102, 241, 0.3);
    }
</style>
</head>
<body>

    <header class="dash-header">
        <div class="user-welcome">
            <h2>User Dashboard</h2>
            <span>Welcome back, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong></span>
        </div>
        <div class="header-actions" style="display: flex; align-items: center; gap: 12px;">
    <a href="./contact.php" class="action-link secondary">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" style="margin-right: 6px;">
            <path d="M8 1a5 5 0 0 0-5 5v1h1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V6a6 6 0 1 1 12 0v6a2.5 2.5 0 0 1-2.5 2.5H9.366a1 1 0 0 1-.866.5h-1a1 1 0 1 1 0-2h1a1 1 0 0 1 .866.5H11.5A1.5 1.5 0 0 0 13 12V6a5 5 0 0 0-5-5z"/>
        </svg>
        Support
    </a>
    <a href="./dashboard.php" class="action-link primary">
        Return Home
    </a>
</div>


    </header>

    <div class="container my-5">
        <ul class="nav nav-pills justify-content-center mb-4" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-courses-tab" data-bs-toggle="pill" data-bs-target="#pills-courses" type="button" role="tab">Courses</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-internships-tab" data-bs-toggle="pill" data-bs-target="#pills-internships" type="button" role="tab">Internships</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-jobs-tab" data-bs-toggle="pill" data-bs-target="#pills-jobs" type="button" role="tab">Jobs</button>
            </li>
        </ul>

        <div class="tab-content" id="pills-tabContent">
            
            <div class="tab-pane fade show active" id="pills-courses" role="tabpanel">
                <div class="data-card">
                    <h5 class="mb-4 fw-bold">Active Course Enrollments</h5>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Language</th>
                                    <th>Duration</th>
                                    <th>Application Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; while ($row = mysqli_fetch_assoc($courses_result)): ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td class="fw-bold"><?php echo $row['title']; ?></td>
                                    <td class="text-muted"><?php echo substr($row['description'], 0, 50); ?>...</td>
                                    <td><span class="badge bg-light text-dark border"><?php echo $row['language']; ?></span></td>
                                    <td><?php echo $row['duration']; ?></td>
                                    <td><span class="badge-date"><?php echo $row['application_date']; ?></span></td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="pills-internships" role="tabpanel">
                <div class="data-card">
                    <h5 class="mb-4 fw-bold">Internship Applications</h5>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Requirement</th>
                                    <th>Fee</th>
                                    <th>Applied On</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; while ($row = mysqli_fetch_assoc($internships_result)): ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td class="fw-bold"><?php echo $row['title']; ?></td>
                                    <td><?php echo $row['req_language']; ?></td>
                                    <td>₹<?php echo $row['price']; ?></td>
                                    <td><span class="badge-date"><?php echo $row['application_date']; ?></span></td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="pills-jobs" role="tabpanel">
                <div class="data-card">
                    <h5 class="mb-4 fw-bold">Job Applications</h5>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Job Title</th>
                                    <th>Required Experience</th>
                                    <th>Application Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; while ($row = mysqli_fetch_assoc($jobs_result)): ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td class="fw-bold"><?php echo $row['title']; ?></td>
                                    <td class="fw-bold"><?php echo $row['req_exp']; ?> years</td>
                                    <td><span class="badge bg-dark"><?php echo $row['application_date']; ?></span></td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>