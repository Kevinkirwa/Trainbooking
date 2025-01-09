<?php
session_start();
include 'db_connection.php';

// Ensure the user is an admin
if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Train Booking</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="logo">
            <h1>Train Booking System</h1>
        </div>
        <nav>
            <a href="admin_dashboard.php">Dashboard</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <main>
        <section>
            <h2>Stations</h2>
            <table>
                <thead>
                    <tr>
                        <th>Station Name</th>
                        <th>Location</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stations = $conn->query("SELECT * FROM Stations");
                    while ($station = $stations->fetch_assoc()) {
                        echo "<tr>
                                <td>{$station['station_name']}</td>
                                <td>{$station['location']}</td>
                            </tr>";
                    }
                    ?>
                </tbody>
            </table>

            <h3>Add Station</h3>
            <form action="add_station.php" method="POST">
                <input type="text" name="station_name" placeholder="Station Name" required>
                <input type="text" name="location" placeholder="Location" required>
                <button type="submit">Add Station</button>
            </form>

            <h2>Trains</h2>
            <table>
                <thead>
                    <tr>
                        <th>Train Name</th>
                        <th>Train Code</th>
                        <th>Capacity</th>
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
                            </tr>";
                    }
                    ?>
                </tbody>
            </table>

            <h3>Add Train</h3>
            <form action="add_train.php" method="POST">
                <input type="text" name="train_name" placeholder="Train Name" required>
                <input type="text" name="train_code" placeholder="Train Code" required>
                <input type="number" name="capacity" placeholder="Capacity" required>
                <button type="submit">Add Train</button>
            </form>
            <h2>Add New Admin</h2>
    <form action="add_admin.php" method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Add Admin</button><br>
    </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Train Booking System</p>
    </footer>
</body>
</html>
