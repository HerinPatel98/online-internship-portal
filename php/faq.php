<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frequently Asked Questions | Hero Intern</title>
    <style>
        :root {
            --primary: #6366f1;
            --dark: #0f172a;
            --text: #334155;
            --light-bg: #f8fafc;
        }

        body {
            margin: 0;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-color: var(--light-bg);
            color: var(--text);
            line-height: 1.6;
        }

        .faq-container {
            max-width: 800px;
            margin: 80px auto;
            padding: 0 20px;
        }

        .faq-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .faq-header h1 {
            font-size: 2.5rem;
            color: var(--dark);
            margin-bottom: 10px;
        }

        .faq-header p {
            color: #64748b;
            font-size: 1.1rem;
        }

        /* Accordion Styles */
        .faq-item {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            margin-bottom: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .faq-item:hover {
            border-color: var(--primary);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
        }

        .faq-question {
            padding: 20px 25px;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            background: none;
            border: none;
            text-align: left;
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--dark);
        }

        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out, padding 0.3s ease;
            background-color: #fcfcfd;
            padding: 0 25px;
            font-size: 0.95rem;
            color: #64748b;
            border-top: 0 solid #e2e8f0;
        }

        /* Active State */
        .faq-item.active {
            border-color: var(--primary);
        }

        .faq-item.active .faq-answer {
            max-height: 300px;
            padding: 20px 25px;
            border-top-width: 1px;
        }

        .faq-item.active .arrow {
            transform: rotate(180deg);
        }

        .arrow {
            transition: transform 0.3s ease;
            color: var(--primary);
        }

        .contact-cta {
            text-align: center;
            margin-top: 60px;
            padding: 40px;
            background: white;
            border-radius: 20px;
            border: 1px solid #e2e8f0;
        }

        .btn-contact {
            display: inline-block;
            margin-top: 15px;
            background: var(--primary);
            color: white;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-contact:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>

    <?php include_once("./header.php"); ?>

    <main class="faq-container">
        <div class="faq-header">
            <h1>Common Questions</h1>
            <p>Everything you need to know about the internship portal.</p>
        </div>

        <div class="faq-list">
            <div class="faq-item">
                <button class="faq-question">
                    How do I apply for an internship?
                    <span class="arrow">▼</span>
                </button>
                <div class="faq-answer">
                    Simply register for an account, complete your professional profile with your skills and education, and click the "Apply Now" button on any active internship listing.
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question">
                    Is there a fee for students to join?
                    <span class="arrow">▼</span>
                </button>
                <div class="faq-answer">
                    Basic registration and profile creation are free. Some specialized certification courses may have a nominal fee as listed in the course details.
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question">
                    Can I apply for multiple positions?
                    <span class="arrow">▼</span>
                </button>
                <div class="faq-answer">
                    Yes, you can apply for multiple internships, jobs, and courses. You can track all your active applications in your personal User Dashboard.
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question">
                    How will I know if I am selected?
                    <span class="arrow">▼</span>
                </button>
                <div class="faq-answer">
                    You will receive an email notification if an employer moves your application forward. You can also check the status of your applications directly in the Dashboard section.
                </div>
            </div>
        </div>

        <div class="contact-cta">
            <h3>Still have questions?</h3>
            <p>Can't find the answer you're looking for? Reach out to our support team.</p>
            <a href="./contact.php" class="btn-contact">Contact Support</a>
        </div>
    </main>

    <script>
        // Simple JavaScript for Accordion Functionality
        document.querySelectorAll('.faq-question').forEach(button => {
            button.addEventListener('click', () => {
                const faqItem = button.parentElement;
                
                // Close other items (optional - comment out to keep multiple open)
                document.querySelectorAll('.faq-item').forEach(item => {
                    if (item !== faqItem) item.classList.remove('active');
                });

                faqItem.classList.toggle('active');
            });
        });
    </script>

    <?php include_once("./footer.php"); ?>

</body>
</html>