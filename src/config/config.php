<?php
// General configuration settings for the application

// Define the base URL of the application
define('BASE_URL', 'http://localhost/agency-backend/');

// Enable error reporting for development
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Set the timezone
date_default_timezone_set('America/New_York');

// Define other configuration constants as needed
define('LOG_FILE', __DIR__ . '/../logs/error.log');
define('EMAIL_FROM', 'agency@ay.com');
define('EMAIL_SUBJECT', 'New Lead Submission');