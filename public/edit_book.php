<?php
/**
 * Edit Book Page
 * 
 * Handles book editing functionality:
 * - Displays form with current book details
 * - Validates user ownership of the book
 * - Updates book information in database
 * - Handles validation and error messages
 */

require_once '../includes/init.php';
requireLogin();

$pdo = getDbConnection();

// Handle form submission for updating book
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book_id'])) {
    // Get and sanitize form data
    $title = $_POST['title'] ?? '';
    $author = $_POST['author'] ?? '';
    $year = (int)($_POST['year_of_publish'] ?? 0);
    $recommendations = $_POST['recommendations'] ?? '';
    $currentYear = (int)date('Y');
    
    if ($title && $author && $year) {
        // Validate publication year
        if ($year > $currentYear) {
            $_SESSION['error'] = "Publication year cannot be greater than the current year ($currentYear)";
            header('Location: dashboard.php');
            exit();
        }

        // Update book details in database
        $stmt = $pdo->prepare("UPDATE books SET title = ?, author = ?, year_of_publish = ?, recommendations = ? WHERE id = ? AND user_id = ?");
        $stmt->execute([$title, $author, $year, $recommendations, $_POST['book_id'], $_SESSION['user_id']]);
        
        $_SESSION['success'] = "Book updated successfully!";
        header('Location: dashboard.php');
        exit();
    }
} else if (isset($_GET['id'])) {
    // Fetch book details for editing
    $stmt = $pdo->prepare("SELECT * FROM books WHERE id = ? AND user_id = ?");
    $stmt->execute([$_GET['id'], $_SESSION['user_id']]);
    $book = $stmt->fetch();
    
    // Redirect if book doesn't exist or doesn't belong to user
    if (!$book) {
        $_SESSION['error'] = "Book not found or access denied.";
        header('Location: dashboard.php');
        exit();
    }
} else {
    // No book ID provided
    header('Location: dashboard.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Book - Book Manager</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Edit Book</h1>
        <!-- Display error messages if any -->
        <?php if (isset($_SESSION['error'])): ?>
            <div class="error-message">
                <?php 
                echo htmlspecialchars($_SESSION['error']); 
                unset($_SESSION['error']);
                ?>
            </div>
        <?php endif; ?>
        <!-- Edit book form -->
        <form method="POST">
            <input type="hidden" name="book_id" value="<?php echo htmlspecialchars($book['id']); ?>">
            <div class="form-group">
                <label>Title:</label>
                <input type="text" name="title" value="<?php echo htmlspecialchars($book['title']); ?>" required>
            </div>
            <div class="form-group">
                <label>Author:</label>
                <input type="text" name="author" value="<?php echo htmlspecialchars($book['author']); ?>" required>
            </div>
            <div class="form-group">
                <label>Year of Publication:</label>
                <input type="number" name="year_of_publish" value="<?php echo htmlspecialchars($book['year_of_publish']); ?>" required>
            </div>
            <div class="form-group">
                <label>Recommendations:</label>
                <textarea name="recommendations"><?php echo htmlspecialchars($book['recommendations']); ?></textarea>
            </div>
            <div class="form-actions">
                <button type="submit">Update Book</button>
                <a href="dashboard.php" class="btn">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html> 