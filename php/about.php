<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | Internship Portal</title>
    <style>
        :root {
            --primary: #6366f1;
            --secondary: #4f46e5;
            --dark-bg: #0f172a;
            --text-main: #1e293b;
            --text-muted: #64748b;
        }

        body {
            margin: 0;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            color: var(--text-main);
            background-color: #ffffff;
            line-height: 1.6;
        }

        /* Hero Header */
        .about-header {
            padding: 100px 5%;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            text-align: center;
            border-bottom: 1px solid #e2e8f0;
        }

        .about-header h1 {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 20px;
            color: var(--dark-bg);
        }

        .about-header p {
            font-size: 1.2rem;
            color: var(--text-muted);
            max-width: 800px;
            margin: 0 auto;
        }

        /* Mission Section */
        .section-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 80px 5%;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }

        .content-box h2 {
            font-size: 2.2rem;
            margin-bottom: 20px;
            color: var(--dark-bg);
        }

        .content-box p {
            margin-bottom: 25px;
            font-size: 1.05rem;
        }

        .image-box {
            background: #e2e8f0;
            height: 450px;
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            color: var(--primary);
            box-shadow: 0 20px 40px rgba(0,0,0,0.05);
        }

        /* Values Grid */
        .values-section {
            background: #f8fafc;
            padding: 80px 5%;
            text-align: center;
        }

        .values-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            max-width: 1200px;
            margin: 40px auto 0;
        }

        .value-card {
            background: #ffffff;
            padding: 40px;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .value-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.05);
            border-color: var(--primary);
        }

        .value-card h4 {
            font-size: 1.4rem;
            margin-bottom: 15px;
            color: var(--primary);
        }

        /* Footer Spacing Fix */
        .cta-bottom {
            padding: 80px 5%;
            text-align: center;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            padding: 15px 35px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            display: inline-block;
            transition: 0.3s;
        }

        .btn-primary:hover {
            background: var(--secondary);
            box-shadow: 0 8px 20px rgba(99, 102, 241, 0.3);
        }

        @media (max-width: 768px) {
            .section-container {
                grid-template-columns: 1fr;
                text-align: center;
            }
            .image-box { order: -1; height: 300px; }
        }
    </style>
</head>
<body>

    <?php include_once("./header.php"); ?>

    <section class="about-header">
        <h1>Our Story & Mission</h1>
        <p>Connecting ambitious students with industry leaders through a streamlined internship ecosystem.</p>
    </section>

    <section class="section-container">
        <div class="content-box">
            <h2>Bridging the Gap</h2>
            <p>Our platform was established to solve the disconnect between academic learning and professional requirements. We provide a space where talent meets opportunity, ensuring that every internship is a step toward a successful career.</p>
            <p>We focus on transparency, ease of use, and verified opportunities to help students transition confidently into the workforce.</p>
            <a href="./register.php" class="btn-primary">Join the Community</a>
        </div>
        <div class="image-box">
            🏢
        </div>
    </section>

    <section class="values-section">
        <h2>Our Core Principles</h2>
        <div class="values-grid">
            <div class="value-card">
                <h4>Transparency</h4>
                <p>Detailed job descriptions and clear expectations for both interns and employers.</p>
            </div>
            <div class="value-card">
                <h4>Growth</h4>
                <p>Prioritizing placements that offer high learning potential and mentorship.</p>
            </div>
            <div class="value-card">
                <h4>Accessibility</h4>
                <p>Ensuring that career-starting opportunities are available to students from all backgrounds.</p>
            </div>
        </div>
    </section>

    <?php include_once("./footer.php"); ?>

</body>
</html>