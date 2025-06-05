<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SportTeamsProject";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$playerName = $_POST['playerName'];
$playerSurname = $_POST['playerSurname'];
$jerseyNumber = $_POST['jerseyNumber'];

$sql = "INSERT INTO squadWomenHandball (playerName, playerSurname, jerseyNumber) VALUES (?, ?, ?)";
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
