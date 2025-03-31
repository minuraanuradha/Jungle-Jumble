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

    <title>Setting</title>
    <style>
    </style>

</head>
<body class="bg-green display-center-center">

    <div class="long-row">
        <p class="sm-btn" style="background-color: #ffffff;color: rgb(0, 0, 0);width: 290px;">Setting</p>
        <img src="../../assets/images/Logo.png" style="width: 8vw;">
    </div>

    <div class="large-container display-center-center mt-1">
        <div class="toggle-container">
            <div class="toggle-wrapper">
                <p>Background Music</p>
                <div id="toggle-music" class="toggle-switch"></div>
            </div>
            <div class="toggle-wrapper">
                <p>Sound Effects</p>
                <div id="toggle-sounds" class="toggle-switch"></div>
            </div>
            <div class="toggle-wrapper">
                <p>Volume</p>
                <input type="range" id="volume-slider" min="0" max="1" step="0.1">
            </div>
        </div>
    </div>

    <a href="../../views/game/home.php" class="sm-btn btn-dark mt-2 btn-nav">GO BACK</a>

    <!-- External Scripts -->
    <script src="../../assets/js/background-music.js"></script>
    <script src="../../assets/js/sound.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const musicToggle = document.getElementById("toggle-music");
            const soundToggle = document.getElementById("toggle-sounds");
            const volumeSlider = document.getElementById("volume-slider");

            // Apply stored settings
            musicToggle.classList.toggle("active", window.backgroundMusic.muted);
            soundToggle.classList.toggle("active", localStorage.getItem("muteSounds") === "true");
            volumeSlider.value = localStorage.getItem("volume") || 0.5;

            // Toggle event listeners
            musicToggle.addEventListener("click", toggleMusic);
            soundToggle.addEventListener("click", toggleSounds);
            volumeSlider.addEventListener("input", (event) => updateVolume(event.target.value));
        });
    </script>

    <!--Background Video-->
    <video id="background-video" autoplay loop muted poster="">
        <source src="../../assets/images/bg.mp4" type="video/mp4">
    </video>
    
</body>
</html>
