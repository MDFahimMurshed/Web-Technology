<?php
session_start();
require_once '../model/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['registrationForm'])) {
    $fullname = trim($_POST['fullname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $confirm_password = trim($_POST['confirm_password'] ?? '');
    
    $errors = [];
    
    // Server-side validation
    if (empty($fullname)) {
        $errors['fullname'] = "Full name is required";
    } elseif (str_word_count($fullname) < 2) {
        $errors['fullname'] = "Please enter first and last name";
    }

    if (empty($email)) {
        $errors['email'] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Please enter a valid email address";
    }

    if (empty($username)) {
        $errors['username'] = "Username is required";
    } elseif (strlen($username) < 4 || strlen($username) > 20) {
        $errors['username'] = "Username must be 4-20 characters";
    } elseif (!preg_match('/^[a-zA-Z0-9]+$/', $username)) {
        $errors['username'] = "Only letters and numbers allowed";
    }

    if (empty($password)) {
        $errors['password'] = "Password is required";
    } elseif (strlen($password) < 8) {
        $errors['password'] = "Password must be at least 8 characters";
    } elseif (!preg_match('/[0-9]/', $password) || !preg_match('/[!@#$%^&*]/', $password)) {
        $errors['password'] = "Password needs 1 number and 1 special character";
    }

    if ($password !== $confirm_password) {
        $errors['confirm_password'] = "Passwords do not match";
    }

    if (empty($errors)) {
        $db = new Database();
        $success = $db->registerAdmin($fullname, $email, $username, $password);
        $db->close();

        if ($success) {
            $_SESSION['registration_success'] = true;
            header("Location: ../view/login.php");
            exit();
        } else {
            $errors['registration'] = "Registration failed. Please try again.";
        }
    }

    // Store errors and form data in session if validation fails
    $_SESSION['reg_errors'] = $errors;
    $_SESSION['reg_form_data'] = $_POST;
    header("Location: ../view/registration.php");
    exit();
} else {
    header("Location: ../view/registration.php");
    exit();
}
?>