<?php
require_once 'config.php';

try {
    // Create leads table
    $pdo->exec("CREATE TABLE IF NOT EXISTS leads (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(150) NOT NULL,
        phone VARCHAR(20) NOT NULL,
        message TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    echo "Leads table created successfully!\n";

    // Create admin_users table
    $pdo->exec("CREATE TABLE IF NOT EXISTS admin_users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        password_hash VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    echo "Admin users table created successfully!\n";

    // Create a default admin user (optional)
    $defaultUsername = "admin";
    $defaultPassword = "admin123"; // You should change this!
    
    // Check if admin user already exists
    $stmt = $pdo->prepare("SELECT id FROM admin_users WHERE username = ?");
    $stmt->execute([$defaultUsername]);
    
    if (!$stmt->fetch()) {
        $password_hash = password_hash($defaultPassword, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO admin_users (username, password_hash) VALUES (?, ?)");
        $stmt->execute([$defaultUsername, $password_hash]);
        echo "Default admin user created with username: 'admin' and password: 'admin123'\n";
        echo "IMPORTANT: Please change these credentials immediately for security!\n";
    }

} catch (PDOException $e) {
    die("Database setup failed: " . $e->getMessage());
}
