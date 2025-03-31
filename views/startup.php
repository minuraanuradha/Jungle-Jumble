<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="icon" type="image/png" href="../assets/images/favicon.png">

    <title>Initial Setup and Welcome</title>

</head>
<body class="bg-green display-center-center bg-1">

    <div class="container display-center-center">
        <img src="../assets/images/Logo.png" style="width: 300px;" class="floating-logo">
        <a href="../views/auth/login.php"  id="click-sound" class="btn btn-primary mt-2 btn-nav">LOG IN</a>
        <a href="../views/auth/signup.php" id="click-sound" class="btn btn-secondary mt-1 btn-nav">SIGN UP</a>
    </div>

    <script src="../assets/js/background-music.js"></script>
    <script src="../assets/js/sound.js"></script>

    <!--Background Video-->
    <video id="background-video" autoplay loop muted poster="">
        <source src="../assets/images/bg.mp4" type="video/mp4">
    </video>
    
</body>
</html>