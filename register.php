<?php
session_start();
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password != $confirm_password) {
        $error = "Passwords do not match!";
    } else {
        // Check if the username or email already exists
        $result = $conn->query("SELECT * FROM Users WHERE username = '$username' OR email = '$email'");
        if ($result->num_rows > 0) {
            $error = "Username or Email already exists!";
        } else {
            // Insert the new user into the database
            $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Encrypt password
            $conn->query("INSERT INTO Users (username, email, password) VALUES ('$username', '$email', '$hashed_password')");
            header("Location: login.php"); // Redirect to login page after successful registration
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Train Booking</title>
</head>
<body>
    <h2>Register</h2>
    <form action="register.php" method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        <button type="submit">Register</button>
    </form>
    <p><?php echo isset($error) ? $error : ''; ?></p>
    <p>Already have an account? <a href="login.php">Login here</a></p>
</body>
</html>
