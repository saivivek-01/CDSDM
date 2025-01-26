<?php
include 'db_config.php';
session_start();

// Check if user is logged in as faculty
if ($_SESSION['role'] !== 'faculty') {
    header("Location: ../index.php");
    exit();
}

if (isset($_GET['student_random_id'])) {
    $student_random_id = $_GET['student_random_id'];

    // Query to fetch student details
    $query = "SELECT * FROM students WHERE random = '$student_random_id'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $student = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty - Student Details</title>
    <link rel="stylesheet" href="style1.css">
    
</head>
<body>

    <div class="container">
        <h1>Student Details</h1>

        <div class="student-details">
            <p><label>ID:<?php echo $student['id']; ?></label> </p>
            <p><label>Name: <?php echo $student['name']; ?></label></p>
            <p><label>Email: <?php echo $student['email']; ?></label></p>
            <p><label>Course: <?php echo $student['course']; ?></label></p>
            <p><label>Year:<?php echo $student['year']; ?></label> </p>
        </div>

        <!-- Button to copy student details in a form-fillable format -->
        <button onclick="copyDetails()">Copy Details</button>
        <br><br>

        <!-- Back Button -->
        <a href="faculty_dashboard.php"><button class="back-btn">Back to Dashboard</button></a>

        <!-- Script to copy student details in a form-fillable format -->
        <script>
            function copyDetails() {
                // Format the student details as form field input values (name="field_name" value="student_value")
                const autofillDetails = `
                    student_id=${<?php echo json_encode($student['id']); ?>}
                    student_name=${<?php echo json_encode($student['name']); ?>}
                    student_email=${<?php echo json_encode($student['email']); ?>}
                    student_course=${<?php echo json_encode($student['course']); ?>}
                    student_year=${<?php echo json_encode($student['year']); ?>}
                `;
                
                // Copy the formatted data to the clipboard
                navigator.clipboard.writeText(autofillDetails).then(function() {
                    alert('Student details copied to clipboard! You can now paste them into a form with corresponding fields.');
                });
            }
        </script>
    </div>

</body>
</html>

<?php
    } else {
        echo "Student not found.";
    }
}
?>
