<?php
session_start();
include 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password1']);
    $role = $_POST['role'];

    if ($role === 'admin') {
        $query = "SELECT * FROM admins WHERE username = ?";
    } elseif ($role === 'faculty') {
        $query = "SELECT * FROM faculty WHERE username = ?";
    } else {
        die("Invalid role.");
    }

    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password1'])) {
            // Set session values
            $_SESSION['role'] = $role;
            $_SESSION['username'] = $username;
            $_SESSION['school'] = $user['school']; // Assumes 'school' column exists

            // Redirect by role
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
        echo "Invalid username or role.";
    }

    $stmt->close();
    $conn->close();
}
?>
