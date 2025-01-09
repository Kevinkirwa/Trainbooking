<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['user_id']) || $_SESSION['is_admin']) {
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Train Booking</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="logo">
            <h1>Train Booking System</h1>
        </div>
        <nav>
            <a href="user_dashboard.php">Dashboard</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <main>
        <section>
            <h2>Your Loyalty Points: <?php echo $_SESSION['loyalty_points']; ?></h2>
            <h2>Available Trains</h2>
            <table>
                <thead>
                    <tr>
                        <th>Train Name</th>
                        <th>Train Code</th>
                        <th>Capacity</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $trains = $conn->query("SELECT * FROM Trains");
                    while ($train = $trains->fetch_assoc()) {
                        echo "<tr>
                                <td>{$train['train_name']}</td>
                                <td>{$train['train_code']}</td>
                                <td>{$train['capacity']}</td>
                                <td><a href='book_ticket.php?train_id={$train['train_id']}'>Book</a></td>
                            </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Train Booking System</p>
    </footer>
</body>
</html>
