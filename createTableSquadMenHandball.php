<?php
$servername = "localhost";
$username = "root"; 
$password = "";     
$dbname = "SportTeamsProject";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE TABLE IF NOT EXISTS squadMenHandball (
    id INT(30) AUTO_INCREMENT PRIMARY KEY,
    playerName VARCHAR(100) NOT NULL,
    playerSurname VARCHAR(100) NOT NULL,
    jerseyNumber INT (30) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table squadMenHandball created successfully.";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
