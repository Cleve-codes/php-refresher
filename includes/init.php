<?php
session_start();
require_once __DIR__ . '/../config/database.php';

// Check if user is logged in
function requireLogin() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit();
    }
}

