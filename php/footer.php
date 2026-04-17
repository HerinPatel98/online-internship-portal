<style>
    :root {
        --footer-bg: #0f172a;
        --footer-text: #94a3b8;
        --footer-heading: #ffffff;
        --accent: #6366f1;
        --accent-hover: #818cf8;
    }

    footer {
        background-color: var(--footer-bg);
        color: var(--footer-text);
        font-family: 'Inter', sans-serif;
        padding-top: 4rem;
        margin-top: 5rem;
    }

    /* Banner: Next Steps CTA */
    .footer-top-banner {
        max-width: 1200px;
        margin: -8rem auto 4rem auto;
        background: linear-gradient(135deg, var(--accent), #4338ca);
        padding: 3rem;
        border-radius: 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.2);
        color: white;
    }

    .banner-content h2 {
        font-size: 2rem;
        margin: 0 0 0.5rem 0;
    }

    .banner-content p {
        opacity: 0.9;
        margin: 0;
    }

    .contact-btn {
        background: white;
        padding: 1rem 2rem;
        border-radius: 12px;
        text-decoration: none;
        color: var(--accent);
        font-weight: 700;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .contact-btn:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 15px rgba(0,0,0,0.1);
    }

    .contact-btn a {
        text-decoration: none;
        color: inherit;
    }

    /* Main Footer Layout */
    .footer-main {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1.5fr;
        gap: 3rem;
        padding: 0 2rem 4rem 2rem;
    }

    .footer-column h3, .footer-column h4 {
        color: var(--footer-heading);
        margin-bottom: 1.5rem;
    }

    .footer-column h3 {
        font-size: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .footer-column p {
        font-size: 0.95rem;
        line-height: 1.6;
    }

    .footer-column ul {
        list-style: none;
        padding: 0;
    }

    .footer-column ul li {
        margin-bottom: 0.8rem;
    }

    .footer-column ul li a {
        color: var(--footer-text);
        text-decoration: none;
        transition: all 0.2s;
        font-size: 0.9rem;
    }

    .footer-column ul li a:hover {
        color: var(--accent);
        padding-left: 5px;
    }

    /* Newsletter / Social Section */
    .newsletter-form {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
    }

    .newsletter-form input {
        background: #1e293b;
        border: 1px solid #334155;
        padding: 0.6rem;
        border-radius: 8px;
        color: white;
        flex: 1;
    }

    .social-icons {
        display: flex;
        gap: 1rem;
    }

    .social-icons a {
        background: #1e293b;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        color: white;
        text-decoration: none;
        transition: 0.3s;
    }

    .social-icons a:hover {
        background: var(--accent);
        transform: translateY(-3px);
    }

    /* Bottom Bar */
    .footer-bottom {
        border-top: 1px solid #1e293b;
        padding: 2rem;
        text-align: center;
        font-size: 0.85rem;
    }

    @media (max-width: 900px) {
        .footer-top-banner {
            flex-direction: column;
            text-align: center;
            gap: 2rem;
            margin-top: -4rem;
        }
        .footer-main {
            grid-template-columns: 1fr 1fr;
        }
    }
</style>

<footer>
    <div class="footer-top-banner">
        <div class="banner-content">
            <h2>Ready for your next career move?</h2>
            <p>Join 5,000+ students already finding internships this semester.</p>
        </div>
        <button class="contact-btn"><a href="../php/contact.php">Contact Us Today</a></button>
    </div>

    <div class="footer-main">
        <div class="footer-column">
            <h3>🦄 Hero Intern</h3>
            <p>Empowering the next generation of developers and creators. We bridge the gap between academic learning and industry excellence.</p>
        </div>

        <div class="footer-column">
            <h4>Platform</h4>
            <ul>
                <li><a href="#">Find Internships</a></li>
                <li><a href="#">Employer Portal</a></li>
                <li><a href="./UserDetail.php">Success Stories</a></li>
                <li><a href="#">Resource Hub</a></li>
            </ul>
        </div>

        <div class="footer-column">
            <h4>Company</h4>
            <ul>
                <li><a href="../php/about.php">About Hero Intern</a></li>
                <li><a href="../php/about.php">Our Vision</a></li>
                <li><a href="../php/privacy.php">Privacy Policy</a></li>
                <li><a href="../php/terms.php">Terms of Service</a></li>
            </ul>
        </div>

        <div class="footer-column">
            <h4>Stay Updated</h4>
            <p style="font-size: 0.8rem; margin-bottom: 1rem;">Get the latest internship alerts in your inbox.</p>
            <form class="newsletter-form">
                <input type="email" placeholder="Email address" required>
                <button type="submit" style="background: var(--accent); border:none; color:white; padding: 0.5rem 1rem; border-radius:8px; cursor:pointer;">Go</button>
            </form>
            <div class="social-icons">
                <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                <a href="#" aria-label="Telegram"><i class="fab fa-telegram-plane"></i></a>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; <?php echo date("Y")
        ?> Hero Intern. All rights reserved. Designed for Excellence.</p>
    </div>
</footer>