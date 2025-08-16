<?php
// Load environment configuration
require_once 'bootstrap.php';

try {
    // Create database connection
    $pdo = new PDO("mysql:host=" . DB_HOST, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create database if it doesn't exist
    $pdo->exec("CREATE DATABASE IF NOT EXISTS " . DB_NAME);
    echo "✓ Database '" . DB_NAME . "' created or already exists\n";
    
    // Connect to the specific database
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    
    // Create leads table with additional security fields
    $pdo->exec("CREATE TABLE IF NOT EXISTS leads (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(150) NOT NULL,
        phone VARCHAR(20) NOT NULL,
        message TEXT,
        ip_address VARCHAR(45),
        user_agent TEXT,
        status ENUM('new', 'contacted', 'converted', 'closed') DEFAULT 'new',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        INDEX idx_email (email),
        INDEX idx_status (status),
        INDEX idx_created (created_at)
    )");
    echo "✓ Leads table created/updated successfully!\n";

    // Create admin_users table with enhanced security
    $pdo->exec("CREATE TABLE IF NOT EXISTS admin_users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        email VARCHAR(150),
        password_hash VARCHAR(255) NOT NULL,
        last_login TIMESTAMP NULL,
        login_attempts INT DEFAULT 0,
        locked_until TIMESTAMP NULL,
        reset_token VARCHAR(255) NULL,
        reset_expires TIMESTAMP NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        INDEX idx_username (username),
        INDEX idx_email (email)
    )");
    echo "✓ Admin users table created/updated successfully!\n";
    
    // Create sessions table for better session management
    $pdo->exec("CREATE TABLE IF NOT EXISTS user_sessions (
        id VARCHAR(128) PRIMARY KEY,
        user_id INT,
        ip_address VARCHAR(45),
        user_agent TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        last_activity TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        expires_at TIMESTAMP NULL,
        FOREIGN KEY (user_id) REFERENCES admin_users(id) ON DELETE CASCADE,
        INDEX idx_user_id (user_id),
        INDEX idx_expires (expires_at)
    )");
    echo "✓ User sessions table created successfully!\n";
    
    // Create audit log table
    $pdo->exec("CREATE TABLE IF NOT EXISTS audit_log (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NULL,
        action VARCHAR(100) NOT NULL,
        table_name VARCHAR(50),
        record_id INT,
        old_values JSON,
        new_values JSON,
        ip_address VARCHAR(45),
        user_agent TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        INDEX idx_user_id (user_id),
        INDEX idx_action (action),
        INDEX idx_created (created_at)
    )");
    echo "✓ Audit log table created successfully!\n";

    // Check if default admin exists and create/update if needed
    $stmt = $pdo->prepare("SELECT id FROM admin_users WHERE username = ?");
    $stmt->execute(['admin']);
    
    if (!$stmt->fetch()) {
        // Generate a secure random password
        $newPassword = bin2hex(random_bytes(8)); // 16 character password
        $password_hash = password_hash($newPassword, PASSWORD_DEFAULT);
        
        $stmt = $pdo->prepare("INSERT INTO admin_users (username, password_hash) VALUES (?, ?)");
        $stmt->execute(['admin', $password_hash]);
        
        echo "✓ Default admin user created!\n";
        echo "📧 Username: admin\n";
        echo "🔐 Password: $newPassword\n";
        echo "⚠️  IMPORTANT: Save this password and change it immediately after first login!\n";
        
        // Save credentials to secure file
        file_put_contents(__DIR__ . '/admin_credentials.txt', 
            "Username: admin\nPassword: $newPassword\nCreated: " . date('Y-m-d H:i:s') . "\n\nIMPORTANT: Delete this file after first login!"
        );
        echo "📄 Credentials saved to: admin_credentials.txt\n";
    } else {
        echo "✓ Admin user already exists\n";
    }
    
    // Test database connection
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM leads");
    $count = $stmt->fetch()['count'];
    echo "✓ Database test successful - {$count} leads in database\n";
    
    echo "\n🎉 Database setup completed successfully!\n";

} catch(PDOException $e) {
    echo "❌ Database error: " . $e->getMessage() . "\n";
    exit(1);
}
?>
