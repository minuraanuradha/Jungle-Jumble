<?php
session_start();
require_once '../config/db.php';
require_once '../models/UserModel.php';

$database = new Database();
$db = $database->connect();
$userModel = new UserModel($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    // User Sign-Up Handling
    if ($action === 'signup') {
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
    
        // Password security validation
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/', $password)) {
            echo json_encode(["status" => "error", "message" => "Password must be at least 6 characters, include an uppercase, lowercase, number, and special character."]);
            exit;
        }
    
        // Check if username or email already exists
        if ($userModel->userExists($username, $email)) {
            echo json_encode(["status" => "error", "message" => "Username or Email already taken!"]);
            exit;
        }
    
        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    
        // Register new user
        if ($userModel->registerUser($username, $email, $hashedPassword)) {
            echo json_encode(["status" => "success", "message" => "Registration successful! You can now log in."]);
            exit;
        } else {
            echo json_encode(["status" => "error", "message" => "Error during registration. Please try again."]);
            exit;
        }
    }

    // User Login Handling
    if ($action === 'login') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Get user from DB
        $user = $userModel->getUser($username);

        if ($user && password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['username'] = $user['username'];
            $_SESSION['high_score'] = $user['high_score']; // Assuming you store high scores

            // Handle "Remember Me" functionality
            if (isset($_POST['remember']) && $_POST['remember'] === "on") {
                setcookie("username", $username, time() + (86400 * 30), "/"); // Set for 30 days
            } else {
                setcookie("username", "", time() - 3600, "/"); // Expire cookie if unchecked
            }

            // Return success response
            echo json_encode(["status" => "success"]);
            exit();
        } else {
            // Return error response
            echo json_encode(["status" => "error", "message" => "Invalid login credentials!"]);
            exit();
        }
    }
}
?>