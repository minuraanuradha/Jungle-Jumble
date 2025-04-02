<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../auth/login.html");
    exit();
}

$username = $_SESSION['username'];
require_once '../../config/db.php';
$database = new Database();
$db = $database->connect();

// Fetch current score from the request (if passed)
$score = isset($_GET['score']) ? intval($_GET['score']) : 0;

// Assume this is where you determine if the player won
$playerWon = false; // This should be set based on the game logic


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="icon" type="image/png" href="../../assets/images/favicon.png">

    <script src="../../assets/js/words.js" defer></script>
    <script src="../../assets/js/bananaGame.js" defer></script>


    <title>Collect Bananas Game Play</title>

</head>
<body class="bg-green display-center-center bg-1">

    <div class="long-row">
        <p class="sm-btn" style="background-color: #ffffff;color: rgb(0, 0, 0);width: 290px;">Let's Collect Lives</p>
        <img src="../../assets/images/Logo.png" style="width: 8vw;">
        <div class="row"> 
            <p class="sm-btn" style="background-color: #FF5454;color: white;">Lives: <span id="lives">3</span></p>
        </div>
    </div>

    <div class="large-container mt-1 banana">
        <div class="display-center-center left-container">
            10000
        </div>
        <div class="display-center-center right-container">
            <p class="timer">⏳ 20s</p>
            <input type="text" name="checknum" id="checknum" placeholder="Can you Solve this?" class="mt-2 flex-input" autofocus >
                <button class="flex-btn btn-primary mt-1 checknum_BTN Enter">Enter Value</button>

        </div>
    </div>

    <a href="../../views/game/home.php" class="sm-btn btn-dark mt-2">EXIT</a>

    <script src="../../assets/js/background-music.js"></script>
    <script src="../../assets/js/sound.js"></script>

    <!-- Game Over Notification -->
    <div class="game-over" style="display: none;position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(42, 42, 42, 0.91); color: white; display: flex; flex-direction: column; align-items: center; justify-content: center;">
        <img src="../../assets/images/monkey-crying.png" style="width: 150px;">
        <h1>💀 Game Over!</h1>
        <p class="mt-1">Your Final Score: <span id="final-score">0</span></p>
        <a href="../../views/game/home.php" class="btn btn-red mt-2">Exit</a>
    </div>

    <!--Background Video-->
    <video id="background-video" autoplay loop muted poster="">
        <source src="../../assets/images/bg.mp4" type="video/mp4">
    </video>

</body>
</html>