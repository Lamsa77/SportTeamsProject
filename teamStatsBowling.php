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

// Fetch all rows from the addStatsHandball table
$sql = "SELECT season, team, win, loss, draw FROM AddStatsBowling ORDER BY season DESC, team ASC;";
$result = $conn->query($sql);

// Arrays to store data for the charts
$seasons = [];
$menWins = [];
$menLosses = [];
$menDraws = [];
$womenWins = [];
$womenLosses = [];
$womenDraws = [];

if ($result->num_rows > 0) {
    // Reset pointer to start
    $result->data_seek(0);
    while ($row = $result->fetch_assoc()) {
        $season = $row['season'];
        $team = $row['team'];
        $win = (int)$row['win'];
        $loss = (int)$row['loss'];
        $draw = (int)$row['draw'];

        if (!in_array($season, $seasons)) {
            $seasons[] = $season;
        }

        if ($team == 'M') {
            $menWins[] = $win;
            $menLosses[] = $loss;
            $menDraws[] = $draw;
        } elseif ($team == 'W') {
            $womenWins[] = $win;
            $womenLosses[] = $loss;
            $womenDraws[] = $draw;
        }
    }
} else {
    echo "<p style='text-align: center;'>No data available.</p>";
}

// Close connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bowling Team Stats</title>
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
            <h1>Bowling Team Stats</h1>
            <?php
            if (!empty($seasons)) {
                echo "<table class='stats-table'>";
                echo "<tr><th>Season</th><th>Team</th><th>Wins</th><th>Losses</th><th>Draws</th></tr>";
                // Re-fetch data for table display
                $conn = new mysqli($servername, $username, $password, $dbname);
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['season']}</td>
                            <td>" . ($row['team'] == 'M' ? 'Men' : 'Women') . "</td>
                            <td>{$row['win']}</td>
                            <td>{$row['loss']}</td>
                            <td>{$row['draw']}</td>
                          </tr>";
                }
                echo "</table>";
                $conn->close();
            } else {
                echo "<p style='text-align: center;'>No data available for the table.</p>";
            }
            ?>
            <!-- Charts Section -->
            <div class="charts-container">
                <div class="chart-container">
                    <h2>Men's Stats</h2>
                    <canvas id="menStatsChart"></canvas>
                </div>
                <div class="chart-container">
                    <h2>Women's Stats</h2>
                    <canvas id="womenStatsChart"></canvas>
                </div>
            </div>
            <script>
                // JavaScript to create the Men graph using Chart.js
                var menCtx = document.getElementById('menStatsChart').getContext('2d');
                var menChart = new Chart(menCtx, {
                    type: 'bar',
                    data: {
                        labels: <?php echo json_encode($seasons); ?>,
                        datasets: [
                            {
                                label: 'Wins',
                                data: <?php echo json_encode($menWins); ?>,
                                backgroundColor: 'rgba(0, 123, 255, 0.6)',
                                borderColor: 'rgba(0, 123, 255, 1)',
                                borderWidth: 1,
                            },
                            {
                                label: 'Losses',
                                data: <?php echo json_encode($menLosses); ?>,
                                backgroundColor: 'rgba(255, 159, 64, 0.6)',
                                borderColor: 'rgba(255, 159, 64, 1)',
                                borderWidth: 1,
                            },
                            {
                                label: 'Draws',
                                data: <?php echo json_encode($menDraws); ?>,
                                backgroundColor: 'rgba(75, 192, 192, 0.6)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1,
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        aspectRatio: 2,
                        plugins: {
                            title: {
                                display: true,
                                text: 'Men Bowling Team Statistics'
                            },
                            legend: {
                                position: 'top',
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
                                    text: 'Season'
                                }
                            }
                        }
                    }
                });

                // JavaScript to create the Women graph using Chart.js
                var womenCtx = document.getElementById('womenStatsChart').getContext('2d');
                var womenChart = new Chart(womenCtx, {
                    type: 'bar',
                    data: {
                        labels: <?php echo json_encode($seasons); ?>,
                        datasets: [
                            {
                                label: 'Wins',
                                data: <?php echo json_encode($womenWins); ?>,
                                backgroundColor: 'rgba(255, 99, 132, 0.6)',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1,
                            },
                            {
                                label: 'Losses',
                                data: <?php echo json_encode($womenLosses); ?>,
                                backgroundColor: 'rgba(153, 102, 255, 0.6)',
                                borderColor: 'rgba(153, 102, 255, 1)',
                                borderWidth: 1,
                            },
                            {
                                label: 'Draws',
                                data: <?php echo json_encode($womenDraws); ?>,
                                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1,
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        aspectRatio: 2,
                        plugins: {
                            title: {
                                display: true,
                                text: 'Women Bowling Team Statistics'
                            },
                            legend: {
                                position: 'top',
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
                                    text: 'Season'
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
