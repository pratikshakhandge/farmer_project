<?php
session_start();
include 'config.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Farmer Dashboard</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<div class="dashboard-container">

<h1>🌾 Farmer Digital Notebook</h1>
<h2>Welcome Farmer</h2>

<div class="card-container">

<div class="card">
<h3>Add Crop Entry</h3>
<p>Add crop expenses like fertilizer, labor, seeds etc.</p>
<a href="add_crop.php" class="btn">Add Crop</a>
</div>

<div class="card">
<h3>View Crop Records</h3>
<p>See all your crop expenses and cost breakdown.</p>
<a href="view_crops.php" class="btn">View Crops</a>
</div>

<div class="card">
<h3>Logout</h3>
<p>Securely logout from your account.</p>
<a href="logout.php" class="btn logout">Logout</a>
</div>

</div>

</div>

</body>
</html>