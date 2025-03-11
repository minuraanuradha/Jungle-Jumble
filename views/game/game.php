<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="icon" type="image/png" href="../../assets/images/favicon.png">

    <script src="../../assets/js/words.js" defer></script>
    <script src="../../assets/js/gamescript.js" defer></script>

    <title>Jungle Jumble Game Play</title>

</head>
<body class="bg-green display-center-center bg-1">

    <div class="long-row">
        <p class="sm-btn" style="background-color: #ffffff;color: rgb(0, 0, 0);width: 290px;">Hint</p>
        <img src="../../assets/images/Logo.png" style="width: 8vw;">
        <div class="row"> 
            <p class="sm-btn" style="background-color: #F8D45C;color: white; margin-right: 10px;">Score: <span id="score">0</span></p>
            <p class="sm-btn" style="background-color: #FF5454;color: white;">Lives: <span id="lives">3</span></p>
        </div>
    </div>

    <div class="large-container display-center-center mt-1">
        <p class="timer">⏳ 20s</p>
        <h1 class="mt-3 sufflewords"></h1>
        <p class="mt-2 hint">Hint:  <span> </span></p>
        <input type="text" name="checkword" id="checkword" placeholder="Can you unscramble this?" class="mt-4 input" >

        <div class="sm-row">
            <button class="sm-btn btn-secondary mt-1 refesh_BTN">Refresh Word</button>
            <button class="sm-btn btn-primary mt-1 check_BTN Enter">Check Word</button>
        </div>

        <div class="row mt-3">
            <img src="../../assets/images/monkey-01.png" style="width: 50px;">
            <p class="mt-2">Out of lives? Win some bananas!</p>
        </div>
    </div>

    <a href="../../views/game/home.html" class="sm-btn btn-dark mt-2">GO BACK</a>

    <!-- Message Box -->
    <div class="message-box" style="display: none; background-color: white; padding: 15px; border-radius: 5px; text-align: center;">
        <p class="message-text"></p>
    </div>

    <!-- Game Over Screen -->
    <div class="game-over" style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(42, 42, 42, 0.91); color: white; display: flex; flex-direction: column; align-items: center; justify-content: center;">
        <h1>💀 Game Over!</h1>
        <p>Your Final Score: <span id="final-score">0</span></p>
        <button onclick="restartGame()" class="btn btn-primary mt-3">Restart Game</button>
        <a href="../../views/game/home.php" class="btn btn-primary">Return Home</a>
    </div>

    <!--Background Video-->
    <video id="background-video" autoplay loop muted poster="">
        <source src="../../assets/images/bg.mp4" type="video/mp4">
    </video>

</body>
</html>