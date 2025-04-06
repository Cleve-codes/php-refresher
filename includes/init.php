<?php
/**
 * Application Initialization File
 * 
 * This file initializes the application by:
 * - Starting the session
 * - Including the database configuration
 * - Defining utility functions for authentication
 */

// Start the session for user authentication
session_start();

// Include database configuration and functions
require_once __DIR__ . '/../config/database.php';

/**
 * Check if User is Logged In
 * 
 * Verifies if a user is currently logged in by checking the session.
 * 
 * @return bool True if user is logged in, false otherwise
 */
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

/**
 * Require Login
 * 
 * Forces a redirect to the login page if the user is not logged in.
 * Use this function at the start of pages that require authentication.
 */
function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit();
    }
}

