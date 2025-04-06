<?php
/**
 * Dashboard Page
 * 
 * This is the main page of the application where users can:
 * - View their list of books
 * - Add new books
 * - Edit existing books
 * - Delete books
 */

require_once '../includes/init.php';

// Check if user is logged in, redirect to login if not
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Fetch all books belonging to the current user
$pdo = getDbConnection();
$stmt = $pdo->prepare("SELECT * FROM books WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$_SESSION['user_id']]);
$books = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Book Manager</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <!-- Header with logout button -->
        <div class="header">
            <h1>My Books</h1>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
        
        <!-- Add Book Form Section -->
        <div class="add-book">
            <h2>Add New Book</h2>
            <!-- Display error messages if any -->
            <?php if (isset($_SESSION['error'])): ?>
                <div class="error-message">
                    <?php 
                    echo htmlspecialchars($_SESSION['error']); 
                    unset($_SESSION['error']); // Clear the error message after displaying
                    ?>
                </div>
            <?php endif; ?>
            <!-- Display success messages if any -->
            <?php if (isset($_SESSION['success'])): ?>
                <div class="success-message">
                    <?php 
                    echo htmlspecialchars($_SESSION['success']); 
                    unset($_SESSION['success']); // Clear the success message after displaying
                    ?>
                </div>
            <?php endif; ?>
            <!-- Book addition form -->
            <form action="add_book.php" method="POST">
                <div class="form-group">
                    <label>Title:</label>
                    <input type="text" name="title" required>
                </div>
                <div class="form-group">
                    <label>Author:</label>
                    <input type="text" name="author" required>
                </div>
                <div class="form-group">
                    <label>Year of Publication:</label>
                    <input type="number" name="year_of_publish" required>
                </div>
                <div class="form-group">
                    <label>Recommendations:</label>
                    <textarea name="recommendations"></textarea>
                </div>
                <button type="submit">Add Book</button>
            </form>
        </div>

        <!-- Book List Section -->
        <div class="book-list">
            <h2>My Book List</h2>
            <?php foreach ($books as $book): ?>
                <!-- Individual book item -->
                <div class="book-item">
                    <h3><?php echo htmlspecialchars($book['title']); ?></h3>
                    <p><strong>Author:</strong> <?php echo htmlspecialchars($book['author']); ?></p>
                    <p><strong>Year:</strong> <?php echo htmlspecialchars($book['year_of_publish']); ?></p>
                    <p><strong>Recommendations:</strong></p>
                    <p><?php echo nl2br(htmlspecialchars($book['recommendations'])); ?></p>
                    <!-- Book action buttons (Edit/Delete) -->
                    <div class="book-actions">
                        <a href="edit_book.php?id=<?php echo $book['id']; ?>" class="btn">Edit</a>
                        <form action="delete_book.php" method="POST" style="display: inline;">
                            <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">
                            <button type="submit" class="btn delete" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>