<?php

$servername = "localhost";
$username = "root";    
$password = "";         
$dbname = "SportTeamsProject";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "CREATE TABLE IF NOT EXISTS Applicants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    FirstName VARCHAR(100) NOT NULL,
    LastName VARCHAR(100) NOT NULL,
    StudentID INT NOT NULL UNIQUE,
    DateOfBirth DATE NOT NULL,
    Gender CHAR(1) NOT NULL,
    Email VARCHAR(150) NOT NULL,
    PhoneNumber VARCHAR(20) NOT NULL,
    Department VARCHAR(100) NOT NULL,
    Team VARCHAR(50) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'Applicants' created successfully.";
} else {
    echo "Error creating table: " . $conn->error;
}


$conn->close();
?>
