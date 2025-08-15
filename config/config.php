<?php
/**
 * Main configuration file
 * Contains important constants and settings
 */

// Prevent direct access to this file
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

// Site configuration
define('SITE_NAME', 'A&Y Digital Marketing Agency');
define('SITE_URL', 'http://localhost/A-AND-Y-WEB-APPLICATION');

// Directory paths
define('INCLUDES_PATH', dirname(__DIR__) . '/includes/');
define('PAGES_PATH', INCLUDES_PATH . 'pages/');
define('ASSETS_PATH', dirname(__DIR__) . '/assets/');

// List of valid pages
$valid_pages = [
    'home' => 'Home',
    'services' => 'Services',
    'about' => 'About Us',
    'work' => 'Our Work',
    'plans' => 'Plans',
    'contact' => 'Contact Us'
];
