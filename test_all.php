<?php
echo "Starting comprehensive system tests...\n\n";

// 1. Test Database Connection
echo "1. Testing Database Connection:\n";
require_once 'src/config/database.php';
try {
    $pdo->query('SELECT 1');
    echo "✓ Database connection successful\n\n";
} catch (PDOException $e) {
    echo "✗ Database connection failed: " . $e->getMessage() . "\n\n";
}

// 2. Test Email Configuration
echo "2. Testing Email Configuration:\n";
require_once 'src/config/email.php';
try {
    if (isset($mail) && $mail instanceof PHPMailer\PHPMailer\PHPMailer) {
        echo "✓ Email configuration loaded successfully\n";
        echo "✓ SMTP Host: " . $mail->Host . "\n";
        echo "✓ SMTP Auth enabled: " . ($mail->SMTPAuth ? "Yes" : "No") . "\n\n";
    } else {
        echo "✗ Email configuration failed to load\n\n";
    }
} catch (Exception $e) {
    echo "✗ Email configuration error: " . $e->getMessage() . "\n\n";
}

// 3. Test Required Files
echo "3. Testing Required Files:\n";
$required_files = [
    'public/index.php',
    'includes/header.php',
    'includes/footer.php',
    'includes/pages/home.php',
    'includes/pages/about.php',
    'includes/pages/services.php',
    'includes/pages/contact.php',
    'assets/css/style.css',
    'assets/js/main.js'
];

foreach ($required_files as $file) {
    if (file_exists($file)) {
        echo "✓ Found: $file\n";
    } else {
        echo "✗ Missing: $file\n";
    }
}
echo "\n";

// 4. Test Database Tables Structure
echo "4. Testing Database Tables Structure:\n";
try {
    // Test leads table
    $stmt = $pdo->query("DESCRIBE leads");
    $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
    $required_leads_columns = ['id', 'name', 'email', 'phone', 'message', 'created_at'];
    $missing_leads_columns = array_diff($required_leads_columns, $columns);
    
    if (empty($missing_leads_columns)) {
        echo "✓ Leads table structure is correct\n";
    } else {
        echo "✗ Leads table missing columns: " . implode(', ', $missing_leads_columns) . "\n";
    }

    // Test admin_users table
    $stmt = $pdo->query("DESCRIBE admin_users");
    $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
    $required_admin_columns = ['id', 'username', 'password', 'created_at'];
    $missing_admin_columns = array_diff($required_admin_columns, $columns);
    
    if (empty($missing_admin_columns)) {
        echo "✓ Admin users table structure is correct\n";
    } else {
        echo "✗ Admin users table missing columns: " . implode(', ', $missing_admin_columns) . "\n";
    }
} catch (PDOException $e) {
    echo "✗ Error checking table structure: " . $e->getMessage() . "\n";
}
echo "\n";

// 5. Test Contact Form API
echo "5. Testing Contact Form API:\n";
$test_data = [
    'name' => 'Test User',
    'email' => 'test@example.com',
    'phone' => '1234567890',
    'message' => 'This is a test message'
];

try {
    $stmt = $pdo->prepare("INSERT INTO leads (name, email, phone, message) VALUES (:name, :email, :phone, :message)");
    $stmt->execute($test_data);
    echo "✓ Contact form database insertion working\n";
    
    // Clean up test data
    $pdo->exec("DELETE FROM leads WHERE email = 'test@example.com'");
} catch (PDOException $e) {
    echo "✗ Contact form database insertion failed: " . $e->getMessage() . "\n";
}

// 6. Check PHP Version and Extensions
echo "\n6. Checking PHP Configuration:\n";
echo "✓ PHP Version: " . phpversion() . "\n";
$required_extensions = ['pdo', 'pdo_mysql', 'openssl', 'mbstring'];
foreach ($required_extensions as $ext) {
    if (extension_loaded($ext)) {
        echo "✓ Extension loaded: $ext\n";
    } else {
        echo "✗ Missing extension: $ext\n";
    }
}

echo "\nTest completion summary:\n";
echo "=======================\n";
echo "Make sure all items above are marked with ✓\n";
echo "If you see any ✗, those items need attention.\n";
