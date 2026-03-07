<?php
session_start();
include "config.php";

if(!isset($_SESSION['user_id'])){
header("Location: index.html");
exit();
}

$user_id = (int)$_SESSION['user_id'];
$farmer_name = "Farmer";

$user_sql = "SELECT name FROM users WHERE id=$user_id LIMIT 1";
$user_result = $conn->query($user_sql);
if($user_result && $user_result->num_rows > 0){
    $farmer = $user_result->fetch_assoc();
    $farmer_name = $farmer["name"];
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Farmer Dashboard</title>
<link rel="stylesheet" href="dashboard.css">
</head>

<body>

<div class="dashboard">
<aside class="sidebar">

<h2>Farmer Panel</h2>

<ul>
<li><a href="dashboard.php" class="active">Dashboard</a></li>
<li><a href="profile.php">My Profile</a></li>
<li><a href="add_crop.php">Add Expense</a></li>
<li><a href="view_crops.php">View Crops</a></li>
<li><a href="profit.php">Profit Calculator</a></li>
<li><a href="logout.php">Logout</a></li>
</ul>

</aside>

<main class="main">
<section class="hero">
<div>
<p class="hero-kicker">Dashboard</p>
<h1>Welcome, <?php echo htmlspecialchars($farmer_name); ?></h1>
</div>
</section>

<section class="welcome-panel">
<img src="image.png" alt="Farmer" class="farmer-image">
</section>

</main>
</div>

</body>
</html>
