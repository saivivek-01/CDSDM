<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centralized Database For Student Details </title>

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-image: url('index.jpeg');
            background-repeat: no-repeat;
            background-attachment: fixed;
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

        h1 {
            color: #2a3d66;
            font-size: 2.5rem;
            margin-bottom: 30px;
        }

        .container {
            text-align: center;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 600px;
        }

        .btn {
            background-color: #2a3d66;
            color: #fff;
            padding: 15px 30px;
            margin: 10px;
            font-size: 1.1rem;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #1c2a4e;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            h1 {
                font-size: 2rem;
            }

            .container {
                width: 90%;
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <title> </title>
    <div class="container">
        <h1>Welcome to </h1><br>
        <h1>Centralized Database For Student Details</h1>
        <a href="login_admin.php" class="btn">Admin Login</a>
        <a href="login_faculty.php" class="btn">Faculty Login</a>
    </div>
</body>
</html>
