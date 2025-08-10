<?php
// db_config.php - read DB config from env variables (cloud friendly)
$host     = getenv('DB_HOST') ?: 'db';
$port     = getenv('DB_PORT') ?: '3306';
$user     = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASS') ?: 'root';
$dbname   = getenv('DB_NAME') ?: 'student_management';

// connect
$conn = new mysqli($host, $user, $password, $dbname, (int)$port);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
?>

