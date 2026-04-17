<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | Professional Support</title>
    <style>
        :root {
            --primary: #6366f1;
            --primary-hover: #4f46e5;
            --dark: #0f172a;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --bg-light: #f8fafc;
        }

        body {
            margin: 0;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-color: var(--bg-light);
            color: var(--text-main);
            line-height: 1.6;
        }

        .contact-container {
            max-width: 1200px;
            margin: 80px auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            gap: 80px;
            align-items: start;
        }

        /* Left Side: Info */
        .contact-info h1 {
            font-size: 3rem;
            color: var(--dark);
            margin-bottom: 20px;
            letter-spacing: -0.02em;
        }

        .contact-info p {
            font-size: 1.1rem;
            color: var(--text-muted);
            margin-bottom: 40px;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 30px;
        }

        .icon-box {
            width: 50px;
            height: 50px;
            background: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
        }

        .info-text h4 {
            margin: 0;
            color: var(--dark);
            font-size: 1.1rem;
        }

        .info-text span {
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        /* Right Side: Form */
        .contact-form-card {
            background: #ffffff;
            padding: 40px;
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08);
            border: 1px solid #e2e8f0;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--dark);
        }

        .form-group input, .form-group textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            font-family: inherit;
            font-size: 1rem;
            transition: all 0.3s;
            box-sizing: border-box;
        }

        .form-group input:focus, .form-group textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        }

        .submit-btn {
            width: 100%;
            background: var(--primary);
            color: white;
            padding: 14px;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: 0.3s;
        }

        .submit-btn:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
        }

        @media (max-width: 900px) {
            .contact-container {
                grid-template-columns: 1fr;
                margin: 40px auto;
                gap: 40px;
            }
            .contact-info { text-align: center; }
            .info-item { justify-content: center; text-align: left; }
        }
    </style>
</head>
<body>

    <?php include_once("./header.php"); ?>

    <main class="contact-container">
        <div class="contact-info">
            <h1>Let's start a <br><span>conversation.</span></h1>
            <p>Have a question about the internship portal or need technical assistance? Our team is here to help you navigate your journey.</p>
            
            <div class="info-item">
                <div class="icon-box">📧</div>
                <div class="info-text">
                    <h4>Email us</h4>
                    <span>support@internportal.com</span>
                </div>
            </div>

            <div class="info-item">
                <div class="icon-box">📍</div>
                <div class="info-text">
                    <h4>Visit us</h4>
                    <span>Main Tech Campus, Floor 4</span>
                </div>
            </div>

            <div class="info-item">
                <div class="icon-box">🕒</div>
                <div class="info-text">
                    <h4>Working Hours</h4>
                    <span>Mon - Fri: 9:00 AM - 6:00 PM</span>
                </div>
            </div>
        </div>

        <div class="contact-form-card">
            <form action="#" method="POST">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" placeholder="Your Name" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="yourname@example.com" required>
                </div>

                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" id="subject" name="subject" placeholder="How can we help?" required>
                </div>

                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" rows="5" placeholder="Tell us more about your inquiry..." required></textarea>
                </div>

                <button type="submit" class="submit-btn">Send Message</button>
            </form>
        </div>
    </main>

    <?php include_once("./footer.php"); ?>

</body>
</html>