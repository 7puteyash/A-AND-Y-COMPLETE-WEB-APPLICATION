<?php
require_once 'src/config/database.php';

try {
    // Test database connection
    echo "Database connection successful!\n";
    
    // Get all tables in the database
    $query = "SHOW TABLES";
    $stmt = $pdo->query($query);
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    echo "\nExisting tables in the database:\n";
    foreach ($tables as $table) {
        echo "- $table\n";
        
        // Show table structure
        $structure = $pdo->query("DESCRIBE $table")->fetchAll(PDO::FETCH_ASSOC);
        echo "  Columns:\n";
        foreach ($structure as $column) {
            echo "    {$column['Field']} ({$column['Type']})\n";
        }
        echo "\n";
    }
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
