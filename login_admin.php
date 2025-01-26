<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>

    <link rel="stylesheet" href="style1.css">
    <style>
    body {
  background-image: url('adminlogin.jpeg');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: 100% 100%;
}
</style>
</head>
<body>

    <div class="login-container">
        <h1>Admin Login</h1>

        <!-- Display error message if login fails -->
        <?php if (isset($_GET['error'])): ?>
            <div class="error"><?php echo htmlspecialchars($_GET['error']); ?></div>
        <?php endif; ?>

        <form action="auth.php" method="POST">
            <input type="hidden" name="role" value="admin">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password1" placeholder="Password" required><br>
            <button type="submit">Login</button>
        </form>
    </div>

</body>
</html>


