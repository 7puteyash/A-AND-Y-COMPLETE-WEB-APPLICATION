<?php
/**
 * CSRF Protection and Security Utilities
 */

class SecurityManager {
    
    /**
     * Generate CSRF token
     */
    public static function generateCSRFToken() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        
        return $_SESSION['csrf_token'];
    }
    
    /**
     * Verify CSRF token
     */
    public static function verifyCSRFToken($token) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }
    
    /**
     * Generate secure random string
     */
    public static function generateRandomString($length = 32) {
        return bin2hex(random_bytes($length / 2));
    }
    
    /**
     * Sanitize input data
     */
    public static function sanitizeInput($data) {
        if (is_array($data)) {
            return array_map([self::class, 'sanitizeInput'], $data);
        }
        
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
        return $data;
    }
    
    /**
     * Rate limiting check
     */
    public static function checkRateLimit($action, $limit = 5, $window = 300) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $key = "rate_limit_{$action}";
        $now = time();
        
        if (!isset($_SESSION[$key])) {
            $_SESSION[$key] = [];
        }
        
        // Remove old attempts outside the window
        $_SESSION[$key] = array_filter($_SESSION[$key], function($timestamp) use ($now, $window) {
            return ($now - $timestamp) < $window;
        });
        
        if (count($_SESSION[$key]) >= $limit) {
            return false;
        }
        
        $_SESSION[$key][] = $now;
        return true;
    }
    
    /**
     * Get client IP address
     */
    public static function getClientIP() {
        $ipKeys = ['HTTP_CF_CONNECTING_IP', 'HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'REMOTE_ADDR'];
        
        foreach ($ipKeys as $key) {
            if (!empty($_SERVER[$key])) {
                $ip = $_SERVER[$key];
                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
                    return $ip;
                }
            }
        }
        
        return $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    }
    
    /**
     * Log security event
     */
    public static function logSecurityEvent($event, $details = []) {
        $logEntry = [
            'timestamp' => date('Y-m-d H:i:s'),
            'event' => $event,
            'ip' => self::getClientIP(),
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown',
            'details' => $details
        ];
        
        $logDir = dirname(__DIR__) . '/logs';
        if (!is_dir($logDir)) {
            mkdir($logDir, 0755, true);
        }
        
        file_put_contents(
            $logDir . '/security.log', 
            json_encode($logEntry) . "\n", 
            FILE_APPEND | LOCK_EX
        );
    }
}
