<?php
$servername = "localhost";
$username = "root";    
$password = "";            
$dbname = "SportTeamsProject";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$team = isset($_POST['team']) ? $conn->real_escape_string($_POST['team']) : '';
$season = isset($_POST['season']) ? $conn->real_escape_string($_POST['season']) : '';
$win = isset($_POST['win']) ? (int)$_POST['win'] : 0;
$loss = isset($_POST['loss']) ? (int)$_POST['loss'] : 0;
$draw = isset($_POST['draw']) ? (int)$_POST['draw'] : 0;

$sql = "INSERT INTO AddStatsSwimming (Team, Season, Win, Loss, Draw)
        VALUES ('$team', '$season', $win, $loss, $draw)";

if ($conn->query($sql) === TRUE) {
    echo "Statistics successfully added!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
