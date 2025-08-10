<?php
session_start();
// Ensure user is logged in and is admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

// Optional: Get the school associated with this admin
$school = $_SESSION['school'] ?? 'Unknown School';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-image: url('adminlogin.jpeg');
            background-repeat: no-repeat;
            background-size: 100% 100%;
            font-family: 'Roboto', sans-serif;
            background-color: #f4f7fa;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        .dashboard-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            text-align: center;
        }

        h1 {
            color: #2a3d66;
            font-size: 2rem;
            margin-bottom: 10px;
        }

        p {
            font-size: 1.1rem;
            margin-bottom: 20px;

        }

        ul {
            list-style-type: none;
        }

        li {
            margin: 10px 0;
        }

        a {
            display: inline-block;
            padding: 12px 20px;
            background-color: #2a3d66;
            color: #fff;
            text-decoration: none;
            font-size: 1.1rem;
            border-radius: 5px;
        }

        a:hover {
            background-color: #1c2a4e;
        }

        .logout-btn {
            background-color: #d9534f;
        }

        .logout-btn:hover {
            background-color: #c12e2a;
        }
    </style>
</head>
<body>

    <div class="dashboard-container">
        <h1>Welcome, Admin</h1>
        <p>School: <strong><?= htmlspecialchars($school) ?></strong></p>
        <p>Use the options below to manage students:</p>
        
        <ul>
            <li><a href="manage_students.php">Manage Students</a></li>
            <li><a href="logout.php" class="logout-btn">Logout</a></li>
        </ul>
    </div>
    <a href="register_user.php">
    <button style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer;">
        Register New User
    </button>
</a>

</body>
</html>
