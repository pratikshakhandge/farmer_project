<?php
session_start();
include "config.php";

if(!isset($_SESSION['user_id'])){
    header("Location: index.html");
    exit();
}

$user_id = $_SESSION['user_id'];
$user = null;

$sql = "SELECT name, username, mobile, address, village, district, state FROM users WHERE id='$user_id' LIMIT 1";
$result = $conn->query($sql);
if($result && $result->num_rows > 0){
    $user = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>My Profile</title>
<link rel="stylesheet" href="dashboard.css">
</head>

<body>

<div class="sidebar">
<h2>🌾 Farmer Panel</h2>

<ul>
<li><a href="dashboard.php">Dashboard</a></li>
<li><a href="profile.php">My Profile</a></li>
<li><a href="add_crop.php">Add Expense</a></li>
<li><a href="view_crops.php">View Crops</a></li>
<li><a href="profit.php">Profit Calculator</a></li>
<li><a href="logout.php">Logout</a></li>
</ul>
</div>

<div class="main">
<h1>My Profile</h1>

<div class="card" style="max-width:700px; text-align:left;">
<?php if($user){ ?>
<p><strong>Name:</strong> <?php echo htmlspecialchars($user['name']); ?></p>
<p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
<p><strong>Mobile:</strong> <?php echo htmlspecialchars($user['mobile']); ?></p>
<p><strong>Address:</strong> <?php echo htmlspecialchars($user['address']); ?></p>
<p><strong>Village:</strong> <?php echo htmlspecialchars($user['village']); ?></p>
<p><strong>District:</strong> <?php echo htmlspecialchars($user['district']); ?></p>
<p><strong>State:</strong> <?php echo htmlspecialchars($user['state']); ?></p>
<?php }else{ ?>
<p>Profile details not found.</p>
<?php } ?>
</div>

</div>

</body>
</html>
