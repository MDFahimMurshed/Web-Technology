<?php
session_start();
if (isset($_SESSION['admin_id'])) {
    header("Location: ../Control/Home.php");
    exit();
}

$login_errors = $_SESSION['login_errors'] ?? [];
$login_data = $_SESSION['login_form_data'] ?? [];
unset($_SESSION['login_errors']);
unset($_SESSION['login_form_data']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="../CSS/mystyle.css">
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <h2>Admin Login</h2>
        </div>
        
        <?php if (isset($login_errors['login'])): ?>
            <div class="error-message" style="text-align: center; margin-bottom: 15px;">
                <?php echo $login_errors['login']; ?>
            </div>
        <?php endif; ?>
        
        <form method="post" id="loginForm" action="../Control/LoginValidation.php">
            <div class="form-frame">
                <div class="input-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" 
                           value="<?php echo htmlspecialchars($login_data['username'] ?? ''); ?>">
                    <div id="usernameError" class="error-message">
                        <?php echo $login_errors['username'] ?? ''; ?>
                    </div>
                </div>
                <div class="input-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password">
                    <div id="passwordError" class="error-message">
                        <?php echo $login_errors['password'] ?? ''; ?>
                    </div>
                </div>
            </div>
            
            <div style="text-align: center; margin-top: 20px;">
                <button type="submit" class="submit-button">Login</button>
            </div>
        </form>
        
        <div class="form-link">
            <p>Don't have an account? <a href="registration.php">Register here</a></p>
        </div>
    </div>
    <script src="../js/myscript.js"></script>
</body>
</html>