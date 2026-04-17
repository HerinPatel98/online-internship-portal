<!-- Home Page or Landing page -->
<?php
session_start();
if (!isset($_SESSION['username'])) {
    echo "<script>
        alert('You need to login first!');
        window.location.href = 'login.php';
    </script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>HeroIntern | Dashboard</title>
    <link rel="stylesheet" href="../styles/dashboard.css">

    <style>
        .fixed-app-trigger {
    position: fixed;
    right: 0;
    top: 50%;
    transform: translateY(-50%);
    z-index: 1001;
}

.app-btn-link {
    display: flex;
    align-items: center;
    background: #6366f1; /* Your primary indigo */
    color: white;
    text-decoration: none;
    padding: 12px 20px;
    border-radius: 30px 0 0 30px; /* Rounded only on the left */
    box-shadow: -4px 4px 15px rgba(99, 102, 241, 0.3);
    transition: all 0.3s ease;
}

.app-btn-link:hover {
    padding-right: 35px; /* Slight slide-out effect */
    background: #4f46e5;
    color: white;
}

.app-icon {
    font-size: 1.2rem;
    margin-right: 10px;
}

.app-text {
    font-weight: 700;
    font-size: 0.9rem;
    letter-spacing: 0.5px;
}

@media (max-width: 768px) {
    .app-text { display: none; } /* On mobile, only show the icon */
    .app-btn-link { padding: 12px; border-radius: 50% 0 0 50%; }
}
    </style>
</head>

<body>
    <nav>
        <div class="navbar-container">
            <div class="navbar-left">
                <span class="navbar-logo">🚀</span>
                <div class="navbar-title-wrap">
                    <span class="navbar-title-main">Hero Intern</span>
                    <span class="navbar-title-sub">Dashboard</span>
                </div>
            </div>
            <div class="navbar-center">
                <a href="dashboard.php" class="navbar-link">Home</a>
                <a href="#courses" class="navbar-link">Courses</a>
                <a href="#internships" class="navbar-link">Internships</a>
                <a href="#jobs" class="navbar-link">Jobs</a>
            </div>
            <div class="navbar-right">
    <div class="user-greeting">
        <span class="user-welcome">Welcome,</span>
        <span class="user-name"><?= htmlspecialchars($_SESSION['username']) ?></span>
    </div>
    <div class="nav-action-group">
        <a href="./userProfile.php" class="nav-btn profile">
            <span class="nav-icon">👤</span> Profile
        </a>
        <a href="./user_logout.php" class="nav-btn logout">
            <span class="nav-icon">🚪</span> Logout
        </a>
    </div>
</div>
        </div>
    </nav>
    <header>
        <section>
            <h2>
                About Hero Intern
            </h2>
            <p>
                <strong>Hero Intern</strong> is a dynamic platform designed to empower students and freshers by connecting them with top internship and job opportunities across various technology domains. Our mission is to bridge the gap between academia and industry by offering a simplified, user-friendly experience for exploring, applying, and managing internships and skill-development programs.
            </p>
            <div class="about-hero-intern">
                <div class="mission-card">
                    <h3> Our Mission</h3>
                    <p>To help every student launch a successful career by providing accessible, verified, and skill-focused opportunities.</p>
                </div>
                <div class="offer-card">
                    <h3>🛠 What We Offer</h3>
                    <p>Internships, Jobs, Online Courses, Resume Building, Career Guidance, and Employer Networking.</p>
                </div>
                <div class="reach-card">
                    <h3> Our Reach</h3>
                    <p>Trusted by 10,000+ students and 500+ hiring partners across India’s leading academic institutions.</p>
                </div>
            </div>
        </section>
    </header>
    <div class="container">
        <!-- TAB BUTTONS ADDED BELOW -->
        <div class="tabs"> <!-- Tab buttons for switching sections -->
            <button class="tab-btn active" data-tab="courses">Courses</button>
            <button class="tab-btn" data-tab="internships">Internships</button>
            <button class="tab-btn" data-tab="jobs">Jobs</button>
        </div>
        <!-- TAB CONTENT SECTIONS ADDED BELOW -->
        <div class="tab-content" id="courses" style="display:block;"> <!-- Courses tab content -->
            <h2 style="margin-bottom: 20px;">Explore Courses</h2>
            <div class="grid">
                <?php require_once("./dynamicCourseCard.php"); ?>
            </div>
        </div>
        <div class="tab-content" id="internships" style="display:none;"> <!-- Internships tab content -->
            <h2 style="margin-bottom: 20px;">Explore Internship Opportunities</h2>
            <div class="grid">
                <?php require_once("./dynamicInternshipCard.php"); ?>
            </div>
        </div>
        <div class="tab-content" id="jobs" style="display:none;"> <!-- Jobs tab content -->
            <h2 style="margin-bottom: 20px;">Explore Job Openings</h2>
            <div class="grid">
                <?php require_once("./dynamicJobCard.php"); ?>
            </div>
        </div>
        <div class="fixed-app-trigger">
            <a href="./UserDetail.php" class="app-btn-link">
            <span class="app-icon">📋</span>
            <span class="app-text">My Applications</span>
    </a>
</div>
    </div>
    <!-- TAB SWITCHING SCRIPT ADDED BELOW -->
    <script>
        // Tab switching logic for showing/hiding tab content
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                document.querySelectorAll('.tab-content').forEach(tc => tc.style.display = 'none');
                document.getElementById(this.dataset.tab).style.display = 'block';
                // Always scroll to tab content for internships/jobs
                setTimeout(() => {
                    document.getElementById(this.dataset.tab).scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }, 100);
            });
        });

        // Ensure navbar links show the correct tab content
        document.querySelectorAll('.navbar-link').forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                const targetTab = this.getAttribute('href').substring(1); // Extract tab ID from href

                document.querySelectorAll('.tab-btn').forEach(btn => {
                    btn.classList.remove('active');
                    if (btn.dataset.tab === targetTab) {
                        btn.classList.add('active');
                    }
                });

                document.querySelectorAll('.tab-content').forEach(tc => tc.style.display = 'none');
                document.getElementById(targetTab).style.display = 'block';

                // Smooth scroll to the tab content
                setTimeout(() => {
                    document.getElementById(targetTab).scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }, 100);
            });
        });
    </script>

    <!-- Back to Top Button -->
    <button id="backToTopBtn" title="Go to top"> <!--&#8679;--> ⬆️</button>
    <style>
        #backToTopBtn {
            display: none;
            position: fixed;
            bottom: 32px;
            right: 32px;
            z-index: 99;
            border: none;
            outline: none;
            background: transparent;
            color: #fff;
            cursor: pointer;
            padding: 4px;
            border-radius: 10px;
            font-size: 2.1rem;
            box-shadow: 0 2px 8px rgba(120, 144, 156, 0.10);
            transition: background 0.2s;
        }

        #backToTopBtn:hover {
            background: #fff;
        }
    </style>
    <script>
        // Show button when user scrolls down
        window.onscroll = function() {
            document.getElementById('backToTopBtn').style.display = (window.scrollY > 200) ? 'block' : 'none';
        };
        // Scroll to top on click
        document.getElementById('backToTopBtn').onclick = function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        };
    </script>
    <?php
    include_once("./footer.php");
    ?>
</body>

</html>