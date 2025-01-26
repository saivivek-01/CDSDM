<?php
session_start();
if ($_SESSION['role'] !== 'faculty') {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Dashboard</title>
    <style>
    body {
  background-image: url('searchstudent.jpeg');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: 100% 100%;
}
</style>
    <link rel="stylesheet" href="style1.css">
</head>
<body>

    <div class="dashboard-container">
        <h1>Welcome, Faculty</h1>

        <!-- Search Student Form -->
        <form action="search_students.php" method="GET">
            <h3>Search Student by ID</h3>
            <input type="text" name="student_random_id" placeholder="Enter Student ID" required><br>
            <button type="submit">Search</button>
        </form>

        <!-- Logout Button -->
        <a href="logout.php">
            <button class="logout-btn">Logout</button>
        </a>
    </div>

</body>
</html>

