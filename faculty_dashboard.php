<?php
session_start();

// Block unauthorized access
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'faculty') {
    header("Location: index.php");
    exit();
}

// Optional: Store school for quick use
$school = $_SESSION['school'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Dashboard</title>
    <style>
        body {
            background-image: url('facultylogin.jpeg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 100%;
            font-family: Arial, sans-serif;
            color: #fff;
            text-align: center;
            padding-top: 60px;
        }

        .dashboard-container {
            background: rgba(0, 0, 0, 0.6);
            margin: auto;
            padding: 40px;
            border-radius: 10px;
            width: 50%;
        }

        h1 {
            margin-bottom: 30px;
        }

        input[type="text"] {
            padding: 10px;
            width: 70%;
            border-radius: 5px;
            border: none;
            margin: 10px 0;
        }

        button {
            padding: 10px 20px;
            border: none;
            background-color: #00bcd4;
            color: white;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
        }

        button.logout-btn {
            background-color: #e91e63;
            margin-top: 30px;
        }

        button:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>

    <div class="dashboard-container">
        <h1>Welcome, Faculty</h1>

        <form action="search_students.php" method="GET">
            <h3>Search Student by ID</h3>
            <input type="text" name="student_random_id" placeholder="Enter Student ID" required><br>
            <button type="submit">Search</button>
        </form>

        <a href="logout.php">
            <button class="logout-btn">Logout</button>
        </a>
    </div>

</body>
</html>

