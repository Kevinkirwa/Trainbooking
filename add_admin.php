<?php
session_start();
include 'db_connection.php';

// Check if the user is an admin
if ($_SESSION['is_admin'] != 1) {
    header("Location: user_dashboard.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert new admin into the database
    $query = "INSERT INTO Users (username, email, password, is_admin) 
              VALUES ('$username', '$email', '$hashed_password', 1)";

    if ($conn->query($query)) {
        echo "Admin added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
