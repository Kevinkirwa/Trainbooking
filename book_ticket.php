<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['user_id']) || $_SESSION['is_admin']) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['train_id'])) {
    $train_id = $_GET['train_id'];
    $user_id = $_SESSION['user_id'];

    // Book the ticket
    $conn->query("INSERT INTO Bookings (user_id, train_id, station_id) VALUES ('$user_id', '$train_id', 1)");

    // Add loyalty points
    $conn->query("UPDATE Users SET loyalty_points = loyalty_points + 10 WHERE user_id = '$user_id'");

    // Update the user's session loyalty points
    $_SESSION['loyalty_points'] += 10;

    header("Location: user_dashboard.php");
    exit();
}
?>
