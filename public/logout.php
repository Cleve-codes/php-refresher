<?php
/**
 * Logout Handler
 * 
 * Handles user logout:
 * - Destroys the current session
 * - Redirects user to login page
 */

require_once '../includes/init.php';

// Destroy the session
session_destroy();

// Redirect to login page
header('Location: login.php');
exit();