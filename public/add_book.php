<?php
require_once '../includes/init.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $author = $_POST['author'] ?? '';
    $year = $_POST['year_of_publish'] ?? '';
    $recommendations = $_POST['recommendations'] ?? '';
    
    if ($title && $author && $year) {
        $pdo = getDbConnection();
        $stmt = $pdo->prepare("INSERT INTO books (user_id, title, author, year_of_publish, recommendations) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$_SESSION['user_id'], $title, $author, $year, $recommendations]);
        header('Location: dashboard.php');
        exit();
    }
}

header('Location: dashboard.php');
exit();