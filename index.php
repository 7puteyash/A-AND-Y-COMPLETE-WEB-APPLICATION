<?php
/**
 * Main entry point for the A&Y Digital Excellence website
 * Handles routing and page loading
 */

// Start output buffering to prevent header issues
ob_start();

// Start session before any output
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Define base path constant
define('ABSPATH', dirname(__FILE__));

// Load configuration
require_once 'config/config.php';

// Get the requested page from URL
$current_page = $_GET['page'] ?? 'home';

// Sanitize the page parameter
$current_page = strtolower(preg_replace('/[^a-zA-Z0-9-]/', '', $current_page));

// Set the default page title
$page_title = $valid_pages[$current_page] ?? '404 Not Found';

// Include header
require_once INCLUDES_PATH . 'header.php';

// Load the requested page
if (array_key_exists($current_page, $valid_pages)) {
    $page_file = PAGES_PATH . $current_page . '.php';
    if (file_exists($page_file)) {
        require_once $page_file;
    } else {
        // Show 404 if page file doesn't exist
        require_once PAGES_PATH . '404.php';
    }
} else {
    // Show 404 for invalid pages
    require_once PAGES_PATH . '404.php';
}

// Include footer
require_once INCLUDES_PATH . 'footer.php';

// Flush output buffer
ob_end_flush();
?>
