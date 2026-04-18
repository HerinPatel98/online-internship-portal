<?php

class SecurityHelper {

    // Password Hashing Function
    public static function hashPassword($password) {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    // CSRF Token Generation
    public static function generateCsrfToken() {
        return bin2hex(random_bytes(32));
    }

    // Rate Limiting Check
    public static function checkRateLimit($userId) {
        // Logic for rate limiting based on user actions
        // Placeholder for actual implementation
        return true;
    }

    // Input Validation
    public static function validateInput($input) {
        return htmlspecialchars(strip_tags($input));
    }

    // Security Logging
    public static function logSecurityEvent($event) {
        $logFile = 'security.log';
        $timestamp = date('Y-m-d H:i:s');
        file_put_contents($logFile, "[".$timestamp."] " . $event . "\n", FILE_APPEND);
    }
}

?>