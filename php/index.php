<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hero Intern | Launch Your Career</title>
    <link rel="stylesheet" href="../styles/index.css">
    <style>
        /* Embedded styles to ensure "Good Space Consumption" immediately */
        :root {
            --primary: #6366f1;
            --dark: #1e293b;
            --light: #f8fafc;
        }

        body {
            margin: 0;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-color: var(--light);
            color: var(--dark);
            line-height: 1.6;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem 5%;
            background: #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--primary);
        }

        .menu {
            display: flex;
            list-style: none;
            gap: 2rem;
        }

        .menu a {
            text-decoration: none;
            color: var(--dark);
            font-weight: 500;
            transition: color 0.3s;
        }

        .menu a:hover {
            color: var(--primary);
        }

        .hero-section {
            display: flex;
            min-height: 80vh;
            align-items: center;
            padding: 0 8%;
            gap: 4rem;
        }

        .left, .right {
            flex: 1;
        }

        .left h2 {
            font-size: 3.5rem;
            line-height: 1.1;
            margin-bottom: 1.5rem;
        }

        .left h2 span {
            color: var(--primary);
            display: block;
        }

        .left p {
            font-size: 1.1rem;
            color: #64748b;
            margin-bottom: 2.5rem;
            max-width: 500px;
        }

        .right {
            background: #fff;
            padding: 3rem;
            border-radius: 20px;
            box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);
            text-align: center;
            border: 1px solid #e2e8f0;
        }

        button {
            cursor: pointer;
            padding: 1rem 2.5rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
            border: none;
        }

        button[name="get_started"] {
            background: var(--primary);
            color: white;
            font-size: 1.1rem;
        }

        button[name="get_started"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.4);
        }

        .apply-btn {
            background: var(--dark);
            color: white;
            width: 100%;
            margin-top: 1rem;
        }

        .rocket {
            font-size: 3rem;
            display: block;
            margin-bottom: 1rem;
        }

        @media (max-width: 768px) {
            .hero-section {
                flex-direction: column;
                padding: 4rem 5%;
                text-align: center;
            }
            .left h2 { font-size: 2.5rem; }
            .left p { margin: 0 auto 2rem; }
        }
    </style>
</head>

<body>
    <header>
        <div class="logo">🦄 Hero Intern</div>
        <nav>
            <ul class="menu">
                <li> <a href="#">Home</a> </li>
                <li> <a href="../admin/admin_login.php">Admin</a></li>
                <li> <a href="../php/contact.php">Contact</a></li>
                <li> <a href="../php/faq.php">FAQs</a></li>
                <li> <a href="../php/careers.php">Careers</a></li>
            </ul>
        </nav>
    </header>

    <main class="hero-section">
        <div class="left">
            <h2>BUILD YOUR <span>FUTURE HERE.</span></h2>
            <p>Connect with top-tier companies and kickstart your professional journey. Access exclusive internships tailored to your BCA/MCA expertise.</p>
            <form method="post" action="./register.php">
                <button type="submit" name="get_started">Get Started Today</button>
            </form>
        </div>

        <div class="right">
            <span class="rocket">🚀</span>
            <h4>Welcome Back!</h4>
            <p style="font-size: 0.9rem; color: #64748b;">Ready to continue your application?</p>
            <form method="post" action="./login.php">
                <button class="apply-btn" type="submit" name="apply_now">LOGIN TO PORTAL</button>
            </form>
        </div>
    </main>

    <?php include_once("./footer.php"); ?>

</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['get_started'])) {
        echo "<script>alert('Get Started Clicked!');</script>";
    }
    if (isset($_POST['apply_now'])) {
        echo "<script>alert('Apply Now Clicked!');</script>";
    }
}
?>