<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}

if (isset($_POST['save_crop'])) {

    $user_id = $_SESSION['user_id'];
    $crop_name = $_POST['crop_name'];
    $fertilizer = $_POST['fertilizer'];
    $labor = $_POST['labor'];
    $transport = $_POST['transport'];
    $seeds = $_POST['seeds'];
    $pesticide = $_POST['pesticide'];
    $others = $_POST['others'];
    $selling_price = $_POST['selling_price'];

    $total_cost = $fertilizer + $labor + $transport + $seeds + $pesticide + $others;
    $profit_loss = $selling_price - $total_cost;

    $sql = "INSERT INTO crops 
            (user_id, crop_name, fertilizer, labor, transport, seeds, pesticide, others, total_cost, selling_price, profit_loss)
            VALUES 
            ('$user_id', '$crop_name', '$fertilizer', '$labor', '$transport', '$seeds', '$pesticide', '$others', '$total_cost', '$selling_price', '$profit_loss')";

    if ($conn->query($sql)) {
        header("Location: view_crops.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Crop</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="home-container">
    <h2>Add Crop Details 🌾</h2>

    <form method="POST">
        <input type="text" name="crop_name" placeholder="Crop Name" required><br><br>

        <input type="number" name="fertilizer" placeholder="Fertilizer Cost" required><br><br>
        <input type="number" name="labor" placeholder="Labor Cost" required><br><br>
        <input type="number" name="transport" placeholder="Transport Cost" required><br><br>
        <input type="number" name="seeds" placeholder="Seeds Cost" required><br><br>
        <input type="number" name="pesticide" placeholder="Pesticide Cost" required><br><br>
        <input type="number" name="others" placeholder="Other Cost" required><br><br>

        <input type="number" name="selling_price" placeholder="Selling Price" required><br><br>

        <button type="submit" name="save_crop" class="btn">Save Crop</button>
    </form>

    <br>
    <a href="dashboard.php" class="btn">Back</a>
</div>

</body>
</html>