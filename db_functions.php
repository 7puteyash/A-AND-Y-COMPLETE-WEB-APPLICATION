<?php
require_once 'config.php';

/**
 * Insert a new lead into the database
 */
function insertLead($name, $email, $phone, $message) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("INSERT INTO leads (name, email, phone, message) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$name, $email, $phone, $message]);
    } catch (PDOException $e) {
        error_log("Error inserting lead: " . $e->getMessage());
        return false;
    }
}

/**
 * Get all leads from the database
 */
function getLeads() {
    global $pdo;
    try {
        $stmt = $pdo->query("SELECT * FROM leads ORDER BY created_at DESC");
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log("Error fetching leads: " . $e->getMessage());
        return [];
    }
}

/**
 * Insert a new admin user into the database
 */
function insertAdmin($username, $password_hash) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("INSERT INTO admin_users (username, password_hash) VALUES (?, ?)");
        return $stmt->execute([$username, $password_hash]);
    } catch (PDOException $e) {
        error_log("Error inserting admin user: " . $e->getMessage());
        return false;
    }
}
