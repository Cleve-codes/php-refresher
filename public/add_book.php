<?php
/**
 * Add Book Handler
 * 
 * Handles adding new books to the system:
 * - Validates user authentication
 * - Validates form input
 * - Validates publication year
 * - Inserts new book into database
 * - Handles success/error messages
 */

require_once '../includes/init.php';
requireLogin();

// Process book addition
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get and sanitize form data
    $title = $_POST['title'] ?? '';
    $author = $_POST['author'] ?? '';
    $year = (int)($_POST['year_of_publish'] ?? 0);
    $recommendations = $_POST['recommendations'] ?? '';
    $currentYear = (int)date('Y');
    
    // Validate form data
    if ($title && $author && $year) {
        // Validate publication year
        if ($year > $currentYear) {
            $_SESSION['error'] = "Publication year cannot be greater than the current year ($currentYear)";
            header('Location: dashboard.php');
            exit();
        }
        
        try {
            // Insert new book into database
            $pdo = getDbConnection();
            $stmt = $pdo->prepare("INSERT INTO books (user_id, title, author, year_of_publish, recommendations) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$_SESSION['user_id'], $title, $author, $year, $recommendations]);
            $_SESSION['success'] = "Book added successfully!";
        } catch (PDOException $e) {
            $_SESSION['error'] = "Error adding book. Please try again.";
        }
    } else {
        $_SESSION['error'] = "Please fill in all required fields.";
    }
}

// Redirect back to dashboard
header('Location: dashboard.php');
exit();