<?php
include 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password1']);
    $role = trim($_POST['role']);

    // Check if all required fields are filled
    if (empty($username) || empty($password) || empty($role)) {
        die("All fields are required.");
    }

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL query based on role
    if ($role === 'admin') {
        $query = "INSERT INTO admins (username, password1) VALUES ('$username', '$hashed_password')";
    } elseif ($role === 'faculty') {
        $query = "INSERT INTO faculty (username, password1) VALUES ('$username', '$hashed_password')";
    } else {
        die("Invalid role selected.");
    }

    // Execute query and handle result
    if ($conn->query($query) === TRUE) {
        // Redirect to login page after successful registration
        header("Location: index.php?message=Registration successful! Please log in.");
        exit();
    } else {
        // Show detailed error message for debugging
        echo "Error: " . $conn->error;
    }
}
error_reporting(E_ALL);
ini_set('display_errors', 1);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <h1>Register</h1>
    <form action="register.php" method="POST">
        <label>Username:</label>
        <input type="text" name="username" required><br>
        <label>Password:</label>
        <input type="password" name="password1" required><br>
        <label>Role:</label>
        <select name="role">
            <option value="admin">Admin</option>
            <option value="faculty">Faculty</option>
        </select><br>
        <button type="submit">Register</button>
    </form>
</body>
</html>

