<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="home-container">
    <h2>Welcome Farmer 🌾</h2>

    <a href="add_crop.php" class="btn">Add New Crop</a>
    <a href="view_crops.php" class="btn">View My Crops</a>
    <a href="logout.php" class="btn">Logout</a>
</div>

</body>
</html>