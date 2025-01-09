<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $station_name_en = $_POST['station_name_en'];
    $station_name_sw = $_POST['station_name_sw'];
    $location = $_POST['location'];
    $region = $_POST['region'];

    $sql = "INSERT INTO Stations (station_name_en, station_name_sw, location, region)
            VALUES ('$station_name_en', '$station_name_sw', '$location', '$region')";

    if ($conn->query($sql) === TRUE) {
        header("Location: admin_dashboard.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
