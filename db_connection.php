
<?php
$servername = "localhost";  // Replace with your server name (usually localhost)
$username = "root";         // Replace with your MySQL username (usually root)
$password = "Faith202#";             // Replace with your MySQL password (empty for XAMPP/WAMP)
$dbname = "UniqueTrainBooking";  // Make sure this matches your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
