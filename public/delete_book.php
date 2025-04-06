<?php
require_once '../includes/init.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book_id'])) {
    $pdo = getDbConnection();
    $stmt = $pdo->prepare("DELETE FROM books WHERE id = ? AND user_id = ?");
    $stmt->execute([$_POST['book_id'], $_SESSION['user_id']]);
}

header('Location: dashboard.php');
exit();