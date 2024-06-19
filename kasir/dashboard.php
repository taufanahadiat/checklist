<?php
// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION["username"])) {
    // Redirect to login page if not logged in
    header("location: login.php");
    exit();
}

// Get username from session
$username = $_SESSION["username"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Your App Name</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header class="dashboard-header">
        <div class="container">
            <h1>Dashboard</h1>
            <nav>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Articles</a></li>
                    <li><a href="#">Settings</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="dashboard-container">
        <aside class="sidebar">
            <ul>
                <li><a href="#">Dashboard</a></li>
                <li><a href="#">Articles</a></li>
                <li><a href="#">Analytics</a></li>
                <li><a href="#">Settings</a></li>
            </ul>
        </aside>

        <main class="main-content">
            <div class="container">
                <h2>Welcome, <?php echo htmlspecialchars($username); ?>!</h2>
                <div class="article-list">
                    <div class="article-item">
                        <h3>Article Title</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla pretium libero in augue elementum, a ullamcorper lacus sodales.</p>
                    </div>
                    <div class="article-item">
                        <h3>Another Article Title</h3>
                        <p>Vestibulum vehicula lacus a magna vehicula, vitae bibendum velit bibendum. Proin nec sapien vehicula, rutrum libero ac, pharetra libero.</p>
                    </div>
                    <!-- Add more articles as needed -->
                </div>
            </div>
        </main>
    </div>
</body>
</html>
