<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy | Secure Portal</title>
    <style>
        :root {
            --primary: #6366f1;
            --primary-glow: rgba(99, 102, 241, 0.15);
            --bg-dark: #0f172a;
            --card-bg: #ffffff;
            --text-main: #1e293b;
            --text-light: #64748b;
            --accent-green: #10b981;
        }

        body {
            margin: 0;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            color: var(--text-main);
            background-color: #f8fafc;
            line-height: 1.8;
        }

        /* Hero Section */
        .policy-hero {
            background: var(--bg-dark);
            color: white;
            padding: 100px 5% 140px;
            text-align: center;
            clip-path: polygon(0 0, 100% 0, 100% 85%, 0 100%);
        }

        .policy-hero h1 {
            font-size: 3.5rem;
            margin: 0;
            letter-spacing: -0.05em;
        }

        .policy-hero p {
            opacity: 0.7;
            font-size: 1.1rem;
            margin-top: 10px;
        }

        /* TL;DR Summary Cards */
        .summary-container {
            max-width: 1100px;
            margin: -80px auto 60px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            padding: 0 20px;
        }

        .summary-card {
            z-index: 0;
            background: var(--card-bg);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            border: 1px solid #e2e8f0;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .summary-card:hover {
            transform: translateY(-5px);
        }

        .icon-circle {
            width: 50px;
            height: 50px;
            background: var(--primary-glow);
            color: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 1.5rem;
        }

        /* Detailed Content */
        .policy-content {
            max-width: 850px;
            margin: 0 auto;
            padding: 40px 20px 100px;
        }

        .policy-section {
            margin-bottom: 60px;
        }

        .policy-section h2 {
            font-size: 1.8rem;
            color: var(--bg-dark);
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .policy-section h2::before {
            content: '';
            width: 4px;
            height: 24px;
            background: var(--primary);
            border-radius: 10px;
        }

        .last-updated {
            display: inline-block;
            background: #e2e8f0;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-light);
            margin-bottom: 20px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .policy-hero h1 { font-size: 2.5rem; }
            .summary-container { margin-top: -40px; }
        }
    </style>
</head>
<body>

    <?php include_once("./header.php"); ?>

    <section class="policy-hero">
        <h1>Privacy Policy</h1>
        <p>Your privacy is our priority. Here is how we handle your data.</p>
    </section>

    <div class="summary-container">
        <div class="summary-card">
            <div class="icon-circle">🛡️</div>
            <h3>Data Safety</h3>
            <p>We use industry-standard encryption to keep your personal info secure.</p>
        </div>
        <div class="summary-card">
            <div class="icon-circle">🚫</div>
            <h3>No Selling</h3>
            <p>We never sell your data to third parties for marketing purposes.</p>
        </div>
        <div class="summary-card">
            <div class="icon-circle">⚙️</div>
            <h3>Your Control</h3>
            <p>You have full access to view, edit, or delete your data at any time.</p>
        </div>
    </div>

    <main class="policy-content">
        <span class="last-updated">Last Updated: April 2026</span>

        <article class="policy-section">
            <h2>1. Information We Collect</h2>
            <p>When you use our portal, we collect information that you provide directly to us, such as when you create an account, update your profile, or apply for opportunities. This may include:</p>
            <ul>
                <li><strong>Account Details:</strong> Name, email address, and password.</li>
                <li><strong>Professional Data:</strong> Resumes, education history, and skills.</li>
                <li><strong>Usage Information:</strong> How you interact with our services via log files and cookies.</li>
            </ul>
        </article>

        <article class="policy-section">
            <h2>2. How We Use Your Data</h2>
            <p>Our primary goal is to provide a seamless connection between talent and opportunities. We use your information to:</p>
            <ul>
                <li>Facilitate applications between users and providers.</li>
                <li>Send technical notices, updates, and security alerts.</li>
                <li>Improve our platform's algorithms to suggest better matches.</li>
            </ul>
        </article>

        <article class="policy-section">
            <h2>3. Security Measures</h2>
            <p>We implement a variety of security measures to maintain the safety of your personal information. We use SSL (Secure Sockets Layer) technology to ensure that your data is encrypted and protected during transmission.</p>
        </article>

        <article class="policy-section">
            <h2>4. Your Rights</h2>
            <p>Depending on your location, you may have the right to request access to the personal data we hold about you, to request that we rectify inaccuracies, or to request the deletion of your data under certain circumstances.</p>
        </article>
    </main>

    <?php include_once("./footer.php"); ?>

</body>
</html>