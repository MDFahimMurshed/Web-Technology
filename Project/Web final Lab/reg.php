<?php
header('Content-Type: application/json');
include 'db.php';

$response = ['success' => false, 'message' => 'Registration failed'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first = $_POST['first_name'];
    $last = $_POST['last_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $confirm = $_POST['confirm_password'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $image = $_FILES['image'];

    if ($pass !== $confirm) {
        $response['message'] = 'Passwords do not match.';
        echo json_encode($response);
        exit;
    }

    // Upload image
    $upload_dir = "uploads/";
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir);
    }
    $image_path = $upload_dir . basename($image["name"]);
    move_uploaded_file($image["tmp_name"], $image_path);

    // Hash password
    $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

    // Store user
    $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, username, email, password, dob, gender, image_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $first, $last, $username, $email, $hashed_pass, $dob, $gender, $image_path);

    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = 'Registration successful';
    } else {
        $response['message'] = 'Username or email may already exist.';
    }

    $stmt->close();
    $conn->close();
}

echo json_encode($response);
?>
