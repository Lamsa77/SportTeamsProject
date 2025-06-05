<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SportTeamsProject";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];


    $sql = "SELECT * FROM Admins WHERE user_name = ? AND user_password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $input_username, $input_password);
    $stmt->execute();
    $result = $stmt->get_result();

 
    if ($result->num_rows > 0) {
        
        $redirects = [
            "handballCoach"    => "adminHandballWelcome.html",
            "basketballCoach"  => "adminBasketballWelcome.html",
            "footballCoach"    => "adminFootballWelcome.html",
            "futsalCoach"      => "adminFutsalWelcome.html",
            "volleyballCoach"  => "adminVolleyballWelcome.html",
            "swimmingCoach"    => "adminSwimmingWelcome.html",
            "chessCoach"       => "adminChessWelcome.html",
            "bowlingCoach"     => "adminBowlingWelcome.html",
            "tennisCoach"      => "adminTennisWelcome.html",
            "athletCoach"      => "adminAthletWelcome.html"
        ];

        if (array_key_exists($input_username, $redirects)) {
            header("Location: " . $redirects[$input_username]);
            exit();
        } else {
            echo "Logged in successfully, but no redirect page found for this user.";
        }
    } else {
        echo "The user does not exist.";
    }

    $stmt->close();
}

$conn->close();
?>
