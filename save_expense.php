<?php
session_start();
include "config.php";

$user_id = $_SESSION['user_id'];

$crop = $_POST['crop'];
$category = $_POST['category'];
$amount = $_POST['amount'];
$note = $_POST['note'];
$date = date("Y-m-d");

$sql = "INSERT INTO expenses (user_id, crop_name, category, amount, note, expense_date)
VALUES ('$user_id','$crop','$category','$amount','$note','$date')";

if($conn->query($sql)){
    echo "success";
}else{
    echo "error";
}
?>