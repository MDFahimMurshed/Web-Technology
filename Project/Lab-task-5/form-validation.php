<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $isLoginForm = isset($_POST['loginForm']);
    $isRegistrationForm = isset($_POST['registrationForm']);
    
    $errors = [];
    $formData = $_POST;

    if ($isLoginForm) {
        $username = trim($_POST['username'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if (empty($username)) {
            $errors['username'] = "Username is required";
        } elseif (strlen($username) < 4) {
            $errors['username'] = "Username must be at least 4 characters";
        }

        if (empty($password)) {
            $errors['password'] = "Password is required";
        } elseif (strlen($password) < 6) {
            $errors['password'] = "Password must be at least 6 characters";
        }

        if (empty($errors)) {
            header("Location: login-success.html");
            exit();
        } else {
            $_SESSION['login_errors'] = $errors;
            $_SESSION['login_form_data'] = $formData;
            header("Location: login.html");
            exit();
        }

    } elseif ($isRegistrationForm) {
        $fullname = trim($_POST['fullname'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $username = trim($_POST['username'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $confirm_password = trim($_POST['confirm_password'] ?? '');

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
            header("Location: register-success.html");
            exit();
        } else {
            $_SESSION['reg_errors'] = $errors;
            $_SESSION['reg_form_data'] = $formData;
            header("Location: registration.html");
            exit();
        }
    }
}
?>