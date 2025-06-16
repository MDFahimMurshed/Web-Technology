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
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../CSS/mystyle.css">
</head>
<body>
    <div class="dashboard-container">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        <div class="dashboard-content">
            <p>You are now logged in to the admin dashboard.</p>
            <div class="dashboard-actions">
                <a href="logout.php" class="dashboard-button">Logout</a>
            </div>
        </div>
    </div>
</body>
</html>