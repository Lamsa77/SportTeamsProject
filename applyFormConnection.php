<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SportTeamsProject";

$firstname   = $_POST["firstName"];
$lastname    = $_POST["lastName"];
$studentID   = $_POST["studentID"];
$d_o_b       = $_POST["DoB"]; 
$gender      = $_POST["Gender"];
$email       = $_POST["EMail"];
$phone_no    = $_POST["phoneNo"];
$department  = $_POST["Department"];
$team        = $_POST["Team"];

$dob = new DateTime($d_o_b);
$today = new DateTime();
$age = $dob->diff($today)->y;

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO Applicants (FirstName, LastName, StudentID, DateOfBirth, Gender, Email,
PhoneNumber, Department, Team, Age)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Preparation failed: " . $conn->error);
}

$stmt->bind_param("ssissssssi", $firstname, $lastname,
$studentID, $d_o_b, $gender, $email, $phone_no, $department, $team, $age);
if ($stmt->execute()) {
    echo "✅ You have been added to the list of applicants. Welcome to the Foxes Family!";
} else {
    echo "❌ Insert failed: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
