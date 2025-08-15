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

// Test admin functions
echo "\nTesting admin functions...\n";
// First create an admin user
$result = insertAdmin("testadmin", "test123");
echo $result ? "Admin user created successfully\n" : "Failed to create admin user\n";

// Then test login
$admin = verifyAdminLogin("testadmin", "test123");
echo $admin ? "Admin login successful\n" : "Admin login failed\n";
