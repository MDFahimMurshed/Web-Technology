<?php
session_start();
header('Content-Type: application/json');
include 'db.php'; // <-- this file connects to MySQL

$response = ['success' => false, 'message' => 'Invalid login'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($hashed_pass);
        $stmt->fetch();

        if (password_verify($password, $hashed_pass)) {
            $_SESSION['username'] = $username;
            $response['success'] = true;
        } else {
            $response['message'] = "Incorrect password.";
        }
    } else {
        $response['message'] = "Username not found.";
    }

    $stmt->close();
    $conn->close();
}

echo json_encode($response);
?>
