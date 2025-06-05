<?php
// Database connection details
$servername = "localhost";
$username = "root";        // Default for XAMPP
$password = "";            // Default for XAMPP
$dbname = "SportTeamsProject";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect form data and sanitize
$team = isset($_POST['team']) ? $conn->real_escape_string($_POST['team']) : '';
$season = isset($_POST['season']) ? $conn->real_escape_string($_POST['season']) : '';
$win = isset($_POST['win']) ? (int)$_POST['win'] : 0;
$loss = isset($_POST['loss']) ? (int)$_POST['loss'] : 0;
$draw = isset($_POST['draw']) ? (int)$_POST['draw'] : 0;

// SQL Insert statement
$sql = "INSERT INTO AddStatsFutsal (Team, Season, Win, Loss, Draw)
        VALUES ('$team', '$season', $win, $loss, $draw)";

// Execute the insert and check for success
if ($conn->query($sql) === TRUE) {
    echo "Statistics successfully added!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close DB connection
$conn->close();
?>
