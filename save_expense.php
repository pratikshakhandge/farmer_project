<?php
session_start();
include "config.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(!isset($_SESSION['user_id'])){
        header("Location: login.php");
        exit();
    }

    $user_id = $_SESSION['user_id'];

    $crop = $_POST['crop'] ?? '';
    $category = $_POST['category'] ?? '';
    $amount = $_POST['amount'] ?? 0;
    $note = $_POST['note'] ?? '';

    $date = date("Y-m-d");

    $sql = "INSERT INTO expenses (user_id, crop_name, category, amount, note, expense_date)
            VALUES ('$user_id','$crop','$category','$amount','$note','$date')";

    if($conn->query($sql)){
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Database Error: " . $conn->error;
    }
}
?>