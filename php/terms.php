<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms & Conditions | Platform Standards</title>
    <style>
        :root {
            --primary: #6366f1;
            --dark: #0f172a;
            --text: #334155;
            --bg-alt: #f1f5f9;
            --border: #e2e8f0;
        }

        body {
            margin: 0;
            font-family: 'Inter', system-ui, sans-serif;
            color: var(--text);
            background-color: #ffffff;
            line-height: 1.7;
        }

        /* Header / Hero */
        .terms-hero {
            padding: 80px 5%;
            background-color: var(--dark);
            color: white;
            text-align: center;
        }

        .terms-hero h1 {
            font-size: 3rem;
            margin-bottom: 10px;
        }

        .terms-hero p {
            opacity: 0.7;
            font-size: 1.1rem;
        }

        /* Layout Container */
        .terms-wrapper {
            max-width: 1000px;
            margin: 0 auto;
            padding: 60px 20px;
            display: grid;
            grid-template-columns: 1fr;
            gap: 40px;
        }

        /* Agreement Card */
        .agreement-banner {
            background: var(--bg-alt);
            padding: 25px;
            border-radius: 12px;
            border-left: 5px solid var(--primary);
            font-size: 0.95rem;
            margin-bottom: 40px;
        }

        /* Content Sections */
        .terms-section {
            margin-bottom: 50px;
        }

        .terms-section h2 {
            color: var(--dark);
            font-size: 1.6rem;
            margin-bottom: 20px;
            border-bottom: 2px solid var(--border);
            padding-bottom: 10px;
        }

        .terms-section h3 {
            color: var(--primary);
            font-size: 1.2rem;
            margin-top: 25px;
        }

        .terms-section p, .terms-section li {
            font-size: 1rem;
            margin-bottom: 15px;
        }

        .highlight-box {
            background: #fff;
            border: 1px solid var(--border);
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            font-style: italic;
        }

        /* Utility classes */
        .text-bold { font-weight: 700; color: var(--dark); }

        @media (max-width: 768px) {
            .terms-hero h1 { font-size: 2rem; }
        }
    </style>
</head>
<body>

    <?php include_once("./header.php"); ?>

    <section class="terms-hero">
        <h1>Terms & Conditions</h1>
        <p>Last Updated: April 13, 2026</p>
    </section>

    <main class="terms-wrapper">
        <div class="agreement-banner">
            By accessing this portal, you agree to be bound by these Terms and Conditions. Please read them carefully before using the platform services.
        </div>

        <div class="terms-section">
            <h2>1. Use of the Platform</h2>
            <p>This portal provides a service for connecting applicants with internship and professional opportunities. Users are granted a limited, non-exclusive license to access the content for personal, non-commercial use.</p>
            
            <h3>Eligibility</h3>
            <p>You must be at least 16 years of age to register an account. By creating an account, you represent that all information provided is accurate and truthful.</p>
        </div>

        <div class="terms-section">
            <h2>2. User Responsibilities</h2>
            <p>As a user of this platform, you agree <span class="text-bold">NOT</span> to:</p>
            <ul>
                <li>Provide false or misleading information in your professional profile or resume.</li>
                <li>Attempt to circumvent the platform’s security measures or access data not intended for you.</li>
                <li>Post or transmit any content that is unlawful, offensive, or infringes on intellectual property rights.</li>
            </ul>
            <div class="highlight-box">
                Note: We reserve the right to suspend or terminate any account that violates these standards without prior notice.
            </div>
        </div>

        <div class="terms-section">
            <h2>3. Intellectual Property</h2>
            <p>The layout, design, graphics, and code of this platform are the property of the portal operators. You may not reproduce, duplicate, or "scrape" our data for commercial purposes without explicit written consent.</p>
        </div>

        <div class="terms-section">
            <h2>4. Limitation of Liability</h2>
            <p>While we strive for excellence, the platform is provided "as is." We do not guarantee that the internship listings are always current or that every application will result in a placement. We are not liable for any direct or indirect damages arising from your use of the service.</p>
        </div>

        <div class="terms-section">
            <h2>5. Changes to Terms</h2>
            <p>We may update these terms from time to time to reflect changes in our services or legal requirements. Continued use of the platform after such changes constitutes your acceptance of the new terms.</p>
        </div>

        <div style="text-align: center; margin-top: 40px;">
            <p>Questions about our terms? <a href="./contact.php" style="color: var(--primary); font-weight: 600;">Contact Support</a></p>
        </div>
    </main>

    <?php include_once("./footer.php"); ?>

</body>
</html>