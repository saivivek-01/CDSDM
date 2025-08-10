<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>
    <link rel="stylesheet" href="style1.css">
    <style>
        body {
            background-image: url('index.jpeg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }

        .login-container {
            max-width: 400px;
            margin: 80px auto;
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px #aaa;
        }

        .error {
            color: red;
            margin-bottom: 10px;
        }

        select, input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #4285f4;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #3367d6;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h1>Login</h1>

        <!-- Display error message if login fails -->
        <?php if (isset($_GET['error'])): ?>
            <div class="error"><?php echo htmlspecialchars($_GET['error']); ?></div>
        <?php endif; ?>

        <form action="auth.php" method="POST">
            <label>Username:</label>
            <input type="text" name="username" placeholder="Username" required>

            <label>Password:</label>
            <input type="password" name="password1" placeholder="Password" required>

            <label>Role:</label>
            <select name="role" required>
                <option value="">Select Role</option>
                <option value="admin">Admin</option>
                <option value="faculty">Faculty</option>
            </select>

            <button type="submit">Login</button>
        </form>
    </div>

</body>
</html>
