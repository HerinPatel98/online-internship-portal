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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HeroIntern | Dashboard</title>
    <link rel="stylesheet" href="../styles/dashboard.css">
    <link rel="stylesheet" href="../styles/advanced_filter.css">
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
    background: #6366f1;
    color: white;
    text-decoration: none;
    padding: 12px 20px;
    border-radius: 30px 0 0 30px;
    box-shadow: -4px 4px 15px rgba(99, 102, 241, 0.3);
    transition: all 0.3s ease;
}

.app-btn-link:hover {
    padding-right: 35px;
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
    .app-text { display: none; }
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
            <h2>About Hero Intern</h2>
            <p>
                <strong>Hero Intern</strong> is a dynamic platform designed to empower students and freshers by connecting them with top internship and job opportunities across various technology...
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
                    <p>Trusted by 10,000+ students and 500+ hiring partners across India's leading academic institutions.</p>
                </div>
            </div>
        </section>
    </header>
    <div class="container">
        <!-- TAB BUTTONS -->
        <div class="tabs">
            <button class="tab-btn active" data-tab="courses">Courses</button>
            <button class="tab-btn" data-tab="internships">Internships</button>
            <button class="tab-btn" data-tab="jobs">Jobs</button>
        </div>

        <!-- COURSES TAB WITH FILTERS -->
        <div class="tab-content" id="courses" style="display:block;">
            <h2 style="margin-bottom: 1.5rem;">Explore Courses</h2>
            
            <div class="search-filter-container">
                <!-- Filter Sidebar - Courses -->
                <div class="filter-sidebar">
                    <div class="filter-title">
                        Filters
                        <button class="clear-filters">Clear</button>
                    </div>

                    <div class="search-box">
                        <input id="search-input" type="text" placeholder="Search courses...">
                        <button>Search</button>
                    </div>

                    <div class="active-filters"></div>

                    <!-- Level Filter -->
                    <!-- <div class="filter-section">
                        <label class="filter-label">Level</label>
                        <div class="filter-option">
                            <input type="checkbox" name="level" value="Beginner">
                            <label>Beginner</label>
                        </div>
                        <div class="filter-option">
                            <input type="checkbox" name="level" value="Intermediate">
                            <label>Intermediate</label>
                        </div>
                        <div class="filter-option">
                            <input type="checkbox" name="level" value="Advanced">
                            <label>Advanced</label>
                        </div>
                    </div> -->

                    <!-- Language Filter -->
                    <div class="filter-section">
                        <label class="filter-label">Language</label>
                        <select class="filter-select" data-filter="language">
                            <option value="">All Languages</option>
                            <option value="Python">Python</option>
                            <option value="JavaScript">JavaScript</option>
                            <option value="Java">Java</option>
                            <option value="C++">C++</option>
                            <option value="React">React</option>
                            <option value="Node.js">Node.js</option>
                        </select>
                    </div>

                    <!-- Price Filter -->
                    <div class="filter-section" data-filter="price">
                        <label class="filter-label">Price Range</label>
                        <div class="range-input">
                            <input type="number" data-type="min" value="0" placeholder="Min">
                            <span>-</span>
                            <input type="number" data-type="max" value="50000" placeholder="Max">
                        </div>
                        <input type="range" class="slider" min="0" max="50000" value="50000">
                    </div>

                    <!-- Duration Filter -->
                    <div class="filter-section">
                        <label class="filter-label">Duration</label>
                        <div class="filter-option">
                            <input type="checkbox" name="duration" value="1-2 weeks">
                            <label>1-2 weeks</label>
                        </div>
                        <div class="filter-option">
                            <input type="checkbox" name="duration" value="1-3 months">
                            <label>1-3 months</label>
                        </div>
                        <div class="filter-option">
                            <input type="checkbox" name="duration" value="3+ months">
                            <label>3+ months</label>
                        </div>
                    </div>
                </div>

                <!-- Results Area - Courses -->
                <div class="results-container">
                    <div class="results-header">
                        <span class="results-count">Showing 0 results</span>
                        <div class="sort-options">
                            <label class="sort-label">Sort by:</label>
                            <select class="sort-select">
                                <option value="recent">Most Recent</option>
                                <option value="price-low">Price: Low to High</option>
                                <option value="price-high">Price: High to Low</option>
                                <option value="rating">Highest Rating</option>
                            </select>
                        </div>
                    </div>

                    <div class="results-grid">
                        <?php require_once("./dynamicCourseCard.php"); ?>
                    </div>

                    <div class="pagination">
                        <button data-page="1">1</button>
                        <button data-page="2">2</button>
                        <button data-page="3">3</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- INTERNSHIPS TAB WITH FILTERS -->
        <div class="tab-content" id="internships" style="display:none;">
            <h2 style="margin-bottom: 1.5rem;">Explore Internship Opportunities</h2>
            
            <div class="search-filter-container">
                <!-- Filter Sidebar - Internships -->
                <div class="filter-sidebar">
                    <div class="filter-title">
                        Filters
                        <button class="clear-filters">Clear</button>
                    </div>

                    <div class="search-box">
                        <input type="text" placeholder="Search internships...">
                        <button>Search</button>
                    </div>

                    <div class="active-filters"></div>

                    <!-- Type Filter -->
                    <div class="filter-section">
                        <label class="filter-label">Work Type</label>
                        <div class="filter-option">
                            <input type="checkbox" name="type" value="Remote">
                            <label>Remote</label>
                        </div>
                        <div class="filter-option">
                            <input type="checkbox" name="type" value="On-site">
                            <label>On-site</label>
                        </div>
                        <div class="filter-option">
                            <input type="checkbox" name="type" value="Hybrid">
                            <label>Hybrid</label>
                        </div>
                    </div>

                    <!-- Location Filter -->
                    <div class="filter-section">
                        <label class="filter-label">Location</label>
                        <input type="text" class="filter-select" placeholder="Enter city" data-filter="location">
                    </div>

                    <!-- Stipend Filter -->
                    <div class="filter-section" data-filter="stipend">
                        <label class="filter-label">Stipend Range</label>
                        <div class="range-input">
                            <input type="number" data-type="min" value="0" placeholder="Min">
                            <span>-</span>
                            <input type="number" data-type="max" value="100000" placeholder="Max">
                        </div>
                        <input type="range" class="slider" min="0" max="100000" value="100000">
                    </div>

                    <!-- Duration Filter -->
                    <div class="filter-section">
                        <label class="filter-label">Duration</label>
                        <div class="filter-option">
                            <input type="checkbox" name="duration" value="1 month">
                            <label>1 month</label>
                        </div>
                        <div class="filter-option">
                            <input type="checkbox" name="duration" value="2-3 months">
                            <label>2-3 months</label>
                        </div>
                        <div class="filter-option">
                            <input type="checkbox" name="duration" value="6 months">
                            <label>6 months</label>
                        </div>
                    </div>
                </div>

                <!-- Results Area - Internships -->
                <div class="results-container">
                    <div class="results-header">
                        <span class="results-count">Showing 0 results</span>
                        <div class="sort-options">
                            <label class="sort-label">Sort by:</label>
                            <select class="sort-select">
                                <option value="recent">Most Recent</option>
                                <option value="stipend-low">Stipend: Low to High</option>
                                <option value="stipend-high">Stipend: High to Low</option>
                            </select>
                        </div>
                    </div>

                    <div class="results-grid">
                        <?php require_once("./dynamicInternshipCard.php"); ?>
                    </div>

                    <div class="pagination">
                        <button data-page="1">1</button>
                        <button data-page="2">2</button>
                        <button data-page="3">3</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- JOBS TAB WITH FILTERS -->
        <div class="tab-content" id="jobs" style="display:none;">
            <h2 style="margin-bottom: 1.5rem;">Explore Job Openings</h2>
            
            <div class="search-filter-container">
                <!-- Filter Sidebar - Jobs -->
                <div class="filter-sidebar">
                    <div class="filter-title">
                        Filters
                        <button class="clear-filters">Clear</button>
                    </div>

                    <div class="search-box">
                        <input type="text" placeholder="Search jobs...">
                        <button>Search</button>
                    </div>

                    <div class="active-filters"></div>

                    <!-- Job Type Filter -->
                    <div class="filter-section">
                        <label class="filter-label">Job Type</label>
                        <div class="filter-option">
                            <input type="checkbox" name="job_type" value="Full-time">
                            <label>Full-time</label>
                        </div>
                        <div class="filter-option">
                            <input type="checkbox" name="job_type" value="Part-time">
                            <label>Part-time</label>
                        </div>
                        <div class="filter-option">
                            <input type="checkbox" name="job_type" value="Contract">
                            <label>Contract</label>
                        </div>
                    </div>

                    <!-- Location Filter -->
                    <div class="filter-section">
                        <label class="filter-label">Location</label>
                        <input type="text" class="filter-select" placeholder="Enter city" data-filter="location">
                    </div>

                    <!-- Experience Filter -->
                    <div class="filter-section">
                        <label class="filter-label">Experience Level</label>
                        <div class="filter-option">
                            <input type="checkbox" name="experience" value="0-1 years">
                            <label>0-1 years</label>
                        </div>
                        <div class="filter-option">
                            <input type="checkbox" name="experience" value="1-3 years">
                            <label>1-3 years</label>
                        </div>
                        <div class="filter-option">
                            <input type="checkbox" name="experience" value="3+ years">
                            <label>3+ years</label>
                        </div>
                    </div>

                    <!-- Salary Filter -->
                    <div class="filter-section" data-filter="salary">
                        <label class="filter-label">Salary Range</label>
                        <div class="range-input">
                            <input type="number" data-type="min" value="0" placeholder="Min">
                            <span>-</span>
                            <input type="number" data-type="max" value="1000000" placeholder="Max">
                        </div>
                        <input type="range" class="slider" min="0" max="1000000" value="1000000">
                    </div>
                </div>

                <!-- Results Area - Jobs -->
                <div class="results-container">
                    <div class="results-header">
                        <span class="results-count">Showing 0 results</span>
                        <div class="sort-options">
                            <label class="sort-label">Sort by:</label>
                            <select class="sort-select">
                                <option value="recent">Most Recent</option>
                                <option value="salary-low">Salary: Low to High</option>
                                <option value="salary-high">Salary: High to Low</option>
                            </select>
                        </div>
                    </div>

                    <div class="results-grid">
                        <?php require_once("./dynamicJobCard.php"); ?>
                    </div>

                    <!-- <div class="pagination">
                        <button data-page="1">1</button>
                        <button data-page="2">2</button>
                        <button data-page="3">3</button>
                    </div> -->
                </div>
            </div>
        </div>

        <div class="fixed-app-trigger">
            <a href="./UserDetail.php" class="app-btn-link">
            <span class="app-icon">📋</span>
            <span class="app-text">My Applications</span>
    </a>
</div>
    </div>

    <!-- Tab Switching Script -->
    <script>
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                document.querySelectorAll('.tab-content').forEach(tc => tc.style.display = 'none');
                document.getElementById(this.dataset.tab).style.display = 'block';
                setTimeout(() => {
                    document.getElementById(this.dataset.tab).scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }, 100);
            });
        });

        document.querySelectorAll('.navbar-link').forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                const targetTab = this.getAttribute('href').substring(1);

                document.querySelectorAll('.tab-btn').forEach(btn => {
                    btn.classList.remove('active');
                    if (btn.dataset.tab === targetTab) {
                        btn.classList.add('active');
                    }
                });

                document.querySelectorAll('.tab-content').forEach(tc => tc.style.display = 'none');
                document.getElementById(targetTab).style.display = 'block';

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
    <button id="backToTopBtn" title="Go to top">⬆️</button>
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
        window.onscroll = function() {
            document.getElementById('backToTopBtn').style.display = (window.scrollY > 200) ? 'block' : 'none';
        };
        document.getElementById('backToTopBtn').onclick = function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        };
    </script>

    <script src="../js/advanced_filter.js"></script>
    <?php include_once("./footer.php"); ?>
</body>

</html>