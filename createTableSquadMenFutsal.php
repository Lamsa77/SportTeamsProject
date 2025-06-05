<?php
$servername = "localhost";
$username = "root"; // Adjust if your DB has a different username
$password = "";     // Adjust if your DB has a password
$dbname = "SportTeamsProject";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL to create squadMenHandball table with 3 attributes
$sql = "CREATE TABLE IF NOT EXISTS squadMenFutsal (
    id INT(30) AUTO_INCREMENT PRIMARY KEY,
    playerName VARCHAR(100) NOT NULL,
    playerSurname VARCHAR(100) NOT NULL,
    jerseyNumber INT (30) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table squadMenFutsal created successfully.";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
