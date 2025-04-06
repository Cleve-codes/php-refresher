<?php
require_once '../includes/init.php';
requireLogin();

$pdo = getDbConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book_id'])) {
    $title = $_POST['title'] ?? '';
    $author = $_POST['author'] ?? '';
    $year = $_POST['year_of_publish'] ?? '';
    $recommendations = $_POST['recommendations'] ?? '';
    
    if ($title && $author && $year) {
        $stmt = $pdo->prepare("UPDATE books SET title = ?, author = ?, year_of_publish = ?, recommendations = ? WHERE id = ? AND user_id = ?");
        $stmt->execute([$title, $author, $year, $recommendations, $_POST['book_id'], $_SESSION['user_id']]);
        header('Location: dashboard.php');
        exit();
    }
} else if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM books WHERE id = ? AND user_id = ?");
    $stmt->execute([$_GET['id'], $_SESSION['user_id']]);
    $book = $stmt->fetch();
    if (!$book) {
        header('Location: dashboard.php');
        exit();
    }
} else {
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
            <button type="submit">Update Book</button>
        </form>
    </div>
</body>
</html> 