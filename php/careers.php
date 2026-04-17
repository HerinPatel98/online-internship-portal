<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Careers | Join Our Network</title>
    <style>
        :root {
            --primary: #6366f1;
            --dark: #0f172a;
            --bg-light: #f8fafc;
            --text-gray: #64748b;
        }

        body {
            margin: 0;
            font-family: 'Inter', system-ui, sans-serif;
            background-color: var(--bg-light);
            color: var(--dark);
            line-height: 1.6;
        }

        /* Hero Section */
        .careers-hero {
            text-align: center;
            padding: 80px 5%;
            background: white;
            border-bottom: 1px solid #e2e8f0;
        }

        .careers-hero h1 {
            font-size: 3rem;
            margin-bottom: 15px;
            letter-spacing: -0.02em;
        }

        .careers-hero p {
            color: var(--text-gray);
            font-size: 1.2rem;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Job Grid */
        .job-container {
            max-width: 1200px;
            margin: 60px auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
        }

        .job-card {
            background: white;
            padding: 30px;
            border-radius: 20px;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .job-card:hover {
            border-color: var(--primary);
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05);
        }

        .job-category {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            color: var(--primary);
            margin-bottom: 10px;
            display: block;
        }

        .job-title {
            font-size: 1.4rem;
            margin: 0 0 15px 0;
            color: var(--dark);
        }

        .job-meta {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .meta-tag {
            font-size: 0.85rem;
            background: #f1f5f9;
            padding: 4px 12px;
            border-radius: 6px;
            color: var(--text-gray);
        }

        .job-desc {
            font-size: 0.95rem;
            color: var(--text-gray);
            margin-bottom: 25px;
            flex-grow: 1;
        }

        .apply-link {
            text-decoration: none;
            color: white;
            background: var(--dark);
            padding: 12px;
            border-radius: 10px;
            text-align: center;
            font-weight: 600;
            transition: 0.3s;
        }

        .apply-link:hover {
            background: var(--primary);
        }

        @media (max-width: 600px) {
            .job-container { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <?php include_once("./header.php"); ?>

    <section class="careers-hero">
        <h1>Open Opportunities</h1>
        <p>Explore roles designed to help you grow your skills and build a meaningful career.</p>
    </section>

    <main class="job-container">
        <div class="job-card">
            <span class="job-category">Engineering</span>
            <h3 class="job-title">Frontend Developer</h3>
            <div class="job-meta">
                <span class="meta-tag">Remote</span>
                <span class="meta-tag">Full-time</span>
            </div>
            <p class="job-desc">Work with modern JavaScript frameworks like Vue or React to build highly interactive user interfaces for our portal.</p>
            <a href="./contact.php" class="apply-link">Apply Now</a>
        </div>

        <div class="job-card">
            <span class="job-category">Engineering</span>
            <h3 class="job-title">Backend Developer</h3>
            <div class="job-meta">
                <span class="meta-tag">Hybrid</span>
                <span class="meta-tag">Full-time</span>
            </div>
            <p class="job-desc">Scale our PHP/MySQL architecture and build robust APIs to handle thousands of concurrent internship applications.</p>
            <a href="./contact.php" class="apply-link">Apply Now</a>
        </div>

        <div class="job-card">
            <span class="job-category">Design</span>
            <h3 class="job-title">UI/UX Designer</h3>
            <div class="job-meta">
                <span class="meta-tag">Remote</span>
                <span class="meta-tag">Contract</span>
            </div>
            <p class="job-desc">Focus on user-centric design principles to create accessible and beautiful experiences for our diverse student base.</p>
            <a href="./contact.php" class="apply-link">Apply Now</a>
        </div>

        <div class="job-card">
            <span class="job-category">Data</span>
            <h3 class="job-title">Data Analyst</h3>
            <div class="job-meta">
                <span class="meta-tag">On-site</span>
                <span class="meta-tag">Full-time</span>
            </div>
            <p class="job-desc">Extract insights from user behavior to help us optimize internship matching algorithms and improve success rates.</p>
            <a href="./contact.php" class="apply-link">Apply Now</a>
        </div>

        <div class="job-card">
            <span class="job-category">Growth</span>
            <h3 class="job-title">Marketing Coordinator</h3>
            <div class="job-meta">
                <span class="meta-tag">Remote</span>
                <span class="meta-tag">Internship</span>
            </div>
            <p class="job-desc">Help us grow our community presence through strategic social media campaigns and student outreach programs.</p>
            <a href="./contact.php" class="apply-link">Apply Now</a>
        </div>

        <div class="job-card">
            <span class="job-category">Support</span>
            <h3 class="job-title">Student Success Lead</h3>
            <div class="job-meta">
                <span class="meta-tag">Hybrid</span>
                <span class="meta-tag">Full-time</span>
            </div>
            <p class="job-desc">Directly assist students in navigating the platform and optimizing their profiles for higher placement rates.</p>
            <a href="./contact.php" class="apply-link">Apply Now</a>
        </div>
    </main>

    <?php include_once("./footer.php"); ?>

</body>
</html>