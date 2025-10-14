<?php
/**
 * Database Configuration File - Example
 * 
 * This is an example configuration file.
 * Copy this file to config.php and update with your actual database credentials.
 * The config.php file is excluded from Git to keep your credentials secure.
 */

// Database configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'kohabit_db');
define('DB_USER', 'your_username_here');
define('DB_PASS', 'your_password_here');
define('DB_CHARSET', 'utf8mb4');

// Application configuration
define('APP_NAME', 'Kohabit');
define('APP_URL', 'http://localhost');

// Error reporting (set to 0 in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Timezone
date_default_timezone_set('UTC');

/**
 * Get database connection
 * 
 * @return PDO Database connection object
 * @throws PDOException If connection fails
 */
function getDBConnection() {
    static $pdo = null;
    
    if ($pdo === null) {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            
            $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            error_log("Database connection error: " . $e->getMessage());
            throw new PDOException("Database connection failed");
        }
    }
    
    return $pdo;
}

/**
 * Close database connection
 */
function closeDBConnection() {
    $pdo = null;
}
?>
