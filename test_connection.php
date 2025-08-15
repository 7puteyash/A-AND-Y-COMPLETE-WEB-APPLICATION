<?php
require_once 'config.php';

try {
    // Test leads table
    $stmt = $pdo->query("SHOW TABLES LIKE 'leads'");
    $leadsTableExists = $stmt->rowCount() > 0;
    echo "Leads table exists: " . ($leadsTableExists ? "Yes" : "No") . "\n";

    if ($leadsTableExists) {
        $stmt = $pdo->query("DESCRIBE leads");
        echo "\nLeads table structure:\n";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo $row['Field'] . " - " . $row['Type'] . "\n";
        }
    }

    // Test admin_users table
    $stmt = $pdo->query("SHOW TABLES LIKE 'admin_users'");
    $adminTableExists = $stmt->rowCount() > 0;
    echo "\nAdmin users table exists: " . ($adminTableExists ? "Yes" : "No") . "\n";

    if ($adminTableExists) {
        $stmt = $pdo->query("DESCRIBE admin_users");
        echo "\nAdmin users table structure:\n";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo $row['Field'] . " - " . $row['Type'] . "\n";
        }
    }

} catch (PDOException $e) {
    die("Error checking tables: " . $e->getMessage());
}
?>
