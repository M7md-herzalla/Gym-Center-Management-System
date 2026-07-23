<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "powerfit_db";

$conn = new mysqli($host, $username, $password);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->query("CREATE DATABASE IF NOT EXISTS $dbname");
$conn->select_db($dbname);

$table_users = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
)";
$conn->query($table_users);

$table_bookings = "CREATE TABLE IF NOT EXISTS bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    class_name VARCHAR(100) NOT NULL,
    booking_date DATE NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
)";
$conn->query($table_bookings);

$demo_email = 'member@gym.com';
$demo_pass = password_hash('member123', PASSWORD_DEFAULT);
$check_demo = $conn->query("SELECT * FROM users WHERE email='$demo_email'");

if ($check_demo->num_rows == 0) {
    $conn->query("INSERT INTO users (first_name, last_name, email, password) VALUES ('Demo', 'Member', '$demo_email', '$demo_pass')");
}
?>