<?php
$host = 'localhost';
$dbname = 'user_system'; // your database name
$user = 'root';
$pass = ''; // default XAMPP password is empty

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>