<?php
/**
 * Delete Book Handler
 * 
 * Handles book deletion:
 * - Validates user authentication
 * - Verifies book ownership
 * - Deletes the book from database
 * - Redirects back to dashboard
 */

require_once '../includes/init.php';
requireLogin();

// Process book deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book_id'])) {
    try {
        // Delete book if it belongs to the current user
        $pdo = getDbConnection();
        $stmt = $pdo->prepare("DELETE FROM books WHERE id = ? AND user_id = ?");
        $stmt->execute([$_POST['book_id'], $_SESSION['user_id']]);
        
        if ($stmt->rowCount() > 0) {
            $_SESSION['success'] = "Book deleted successfully!";
        } else {
            $_SESSION['error'] = "Book not found or access denied.";
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "Error deleting book. Please try again.";
    }
}

// Redirect back to dashboard
header('Location: dashboard.php');
exit();