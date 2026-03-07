<?php
session_start();
include "config.php";

if(!isset($_SESSION['user_id'])){
    http_response_code(401);
    echo "unauthorized";
    exit();
}

$user_id = (int)$_SESSION['user_id'];

$crop = trim($_POST['crop'] ?? "");
$category = trim($_POST['category'] ?? "");
$amount = (float)($_POST['amount'] ?? 0);
$note = trim($_POST['note'] ?? "");
$date = date("Y-m-d");

if($crop === "" || $category === "" || $amount <= 0){
    echo "error";
    exit();
}

$stmt = $conn->prepare("INSERT INTO expenses (user_id, crop_name, category, amount, note, expense_date) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("issdss", $user_id, $crop, $category, $amount, $note, $date);

if($stmt->execute()){
    echo "success";
}else{
    echo "error";
}
?>
