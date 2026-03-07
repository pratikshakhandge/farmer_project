<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: index.html");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Profit Calculator</title>
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

<h1>Profit Calculator</h1>

<div class="form-card">
<form id="profitForm">
<label>Total Selling Price (₹)</label>
<input type="number" id="sellingPrice" min="0" step="0.01" required>

<label>Total Expense (₹)</label>
<input type="number" id="totalExpense" min="0" step="0.01" required>

<button type="submit" class="save-btn">Calculate</button>
</form>

<div id="profitResult" style="margin-top:15px; font-weight:bold;"></div>
</div>

</div>

<script>
document.getElementById("profitForm").addEventListener("submit", function(e){
    e.preventDefault();

    let sellingPrice = parseFloat(document.getElementById("sellingPrice").value) || 0;
    let totalExpense = parseFloat(document.getElementById("totalExpense").value) || 0;
    let finalAmount = sellingPrice - totalExpense;
    let resultBox = document.getElementById("profitResult");

    if(finalAmount > 0){
        resultBox.textContent = "Profit: ₹" + finalAmount.toFixed(2);
        resultBox.style.color = "green";
    }else if(finalAmount < 0){
        resultBox.textContent = "Loss: ₹" + Math.abs(finalAmount).toFixed(2);
        resultBox.style.color = "red";
    }else{
        resultBox.textContent = "No Profit, No Loss";
        resultBox.style.color = "#333";
    }
});
</script>

</body>
</html>
