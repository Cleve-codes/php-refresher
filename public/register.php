<?php
/**
 * Registration Page
 * 
 * Handles new user registration:
 * - Displays registration form
 * - Validates user input
 * - Creates new user account with hashed password
 * - Handles duplicate username errors
 */

require_once '../includes/init.php';

// Process registration form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get and sanitize form data
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if ($username && $password) {
        $pdo = getDbConnection();
        try {
            // Hash password and create new user
            $stmt = $pdo->prepare("INSERT INTO users (username, password_hash) VALUES (?, ?)");
            $stmt->execute([$username, password_hash($password, PASSWORD_DEFAULT)]);
            
            // Redirect to login page after successful registration
            header('Location: login.php');
            exit();
        } catch (PDOException $e) {
            // Handle duplicate username error
            $error = "Username already exists";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register - Book Manager</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Register</h1>
        <!-- Display error message if registration failed -->
        <?php if (isset($error)): ?>
            <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <!-- Registration form -->
        <form method="POST">
            <div class="form-group">
                <label>Username:</label>
                <input type="text" name="username" required>
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>