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
function insertAdmin($username, $password) {
    global $pdo;
    try {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO admin_users (username, password_hash) VALUES (?, ?)");
        return $stmt->execute([$username, $password_hash]);
    } catch (PDOException $e) {
        error_log("Error inserting admin user: " . $e->getMessage());
        return false;
    }
}

/**
 * Verify admin login
 */
function verifyAdminLogin($username, $password) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("SELECT * FROM admin_users WHERE username = ? LIMIT 1");
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user['password_hash'])) {
            return $user;
        }
        return false;
    } catch (PDOException $e) {
        error_log("Error verifying admin login: " . $e->getMessage());
        return false;
    }
}
