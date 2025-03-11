<?php
session_start(); // Start session globally
require_once 'config/db.php';
require_once 'models/UserModel.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="icon" type="image/png" href="./assets/images/favicon.png">

    <title>Loarding Page</title>

</head>
<body class="bg-green display-center-center bg-1" >

    <div class="container display-center-center " >
        <img src="./assets/images/Logo.png" style="width:350px;" class="logo floating-logo" >
        <a href="./views/startup.html" class="btn btn-primary mt-2">CLICK TO START</a>
    </div>

    <!--Background Video-->
    <video id="background-video" autoplay loop muted poster="">
        <source src="./assets/images/bg.mp4" type="video/mp4">
    </video>

    <!--https://www.freepik.com/free-video/tropical-leaf-border-pattern_3876901#fromView=search&page=1&position=45&uuid=d3406444-6b5d-4e05-adaf-89292f73d882-->
</body>
</html>