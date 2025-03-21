<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="icon" type="image/png" href="../../assets/images/favicon.png">

    <title>User Registration Page</title>

</head>
<body class="bg-green display-center-center bg-1">

    <div class="small-container display-center-center">
        <div class=" display-center-center">
            <form action="../../controllers/AuthController.php" method="POST" onsubmit="return validateSignup()" class="display-center-center">
                <h1 class="mt-1">SIGN UP</h1>
                <img src="../../assets/images/monkey-smiling.png" style="width: 150px;" class="s">
    
                <input type="hidden" name="action" value="signup" class="input"> <!-- Hidden field to specify signup action -->
    
                <input type="text" name="username" id="username" placeholder="USER NAME" class="mt-1 input" required>
                <input type="email" name="email" id="email" placeholder="EMAIL" class="mt-1 input" required>
                <input type="password" name="password" id="password" placeholder="PASSWORD" class="mt-1 input" required>
                <input type="password" name="confirm_password" id="confirm_password" placeholder="CONFIRM PASSWORD" class="mt-1 input" required>
    
                <button type="submit" class="btn btn-secondary mt-1">SIGN UP</button>
                <p class="mt-1 linkpara">Already have an account? <a href="./login.php">Log In</a></p>
            </form>
        </div>
    </div>

    <script>
        function validateSignup() {
            let password = document.getElementById("password").value;
            let confirmPassword = document.getElementById("confirm_password").value;
    
            // Password requirements
            let passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/;
    
            if (!passwordRegex.test(password)) {
                alert("Password must be at least 6 characters, include one uppercase, one lowercase, one number, and one special character.");
                return false;
            }
    
            if (password !== confirmPassword) {
                alert("Passwords do not match!");
                return false;
            }
            return true;
        }
    </script>
    
    <!--Background Video-->
    <video id="background-video" autoplay loop muted poster="">
        <source src="../../assets/images/bg.mp4" type="video/mp4">
    </video>
    
</body>
</html>