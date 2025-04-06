<?php
/**
 * Index Page (Entry Point)
 * 
 * This is the main entry point of the application.
 * It handles:
 * - Initial user authentication check
 * - Redirection to appropriate pages based on auth status
 * - Acts as a router to either login or dashboard
 */

require_once '../includes/init.php';

// Check if user is authenticated
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not authenticated
    header('Location: login.php');
    exit();
}

// Redirect to dashboard if authenticated
header('Location: dashboard.php');
exit();