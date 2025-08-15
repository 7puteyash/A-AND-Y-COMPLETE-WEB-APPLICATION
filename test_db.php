<?php
require_once 'db_functions.php';

// Test insertLead function
echo "Testing insertLead function...\n";
$result = insertLead(
    "John Doe",
    "john@example.com",
    "1234567890",
    "I'm interested in digital marketing services"
);
echo $result ? "Lead inserted successfully\n" : "Failed to insert lead\n";

// Test getLeads function
echo "\nTesting getLeads function...\n";
$leads = getLeads();
echo "Found " . count($leads) . " leads:\n";
foreach ($leads as $lead) {
    echo "-------------------\n";
    echo "Name: " . $lead['name'] . "\n";
    echo "Email: " . $lead['email'] . "\n";
    echo "Phone: " . $lead['phone'] . "\n";
    echo "Message: " . $lead['message'] . "\n";
    echo "Created at: " . $lead['created_at'] . "\n";
}

// Test insertAdmin function (commented out for safety)
/*
echo "\nTesting insertAdmin function...\n";
$result = insertAdmin(
    "admin",
    password_hash("your_password_here", PASSWORD_DEFAULT)
);
echo $result ? "Admin user inserted successfully\n" : "Failed to insert admin user\n";
*/
