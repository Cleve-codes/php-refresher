<?php
/**
 * Database Configuration File
 * 
 * This file contains the database configuration and initialization.
 * It sets up the SQLite database connection and creates the necessary tables
 * if they don't already exist.
 */

// Database configuration constants
define('DB_TYPE', 'sqlite');
define('DB_FILE', __DIR__ . '/../database/bookmanager.db');

/**
 * Get Database Connection
 * 
 * Creates and returns a PDO connection to the SQLite database.
 * Sets error mode to throw exceptions for better error handling.
 * 
 * @return PDO Database connection object
 * @throws PDOException if connection fails
 */
function getDbConnection() {
    try {
        $pdo = new PDO("sqlite:" . DB_FILE);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch(PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}

/**
 * Initialize Database
 * 
 * Creates the necessary database tables if they don't exist:
 * - users: Stores user authentication information
 * - books: Stores book information with foreign key to users
 */
function initializeDatabase() {
    $pdo = getDbConnection();
    
    // Create users table
    $pdo->exec("CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT UNIQUE NOT NULL,
        password_hash TEXT NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    // Create books table with foreign key to users
    $pdo->exec("CREATE TABLE IF NOT EXISTS books (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        user_id INTEGER NOT NULL,
        title TEXT NOT NULL,
        author TEXT NOT NULL,
        year_of_publish INTEGER NOT NULL,
        recommendations TEXT,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id)
    )");
}

// Initialize the database when this file is included
initializeDatabase();