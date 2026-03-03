<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}

$user_id = $_SESSION['user_id'];

$result = $conn->query("SELECT * FROM crops WHERE user_id='$user_id' ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Crops</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="home-container">
    <h2>My Crop Records 🌾</h2>

    <?php while($row = $result->fetch_assoc()) { ?>
        <div style="background:white;color:black;padding:15px;margin:10px;border-radius:8px;">
            <h3><?php echo $row['crop_name']; ?></h3>
            <p>Total Cost: ₹<?php echo $row['total_cost']; ?></p>
            <p>Selling Price: ₹<?php echo $row['selling_price']; ?></p>

            <?php if($row['profit_loss'] >= 0) { ?>
                <p style="color:green;">Profit: ₹<?php echo $row['profit_loss']; ?></p>
            <?php } else { ?>
                <p style="color:red;">Loss: ₹<?php echo abs($row['profit_loss']); ?></p>
            <?php } ?>
        </div>
    <?php } ?>

    <a href="dashboard.php" class="btn">Back</a>
</div>

</body>
</html>