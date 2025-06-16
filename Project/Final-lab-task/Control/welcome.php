<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../view/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="../CSS/mystyle.css">
    <style>
        .welcome-container {
            max-width: 600px;
            margin: 100px auto;
            padding: 40px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            text-align: center;
        }
        .welcome-message {
            font-size: 2rem;
            color: #2c3e50;
            margin-bottom: 20px;
        }
        .continue-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 25px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .continue-btn:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <h1 class="welcome-message">Welcome to Our Website!</h1>
        <p>You have successfully logged in as <?php echo htmlspecialchars($_SESSION['username']); ?></p>
        <a href="Home.php" class="continue-btn">Continue to Dashboard</a>
    </div>
</body>
</html>