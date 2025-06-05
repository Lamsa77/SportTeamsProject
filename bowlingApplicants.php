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


$sql = "SELECT id, FirstName, LastName, StudentID, DateOfBirth,
Gender, Email, PhoneNumber, Department, Team FROM Applicants WHERE Team = 'Bowling'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bowling Applicants</title>
    <style>
        /* Global styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            color: #333;
        }

        /* Full-page background styling */
        .background {
            background: url('your-background-image.jpg') no-repeat center center fixed; 
            background-size: cover;
            position: fixed;
            width: 100%;
            height: 100%;
            z-index: -1; /* Ensures the background stays behind content */
        }

        /* Header Styles */
        .header1 {
            width: 100%;
            height: 113px;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            background-color: rgb(85, 84, 84);
            position: fixed;
            z-index: 1000;
            top: 0;
        }

        .header1 p2 {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: xx-large;
            margin-left: 2%;
            color: rgb(219, 33, 9);
        }

        /* Container for the content */
        .container {
            width: 80%;
            margin: 80px auto;
            background-color: rgba(255, 255, 255, 0.8); /* Slight opacity for better readability */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 36px;
            color: #333;
        }

        /* Table styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        /* Add a subtle shadow on table rows for better visibility */
        tr {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Make the content container responsive */
        @media (max-width: 768px) {
            .container {
                width: 95%;
                padding: 20px;
            }

            h1 {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="header1">
    <p1><img src="Pictures/foxes_logo4.png" width="85px" height="80px"><br></p1>
    <p2>CYPRUS INTERNATIONAL UNIVERSITY</p2>
    </div>

    <!-- Background image -->
    <div class="background"></div>

    <!-- Main content container -->
    <div class="container">
        <h1>Bowling Applicants</h1>
        
        <?php
        if ($result->num_rows > 0) {
            echo "<table>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Student ID</th>
                        <th>Date of Birth</th>
                        <th>Gender</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Department</th>
                    </tr>";

            $counter = 1;  // Counter variable to display the order

            // Output data for each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $counter++ . "</td>  <!-- Display the row number -->
                        <td>" . $row["FirstName"] . " " . $row["LastName"] . "</td>
                        <td>" . $row["StudentID"] . "</td>
                        <td>" . $row["DateOfBirth"] . "</td>
                        <td>" . $row["Gender"] . "</td>
                        <td>" . $row["Email"] . "</td>
                        <td>" . $row["PhoneNumber"] . "</td>
                        <td>" . $row["Department"] . "</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No Bowling applicants found.</p>";
        }

        // Close connection
        $conn->close();
        ?>
    </div>

</body>
</html>
