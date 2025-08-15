<?php
require_once '../db_functions.php';

// Test insertLead function
echo "Testing insertLead function...\n";
$result = insertLead(
    "Test User",
    "test@example.com",
    "1234567890",
    "This is a test message"
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
