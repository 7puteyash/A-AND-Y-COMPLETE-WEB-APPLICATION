<?php
// Database configuration
$host = 'localhost';
$dbname = 'ay_agency';
$username = 'root';
$password = '';

try {
    // Create database if it doesn't exist
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create database
    $pdo->exec("CREATE DATABASE IF NOT EXISTS $dbname");
    echo "Database created or already exists\n";
    
    // Connect to the specific database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
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
    
    // Test insert into leads
    $stmt = $pdo->prepare("INSERT INTO leads (name, email, phone, message) VALUES (?, ?, ?, ?)");
    $result = $stmt->execute(['Test User', 'test@example.com', '1234567890', 'Test Message']);
    echo $result ? "Test lead inserted successfully!\n" : "Failed to insert test lead\n";
    
    // Test select from leads
    $stmt = $pdo->query("SELECT * FROM leads");
    $leads = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "Number of leads in database: " . count($leads) . "\n";
    
    // Show table structures
    echo "\nLeads table structure:\n";
    $stmt = $pdo->query("DESCRIBE leads");
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "{$row['Field']} - {$row['Type']}\n";
    }
    
    echo "\nAdmin users table structure:\n";
    $stmt = $pdo->query("DESCRIBE admin_users");
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "{$row['Field']} - {$row['Type']}\n";
    }

} catch(PDOException $e) {
    die("Error: " . $e->getMessage() . "\n");
}
?>
