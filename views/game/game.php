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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="icon" type="image/png" href="../../assets/images/favicon.png">

    <script src="../../assets/js/words.js" defer></script>
    <script src="../../assets/js/gamescript.js" defer></script>
    <script src="../../assets/js/bananaGame.js" defer></script>

    <title>Jungle Jumble Game Play</title>

</head>
<body class="bg-green display-center-center bg-1">

    <div class="long-row">
        <p class="sm-btn" style="background-color: #ffffff;color: rgb(0, 0, 0);width: 290px;">Hello, <?php echo htmlspecialchars($username); ?> | Current High Score :  <?php echo htmlspecialchars($highScore); ?></p>
        <img src="../../assets/images/Logo.png" style="width: 8vw;">
        <div class="row"> 
            <p class="sm-btn" style="background-color: #F8D45C;color: white; margin-right: 10px;  display: flex; align-items: center;justify-content: center;">Score: <span id="score"> 0</span></p>
            <p class="sm-btn" style="background-color: #FF5454;color: white;">Lives: <span id="lives">3</span></p>
        </div>
    </div>

    <div class="large-container display-center-center mt-1">
        <p class="timer">⏳ 20s</p>
        <h2 class="mt-3 sufflewords"></h2>
        <p class="mt-4 hint">Hint:  <span> </span></p>
        <input type="text" name="checkword" id="checkword" placeholder="Can you unscramble this?" class="mt-5 input" >

        <div class="sm-row">
            <button class="sm-btn btn-secondary mt-1 refesh_BTN">Refresh Word</button>
            <button class="sm-btn btn-primary mt-1 check_BTN Enter">Check Word</button>
        </div>

    </div>

    <a href="../../views/game/home.php" class="sm-btn btn-dark mt-2">EXIT</a>

    <script src="../../assets/js/background-music.js"></script>
    <script src="../../assets/js/sound.js"></script>

    <!-- Message Box -->
    <div class="message-box" >
        <p class="message-text"></p>
    </div>

    <!-- Banana Game Modal -->
    <div class="banana-game" style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(42, 42, 42, 0.95); color: white; display: flex; flex-direction: column; align-items: center; justify-content: center;">
        <img src="../../assets/images/monkey-thinking.png" style="width: 150px;">    
        <h1>❓ Want Another Chance?</h1>
        <p>Play the Banana Game to earn an extra life!</p>
        <button onclick="playBananaGame()" class="btn btn-primary mt-3">🍌 Play</button>
        <button onclick="gameOver()" class="btn btn-dark mt-2">❌ No, End Game</button>
    </div>

    <!-- Game Over Screen -->
    <div class="game-over" style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(42, 42, 42, 0.9); color: white; display: flex; flex-direction: column; align-items: center; justify-content: center;">
        <img src="../../assets/images/monkey-smiling.png" style="width: 150px;">
        <h1>💀 Game Over!</h1>
        <p>Your Final Score: <span id="final-score">0</span></p>
        <button onclick="restartGame()" class="btn btn-primary mt-3">Restart Game</button>
        <a href="../../views/game/home.php" class="btn btn-red mt-2">Return Home</a>
    </div>

    <!--Background Video-->
    <video id="background-video" autoplay loop muted poster="">
        <source src="../../assets/images/bg.mp4" type="video/mp4">
    </video>

</body>
</html>