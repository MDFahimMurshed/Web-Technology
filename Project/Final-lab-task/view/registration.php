<?php
session_start();
if (isset($_SESSION['admin_id'])) {
    header("Location: ../Control/Home.php");
    exit();
}

$reg_errors = $_SESSION['reg_errors'] ?? [];
$reg_data = $_SESSION['reg_form_data'] ?? [];
unset($_SESSION['reg_errors']);
unset($_SESSION['reg_form_data']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Registration</title>
    <link rel="stylesheet" href="../CSS/mystyle.css">
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <h2>Admin Registration</h2>
        </div>
        <form method="post" id="registrationForm" action="../Control/action.php">
            <input type="hidden" name="registrationForm" value="1">
            
            <div class="form-frame">
                <h4>Personal Information</h4>
                <div class="input-group">
                    <label for="fullname">Full Name:</label>
                    <input type="text" id="fullname" name="fullname" 
                           value="<?php echo htmlspecialchars($reg_data['fullname'] ?? ''); ?>">
                    <div id="fullnameError" class="error-message">
                        <?php echo $reg_errors['fullname'] ?? ''; ?>
                    </div>
                </div>
                <div class="input-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" 
                           value="<?php echo htmlspecialchars($reg_data['email'] ?? ''); ?>">
                    <div id="emailError" class="error-message">
                        <?php echo $reg_errors['email'] ?? ''; ?>
                    </div>
                </div>
                <div class="input-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" 
                           value="<?php echo htmlspecialchars($reg_data['username'] ?? ''); ?>">
                    <div id="usernameError" class="error-message">
                        <?php echo $reg_errors['username'] ?? ''; ?>
                    </div>
                </div>
            </div>
            
            <div class="form-frame">
                <h4>Account Security</h4>
                <div class="input-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password">
                    <div id="passwordError" class="error-message">
                        <?php echo $reg_errors['password'] ?? ''; ?>
                    </div>
                </div>
                <div class="input-group">
                    <label for="confirm_password">Confirm Password:</label>
                    <input type="password" id="confirm_password" name="confirm_password">
                    <div id="confirmPasswordError" class="error-message">
                        <?php echo $reg_errors['confirm_password'] ?? ''; ?>
                    </div>
                </div>
            </div>
            
            <div style="text-align: center; margin-top: 20px;">
                <button type="button" class="submit-button" onclick="window.location.href='login.php'">Back</button>
                <button type="submit" class="submit-button">Register</button>
            </div>
        </form>
        <div class="form-link">
            <p>Already have an account? <a href="login.php">Login here</a></p>
        </div>
    </div>
    <script src="../js/myscript.js"></script>
</body>
</html>