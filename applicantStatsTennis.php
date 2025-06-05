<?php
$servername = "localhost";
$username = "root"; // change if needed
$password = "";     // change if needed
$dbname = "SportTeamsProject";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$maleCount = $femaleCount = 0;
$maleAgeTotal = $femaleAgeTotal = 0;
$maleAgeCount = $femaleAgeCount = 0;

// Fetch data from Applicants table
// Fetch data from Applicants table where sport is Basketball
$sql = "SELECT gender, age FROM Applicants WHERE team = 'Table_Tennis'";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $gender = strtoupper($row['gender']);
        $age = (int)$row['age'];
        if ($gender == 'M') {
            $maleCount++;
            $maleAgeTotal += $age;
            $maleAgeCount++;
        } elseif ($gender == 'F') {
            $femaleCount++;
            $femaleAgeTotal += $age;
            $femaleAgeCount++;
        }
    }
} else {
    echo "<p style='text-align: center;'>No data available.</p>";
}

// Calculate average ages
$maleAvgAge = $maleAgeCount > 0 ? round($maleAgeTotal / $maleAgeCount, 2) : 0;
$femaleAvgAge = $femaleAgeCount > 0 ? round($femaleAgeTotal / $femaleAgeCount, 2) : 0;

// Close connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Applicant Statistics</title>
    <link rel="stylesheet" href="teamStatsHandball.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Table styling */
        .stats-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-family: Arial, sans-serif;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .stats-table th, .stats-table td {
            padding: 12px 15px;
            text-align: center;
            border: 1px solid #ddd;
        }

        .stats-table th {
            background-color: rgb(219, 76, 9);
            color: white;
        }

        .stats-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .stats-table tr:hover {
            background-color: #f1f1f1;
        }

        /* Container for both charts */
        .charts-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        /* Individual chart container */
        .chart-container {
            flex: 1 1 45%;
            max-width: 45%;
            min-width: 300px;
            background-color: #fff;
            padding: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            border-radius: 8px;
        }

        /* Canvas styling */
        .chart-container canvas {
            width: 100% !important;
            height: 300px !important;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .chart-container {
                flex: 1 1 100%;
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="index1">
        <div class="header1">
            <img src="Pictures/foxes_logo4.png" width="85px" height="80px">
            <p2>CYPRUS INTERNATIONAL UNIVERSITY</p2>
        </div>
        <div class="stats-container">
            <h1>Applicant Statistics</h1>
            <table class="stats-table">
                <tr>
                    <th>Gender</th>
                    <th>Number of Applicants</th>
                    <th>Average Age</th>
                </tr>
                <tr>
                    <td>Male</td>
                    <td><?php echo $maleCount; ?></td>
                    <td><?php echo $maleAvgAge; ?></td>
                </tr>
                <tr>
                    <td>Female</td>
                    <td><?php echo $femaleCount; ?></td>
                    <td><?php echo $femaleAvgAge; ?></td>
                </tr>
            </table>

            <!-- Charts Section -->
            <div class="charts-container">
                <div class="chart-container">
                    <h2>Applicant Count by Gender</h2>
                    <canvas id="applicantCountChart"></canvas>
                </div>
                <div class="chart-container">
                    <h2>Average Age by Gender</h2>
                    <canvas id="averageAgeChart"></canvas>
                </div>
            </div>

            <script>
                // Applicant Count Chart
                var countCtx = document.getElementById('applicantCountChart').getContext('2d');
                var countChart = new Chart(countCtx, {
                    type: 'bar',
                    data: {
                        labels: ['Male', 'Female'],
                        datasets: [{
                            label: 'Number of Applicants',
                            data: [<?php echo $maleCount; ?>, <?php echo $femaleCount; ?>],
                            backgroundColor: ['rgba(0, 123, 255, 0.6)', 'rgba(255, 99, 132, 0.6)'],
                            borderColor: ['rgba(0, 123, 255, 1)', 'rgba(255, 99, 132, 1)'],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        aspectRatio: 2,
                        plugins: {
                            title: {
                                display: true,
                                text: 'Number of Applicants by Gender'
                            },
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1
                                }
                            },
                            x: {
                                title: {
                                    display: true,
                                    text: 'Gender'
                                }
                            }
                        }
                    }
                });

                // Average Age Chart
                var ageCtx = document.getElementById('averageAgeChart').getContext('2d');
                var ageChart = new Chart(ageCtx, {
                    type: 'bar',
                    data: {
                        labels: ['Male', 'Female'],
                        datasets: [{
                            label: 'Average Age',
                            data: [<?php echo $maleAvgAge; ?>, <?php echo $femaleAvgAge; ?>],
                            backgroundColor: ['rgba(0, 123, 255, 0.6)', 'rgba(255, 99, 132, 0.6)'],
                            borderColor: ['rgba(0, 123, 255, 1)', 'rgba(255, 99, 132, 1)'],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        aspectRatio: 2,
                        plugins: {
                            title: {
                                display: true,
                                text: 'Average Age by Gender'
                            },
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true
                            },
                            x: {
                                title: {
                                    display: true,
                                    text: 'Gender'
                                }
                            }
                        }
                    }
                });
            </script>
        </div>
    </div>
</body>
</html>
