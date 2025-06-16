<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit;
}

$username = htmlspecialchars($_SESSION['username']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Online Pharmacy Service - Home</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f8fb;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .container {
            margin-top: 80px;
            padding: 30px;
            background: #ffffff;
            display: inline-block;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        h1 {
            color: #2d3436;
        }

        p {
            font-size: 18px;
            color: #555;
        }

        .logout-btn {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #d63031;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .logout-btn:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Welcome, <?php echo $username; ?>!</h1>
        <p>Welcome to <strong>Online Pharmacy Service</strong>.</p>
        <p>Here you can order medicines, upload prescriptions, and get doorstep delivery.</p>

        <form action="logout.php" method="post">
            <button class="logout-btn">Logout</button>
        </form>
    </div>

</body>
</html>
