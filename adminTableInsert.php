<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SportTeamsProject";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$usernames = [
    "handballCoach",
    "basketballCoach",
    "footballCoach",
    "futsalCoach",
    "volleyballCoach",
    "swimmingCoach",
    "chessCoach",
    "bowlingCoach",
    "tennisCoach",
    "athletCoach"
];

$stmt = $conn->prepare("INSERT INTO Admins (user_name, user_password) VALUES (?, ?)");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

foreach ($usernames as $uname) {
    $plainPassword = $uname . "123"; 

    $stmt->bind_param("ss", $uname, $plainPassword);
    $stmt->execute();
}

echo "10 users with plain text passwords have been added to the Admins table.";


$stmt->close();
$conn->close();
?>
