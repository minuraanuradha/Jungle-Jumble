<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../auth/login.html"); // Redirect if not logged in
    exit();
}

$username = $_SESSION['username'];

require_once '../../config/db.php'; // Database connection

$database = new Database();
$db = $database->connect();

$query = "SELECT username, high_score FROM users ORDER BY high_score DESC LIMIT 10";
$stmt = $db->prepare($query);
$stmt->execute();
$players = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="icon" type="image/png" href="../../assets/images/favicon.png">

    <title>LeaderBoard Page</title>

    <style>
        .leaderboard-table {
    width: 100%;
    border-collapse: collapse;
    text-align: center;
    font-size: 1.2em;
}

.leaderboard-table th {
    background-color: #222;
    color: #fff;
    padding: 10px;
}

.leaderboard-table td {
    background-color: #f4f4f4;
    padding: 10px;
}

.gold {
    background-color: #ffd700;
}

.silver {
    background-color: #c0c0c0;
}

.bronze {
    background-color: #cd7f32;
}

tr:nth-child(even) {
    background-color: #e8e8e8;
}

    </style>
</head>
<body class="bg-green display-center-center">

    <div class="long-row">
        <p class="sm-btn" style="background-color: #ffffff;color: rgb(0, 0, 0);width: 290px;">Hint</p>
        <img src="../../assets/images/Logo.png" style="width: 8vw;">

    </div>

    <div class="large-container display-center-center mt-1">
    <table class="leaderboard-table">
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Name</th>
                    <th>High Score</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $rank = 1;
                foreach ($players as $player) {
                    $highlightClass = ($rank == 1) ? 'gold' : (($rank == 2) ? 'silver' : (($rank == 3) ? 'bronze' : ''));
                    echo "<tr class='{$highlightClass}'>
                            <td>" . str_pad($rank, 2, "0", STR_PAD_LEFT) . "</td>
                            <td>" . htmlspecialchars($player['username']) . "</td>
                            <td>" . $player['high_score'] . "</td>
                          </tr>";
                    $rank++;
                }
                ?>
            </tbody>
        </table>
    </div>

    <a href="../../views/game/home.html" class="sm-btn btn-dark mt-2">GO BACK</a>

    <!--Background Video-->
    <video id="background-video" autoplay loop muted poster="">
        <source src="../../assets/images/bg.mp4" type="video/mp4">
    </video>
    
</body>
</html>