<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../auth/login.php"); // Redirect if not logged in
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

    <title>Home Dashboard</title>

</head>
<body class="bg-green bg-1">

    <div class=" display-center-center" style="height: 100vh;">
        
        <img src="../../assets/images/monkey-smiling.png" style="width: 150px;">

        <h5 class="mt-1"> Hello, <?php echo htmlspecialchars($username); ?>!</h5>
        <h6 class="mt-2">🎯High Score : <?php echo htmlspecialchars($highScore); ?></h6>

        <a href="../game/game.php" id="click-sound"  class="btn btn-primary mt-3 btn-nav">START NEW GAME</a>
        <a href="../game/leaderboard.php" id="click-sound"  class="btn btn-secondary mt-1 btn-nav">LEADER BOARD</a>
        <a href="../game/howtoplay.html" id="click-sound"  class="btn btn-secondary mt-1 btn-nav">HOW TO PLAY</a>
        <a href="../game/setting.php" id="click-sound"  class="btn btn-secondary mt-1 btn-nav">SETTING</a>

        <a href="../../controllers/logout.php" class="btn btn-red mt-3">LOG OUT</a>
        
    </div>

    <script src="../../assets/js/background-music.js"></script>
    <script src="../../assets/js/sound.js"></script>

    <!--Background Video-->
    <video id="background-video" autoplay loop muted poster="">
        <source src="../../assets/images/bg.mp4" type="video/mp4">
    </video>

</body>
</html>