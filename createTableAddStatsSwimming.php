<?php
$servername = "localhost";
$username = "root"; 
$password = "";    
$dbname = "SportTeamsProject"; 

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE TABLE IF NOT EXISTS AddStatsSwimming (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Team CHAR(1) NOT NULL,        
    Season VARCHAR(9) NOT NULL,  
    Win INT NOT NULL,
    Loss INT NOT NULL,
    Draw INT NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table AddStatsSwimming created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
