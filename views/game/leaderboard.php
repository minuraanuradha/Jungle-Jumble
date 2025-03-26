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

</head>
<body class="bg-green display-center-center">

    <div class="long-row">
        <p class="sm-btn" style="background-color: #ffffff;color: rgb(0, 0, 0);width: 290px;">Leader Board</p>
        <img src="../../assets/images/Logo.png" style="width: 8vw;">

    </div>

    <div class="large-container display-center-center mt-1">
        <div class="leaderboard-container header">
        <div class='leaderboard-card  table-head'>
                        <div class='rank'>Rank</div>
                        <div class='name'>Name</div>
                        <div class='score'>High Score</div>
                    </div>
        </div>
        <div class="leaderboard-container scrollable">
            <?php
            $rank = 1;
            foreach ($players as $player) {
                $highlightClass = ($rank == 1) ? 'gold' : (($rank == 2) ? 'silver' : (($rank == 3) ? 'bronze' : ''));
                echo "<div class='leaderboard-card {$highlightClass} mt-1'>
                        <div class='rank'>" . str_pad($rank, 2, "0", STR_PAD_LEFT) . "</div>
                        <div class='name'>" . htmlspecialchars($player['username']) . "</div>
                        <div class='score'>" . $player['high_score'] . "</div>
                    </div>";
                $rank++;
            }
            ?>
        </div>
    </div>

    <a href="../../views/game/home.php" class="sm-btn btn-dark mt-2">GO BACK</a>

    <!--Background Video-->
    <video id="background-video" autoplay loop muted poster="">
        <source src="../../assets/images/bg.mp4" type="video/mp4">
    </video>
    
</body>
</html>