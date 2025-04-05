<?php
define('DB_TYPE', 'sqlite');
define('DB_FILE', __DIR__ . '/../database/bookmanager.db');

function getDbConnection() {
    try {
        $pdo = new PDO("sqlite:" . DB_FILE);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch(PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}