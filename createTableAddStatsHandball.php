<?php
$servername = "localhost";
$username = "root"; // default in XAMPP
$password = "";     // default in XAMPP
$dbname = "SportTeamsProject"; // change to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL to create table
$sql = "CREATE TABLE IF NOT EXISTS AddStatsHandball (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Team CHAR(1) NOT NULL,         -- 'M' or 'W'
    Season VARCHAR(9) NOT NULL,    -- e.g. '2024/2025'
    Win INT NOT NULL,
    Loss INT NOT NULL,
    Draw INT NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table AddStatsHandball created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
