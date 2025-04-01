<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../auth/login.html"); // Redirect if not logged in
    exit();
}

$username = $_SESSION['username'];

require_once '../../config/db.php';
$database = new Database();
$db = $database->connect();

// Fetch the logged-in user's high score
$query = "SELECT high_score FROM users WHERE username = ?";
$stmt = $db->prepare($query);
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$highScore = $user ? $user['high_score'] : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="icon" type="image/png" href="../../assets/images/favicon.png">

    <title>Game Instructions and Guide</title>

</head>
<body class="bg-green display-center-center">

    <div class="long-row">
        <p class="sm-btn" style="background-color: #ffffff;color: rgb(0, 0, 0);width: 290px;">Game Instructions and Guide</p>
        <img src="../../assets/images/Logo.png" style="width: 8vw;">

    </div>

    <div class="large-container display-center-center mt-1">

        <h1 class="title">📝 How to Play Jungle Jumble</h1>

            <div class="scroll-box">
            <div class="step">
                <h2>🔤 Step 1: Unscramble the Word</h2>
                <p>A shuffled word will appear on your screen. Your goal is to rearrange the letters and guess the correct word.</p>
            </div>

            <div class="step">
                <h2>⏳ Step 2: Beat the Timer</h2>
                <p>You have a limited time to guess each word. If the timer runs out, you lose a life! Stay quick and sharp!</p>
            </div>

            <div class="step">
                <h2>❤️ Step 3: Manage Your Lives</h2>
                <p>You start with <b>3 lives</b>. If you guess wrong or time runs out, you lose a life. Once all lives are gone, it's Game Over!</p>
            </div>

            <div class="step">
                <h2>🍌 Bonus: Banana Game</h2>
                <p>Lost all your lives? Don’t worry! You can play a fun Banana Game to earn an extra life and continue playing!</p>
            </div>

            <div class="step">
                <h2>🏆 Step 4: High Scores</h2>
                <p>Try to beat your own <b>high score</b> and climb the leaderboard. The faster you solve words, the higher your score!</p>
            </div>
        </div>

    </div>

    <a href="../../views/game/home.php" class="sm-btn btn-dark mt-2">GO BACK</a>

    <script src="../../assets/js/background-music.js"></script>
    <script src="../../assets/js/sound.js"></script>

    <!--Background Video-->
    <video id="background-video" autoplay loop muted poster="">
        <source src="../../assets/images/bg.mp4" type="video/mp4">
    </video>
    
</body>
</html>