<?php
session_start();
require_once '../model/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    
    $errors = [];
    
    // Validation
    if (empty($username)) {
        $errors['username'] = "Username is required";
    }
    
    if (empty($password)) {
        $errors['password'] = "Password is required";
    }
    
    if (empty($errors)) {
        $db = new Database();
        $admin = $db->validateAdmin($username, $password);
        $db->close();
        
        if ($admin) {
            // Store user data in session
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['username'] = $admin['username'];
            
            // Redirect to welcome page
            header("Location: welcome.php");
            exit();
        } else {
            $errors['login'] = "Invalid username or password";
        }
    }
    
    // If validation fails, return to login page with errors
    $_SESSION['login_errors'] = $errors;
    $_SESSION['login_form_data'] = ['username' => $username];
    header("Location: ../view/login.php");
    exit();
} else {
    // If not a POST request, redirect to login
    header("Location: ../view/login.php");
    exit();
}
?>