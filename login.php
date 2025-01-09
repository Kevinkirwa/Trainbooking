<?php
session_start();
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch the user from the database
    $result = $conn->query("SELECT * FROM Users WHERE username = '$username'");
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['is_admin'] = $user['is_admin']; // Store the admin flag
        $_SESSION['loyalty_points'] = $user['loyalty_points'];

        // Check if the user is an admin
        if ($user['is_admin'] == 1) {
            // Redirect to the admin dashboard if the user is an admin
            header("Location: admin_dashboard.php");
        } else {
            // Redirect to the user dashboard if the user is a regular user
            header("Location: user_dashboard.php");
        }
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Train Booking</title>
</head>
<body>
    <h2>Login</h2>
    <form action="login.php" method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
    <p><?php echo isset($error) ? $error : ''; ?></p>
    <p>Don't have an account? <a href="register.php">Register here</a></p>
</body>
</html>
