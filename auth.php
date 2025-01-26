<?php
include 'db_config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password1'];
    $role = $_POST['role'];

    if ($role === 'admin') {
        $query = "SELECT * FROM admins WHERE username = '$username'";
    } elseif ($role === 'faculty') {
        $query = "SELECT * FROM faculty WHERE username = '$username'";
    }

    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password1'])) {
            $_SESSION['role'] = $role;
            $_SESSION['username'] = $username;
            if ($role === 'admin') {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: faculty_dashboard.php");
            }
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "Invalid username.";
    }
}
?>
