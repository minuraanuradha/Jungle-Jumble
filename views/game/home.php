<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../auth/login.html"); // Redirect if not logged in
    exit();
}
$username = $_SESSION['username'];
$highScore = $_SESSION['high_score'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="icon" type="image/png" href="../assets/images/favicon.png">

    <title>Home Page</title>

</head>
<body class="bg-green bg-1">

    <div class=" display-center-center" style="height: 100vh;">
        
        <img src="../../assets/images/monkey-01.png" style="width: 150px;">

        <h5 class="mt-1"><?php echo htmlspecialchars($username); ?></h5>
        <h6 class="mt-1"> <?php echo htmlspecialchars($highScore); ?></h6>

        <a href="../game/game.html" class="btn btn-primary mt-3">START NEW GAME</a>
        <a href="../game/leaderboard.html" class="btn btn-secondary mt-1">LEADER BOARD</a>
        <a href="../game/howtoplay.html" class="btn btn-secondary mt-1">HOW TO PLAY</a>
        <a href="../game/setting.html" class="btn btn-secondary mt-1">SETTING</a>

        <a href="../../controllers/logout.php" class="btn btn-dark mt-3">LOG OUT</a>
        
    </div>

    <!--Background Video-->
    <video id="background-video" autoplay loop muted poster="">
        <source src="../../assets/images/bg.mp4" type="video/mp4">
    </video>

</body>
</html>