<?php
require_once '../config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Test Page</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <style>
        .test-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
        }
        .test-section {
            background: rgba(255,255,255,0.1);
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
        }
        .success { color: #4CAF50; }
        .error { color: #f44336; }
    </style>
</head>
<body>
    <div class="test-container">
        <h1>System Test Results</h1>

        <!-- Database Connection Test -->
        <div class="test-section">
            <h2>1. Database Connection</h2>
            <?php
            try {
                $pdo->query("SELECT 1");
                echo "<p class='success'>✅ Database connection successful</p>";
            } catch (PDOException $e) {
                echo "<p class='error'>❌ Database connection failed: " . $e->getMessage() . "</p>";
            }
            ?>
        </div>

        <!-- Tables Test -->
        <div class="test-section">
            <h2>2. Database Tables</h2>
            <?php
            try {
                // Check leads table
                $stmt = $pdo->query("SHOW TABLES LIKE 'leads'");
                $leadsExists = $stmt->rowCount() > 0;
                echo $leadsExists ? 
                    "<p class='success'>✅ Leads table exists</p>" : 
                    "<p class='error'>❌ Leads table missing</p>";

                // Check admin_users table
                $stmt = $pdo->query("SHOW TABLES LIKE 'admin_users'");
                $adminExists = $stmt->rowCount() > 0;
                echo $adminExists ? 
                    "<p class='success'>✅ Admin users table exists</p>" : 
                    "<p class='error'>❌ Admin users table missing</p>";
            } catch (PDOException $e) {
                echo "<p class='error'>❌ Error checking tables: " . $e->getMessage() . "</p>";
            }
            ?>
        </div>

        <!-- File Structure Test -->
        <div class="test-section">
            <h2>3. File Structure</h2>
            <?php
            $files = [
                '../config.php' => 'Configuration file',
                '../assets/css/style.css' => 'CSS file',
                '../assets/js/main.js' => 'JavaScript file',
                '../includes/head.php' => 'Header template',
                '../includes/footer.php' => 'Footer template',
                '../src/api/contact.php' => 'Contact API',
            ];

            foreach ($files as $path => $description) {
                echo file_exists($path) ? 
                    "<p class='success'>✅ {$description} found</p>" : 
                    "<p class='error'>❌ {$description} missing</p>";
            }
            ?>
        </div>

        <!-- CSS Test -->
        <div class="test-section">
            <h2>4. CSS Styling Test</h2>
            <div class="btn btn-primary" style="margin: 10px 0;">Test Button</div>
            <div class="service-card" style="margin: 10px 0;">
                <h3>Test Service Card</h3>
                <p>This card should have proper styling and hover effects.</p>
            </div>
        </div>

        <!-- JavaScript Test -->
        <div class="test-section">
            <h2>5. JavaScript Functionality</h2>
            <p>Scroll position: <span id="scrollPosition">0</span>px</p>
            <button onclick="showAlert('Test alert', 'success')" class="btn btn-primary">Test Alert</button>
        </div>

        <!-- Form Test -->
        <div class="test-section">
            <h2>6. Contact Form Test</h2>
            <form id="testForm" class="contact-form">
                <div>
                    <input type="text" id="name" name="name" placeholder="Name" required>
                </div>
                <div>
                    <input type="email" id="email" name="email" placeholder="Email" required>
                </div>
                <div>
                    <textarea id="message" name="message" placeholder="Message" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Test Submit</button>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="/assets/js/main.js"></script>
    <script>
        // Display scroll position
        window.addEventListener('scroll', () => {
            document.getElementById('scrollPosition').textContent = window.scrollY;
        });
    </script>
</body>
</html>
