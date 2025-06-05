<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SportTeamsProject";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$playerName = $_POST['playerName'];
$playerSurname = $_POST['playerSurname'];
$jerseyNumber = $_POST['jerseyNumber'];

// Prepare and execute insert query
$sql = "INSERT INTO squadWomenBasketball (playerName, playerSurname, jerseyNumber) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssi", $playerName, $playerSurname, $jerseyNumber);

if ($stmt->execute()) {
    echo "Player added successfully.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
