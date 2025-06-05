<?php

$servername = "localhost";
$username = "root";    
$password = "";         
$dbname = "SportTeamsProject";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "CREATE TABLE IF NOT EXISTS Admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_name VARCHAR(100) NOT NULL,
    user_password VARCHAR(100) NOT NULL
   
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'Admins' created successfully.";
} else {
    echo "Error creating table: " . $conn->error;
}


$conn->close();
?>
