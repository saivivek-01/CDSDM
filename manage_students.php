<?php
include 'db_config.php';
session_start();

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if user is logged in as admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

// Handle Add, Edit, and Remove actions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    // Add Student
    if ($action == 'add') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $course = $_POST['course'];
        $year = $_POST['year'];

        // function generateRandomInteger($name) {
        //     // Hash the student name using a hash function (e.g., SHA-256)
        //     $hash = hash('sha256', $name);
        
        //     // Convert the hash into a numeric value
        //     $numericHash = gmp_strval(gmp_init($hash, 16), 10);
        
        //     // Extract the first 12 digits to make it a 12-digit number
        //     $randomInteger = substr($numericHash, 0, 12);
        
        //     return $randomInteger;
        // }

        function generateRandomInteger($studentName) {
            // Hash the student name using a hash function (e.g., SHA-256)
            $hash = hash('sha256', $studentName);
        
            // Convert the hash to a numeric value by taking only numeric characters
            $numericHash = preg_replace('/[^0-9]/', '', $hash);
        
            // If the numeric hash is shorter than 12 digits, pad it with random numbers
            while (strlen($numericHash) < 12) {
                $numericHash .= rand(0, 9);
            }
        
            // Extract the first 12 digits to ensure the result is exactly 12 digits
            $randomInteger = substr($numericHash, 0, 12);
        
            return $randomInteger;
        }
        
        $randomInteger = generateRandomInteger($name);

        $query = $conn->prepare("INSERT INTO students (name, email, course, year, random) VALUES (?, ?, ?, ?, ?)");
        $query->bind_param("sssii", $name, $email, $course, $year, $randomInteger);
        if ($query->execute()) {
            $last_id = $conn->insert_id; // Get the last inserted ID
            $message = "Student added successfully! Unique ID: " . $randomInteger;   
        } else {
            echo "Error: " . $query->error;
        }
        
    }

    // Edit Student
    if ($action == 'edit') {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $course = $_POST['course'];
        $year = $_POST['year'];

        $query = $conn->prepare("UPDATE students SET name=?, email=?, course=?, year=? WHERE id=?");
        $query->bind_param("sssii", $name, $email, $course, $year, $id);
        if ($query->execute()) {
            $message = "Student updated successfully!";
        } else {
            $message = "Error: " . $query->error;
        }
    }

    // Remove Student
    if ($action == 'remove') {
        $id = $_POST['id'];

        $query = $conn->prepare("DELETE FROM students WHERE id=?");
        $query->bind_param("i", $id);
        if ($query->execute()) {
            $message = "Student removed successfully!";
        } else {
            $message = "Error: " . $query->error;
        }
    }
}

// Fetch students from database
$students = $conn->query("SELECT * FROM students");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Students</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color:rgb(147, 168, 189);
            color: #333;
            margin: 20px;
        }

        h1, h2 {
            font-weight: 700;
            color: #2a3d66;
        }

        a {
            text-decoration: none;
            color: #2a3d66;
            font-weight: 600;
        }

        /* Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .message {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            background-color: #e7f7e7;
            color: #4c9f4c;
        }

        .error {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            background-color: #fbe3e4;
            color: #d9534f;
        }

        /* Card and Form Layout */
        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px 0;
            padding: 20px;
        }

        .card h2 {
            margin-bottom: 20px;
        }

        label {
            font-weight: 500;
            margin-bottom: 5px;
            display: block;
        }

        input, select, button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            background-color: #2a3d66;
            color: #fff;
            cursor: pointer;
            border: none;
        }

        button:hover {
            background-color: #1c2a4e;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #2a3d66;
            color: #fff;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }

            input, select, button {
                width: 100%;
                font-size: 14px;
            }

            table, th, td {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Manage Students</h1>
       <h4 align='right' color='red'> <a href="logout.php" class="logout-btn">Logout</a></h4>
        <hr>

        <!-- Success/Failure Message -->
        <?php if (!empty($message)): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>

        <!-- Add Student Form -->
        <div class="card">
            <h2>Add New Student</h2>
            <form method="POST" action="manage_students.php">
                <input type="hidden" name="action" value="add">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" required>

                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>

                <label for="course">Course:</label>
                <input type="text" name="course" id="course" required>

                <label for="year">Year:</label>
                <input type="number" name="year" id="year" required>

                <button type="submit">Add Student</button>
            </form>
        </div>

        <!-- Student List -->
        <div class="card">
            <h2>Student List</h2>
            <?php if ($students->num_rows > 0): ?>
                <table>
                    <tr>
                        <th>Unique ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Course</th>
                        <th>Year</th>
                        <th>Actions</th>
                    </tr>
                    <?php while ($row = $students->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['course']; ?></td>
                            <td><?php echo $row['year']; ?></td>
                            
                            <td>
                                <!-- Edit Form -->
                                <form method="POST" action="manage_students.php" style="display:inline-block;">
                                    <input type="hidden" name="action" value="edit">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <input type="text" name="name" value="<?php echo $row['name']; ?>" required>
                                    <input type="email" name="email" value="<?php echo $row['email']; ?>" required>
                                    <input type="text" name="course" value="<?php echo $row['course']; ?>" required>
                                    <input type="number" name="year" value="<?php echo $row['year']; ?>" required>
                                    <button type="submit">Edit</button>
                                </form>

                                <!-- Remove Form -->
                                <form method="POST" action="manage_students.php" style="display:inline-block;">
                                    <input type="hidden" name="action" value="remove">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" style="background-color: #d9534f;">Remove</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            <?php else: ?>
                <p>No students found!</p>
            <?php endif; ?>
        </div>
    </div>
    
</body>
</html>
