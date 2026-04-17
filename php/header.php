<style>
    .nav-wrapper {
        background: #ffffff;
        padding: 1rem 5%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        position: sticky;
        top: 0;
        z-index: 1000;
    }
    .nav-logo { font-weight: 800; font-size: 1.4rem; color: #6366f1; text-decoration: none; }
    .nav-links { display: flex; gap: 2rem; list-style: none; margin: 0; }
    .nav-links a { 
        text-decoration: none; 
        color: #1e293b; 
        font-weight: 500; 
        transition: 0.3s;
    }
    .nav-links a:hover { color: #6366f1; }
    .active { color: #6366f1 !important; border-bottom: 2px solid #6366f1; }
</style>

<nav class="nav-wrapper">
    <a href="../php/index.php" class="nav-logo">🦄 Hero Intern</a>
    <ul class="nav-links">
        <li><a href="../php/index.php">Home</a></li>
        <li><a href="../php/about.php">About</a></li>
        <li><a href="../php/contact.php">Contact</a></li>
        <li><a href="../php/privacy.php">Privacy</a></li>
        <li><a href="../php/terms.php">Terms</a></li>
        <li><a href="../admin/admin_login.php" style="background: #0f172a; color: white; padding: 8px 15px; border-radius: 6px;">Admin</a></li>
    </ul>
</nav>