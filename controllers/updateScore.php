<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['username'])) {
    die(json_encode(["status" => "error", "message" => "Unauthorized access"]));
}

$username = $_SESSION['username'];
$score = intval($_POST['score']);

$database = new Database();
$db = $database->connect();

// Update user's high score if the new score is higher
$query = "UPDATE users SET high_score = GREATEST(high_score, ?) WHERE username = ?";
$stmt = $db->prepare($query);
$stmt->execute([$score, $username]);

echo json_encode(["status" => "success", "message" => "High score updated!"]);
?>
