<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="icon" type="image/png" href="../../assets/images/favicon.png">

    <title>User Login Page</title>

</head>
<body class="bg-green display-center-center bg-1">

    <div class="small-container display-center-center">
        <form action="../../controllers/AuthController.php" method="POST" class="display-center-center" id="loginForm">
                            <?php if (isset($_GET['success'])): ?>
                                <p style="color: green;"><?php echo htmlspecialchars($_GET['success']); ?></p>
                             <?php endif; ?>
            <h1 class="mt-2">LOG IN</h1>
            <img src="../../assets/images/monkey-swinging.png" style="width: 150px;" class="mt-1">

            <input type="hidden" name="action" value="login" class="input"> <!-- Hidden field for authentication -->

            <input type="text" name="username" id="username" placeholder="USER NAME" class="mt-3 input" required>
            <input type="password" name="password" id="password" placeholder="PASSWORD" class="mt-1 input" required>

            <!-- Remember Me Checkbox -->
            <div class="checkbox mt-1">
                <input type="checkbox" name="remember" id="rememberMe" class="rememberMe mr-1"> 
                <label >Remember Me</label>
            </div>

            <button type="submit" class="btn btn-primary mt-3">LOG IN</button>
            <p class="mt-1 linkpara">Don't have an account? <a href="./signup.php">Sign Up</a></p>
        </form>

    </div>

    <script src="../../assets/js/background-music.js"></script>
    <script src="../../assets/js/sound.js"></script>
    
    <script>
        document.getElementById("loginForm").addEventListener("submit", function(event) {
        event.preventDefault();
        
        let username = document.getElementById("username").value;
        let password = document.getElementById("password").value;
        let remember = document.getElementById("rememberMe").checked ? "on" : "off";
        
        if (username.length < 3 || password.length < 6) {
            alert("Username must be at least 3 characters and password at least 6 characters.");
            return;
        }
        
        fetch("../../controllers/AuthController.php", {
            method: "POST",
            credentials: "include",
            body: new URLSearchParams({ action: "login", username, password, remember }),
            headers: { "Content-Type": "application/x-www-form-urlencoded" }
        })
        .then(response => response.text()) // Use .text() instead of .json() for debugging
        .then(data => {
            console.log(data); // Debugging: Log the response from the server
            if (data.includes("success")) { // Check if the response contains "success"
                window.location.href = "../game/home.php"; // Redirect to home page
            } else {
                alert("Invalid login credentials!");
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("An error occurred. Please try again.");
        });
        });

        // Auto-fill username if "Remember Me" was checked
        window.onload = function() {
            let savedUsername = getCookie("username");
            console.log("Retrieved username from cookie:", savedUsername); // Debugging
            if (savedUsername) {
                document.getElementById("username").value = savedUsername;
                document.getElementById("rememberMe").checked = true;
            }
        };

        function getCookie(name) {
            let cookies = document.cookie.split("; ");
            for (let i = 0; i < cookies.length; i++) {
                let cookiePair = cookies[i].split("=");
                if (cookiePair[0].trim() === name) {
                    return decodeURIComponent(cookiePair[1]);
                }
            }
            return null;
        }
    </script>
    <!--Background Video-->
    <video id="background-video" autoplay loop muted poster="">
        <source src="../../assets/images/bg.mp4" type="video/mp4">
    </video>
    
</body>
</html>