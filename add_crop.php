<?php
session_start();
include "config.php";

if(!isset($_SESSION['user_id'])){
    header("Location: index.html");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Add Crop Expense</title>
<link rel="stylesheet" href="dashboard.css">

</head>

<body>

<div class="dashboard">

<!-- SIDEBAR -->

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


<!-- MAIN CONTENT -->

<div class="main">

<h1>Add Crop Expense</h1>

<div class="form-card">

<form id="expenseForm">

<label>Select Crop</label>

<select name="crop" required>
<option value="">-- Select Crop --</option>
<option>Onion</option>
<option>Tomato</option>
<option>Green Chili</option>
<option>Wheat</option>
<option>Rice</option>
<option>Sugarcane</option>
<option>Potato</option>
</select>


<label>Expense Category</label>

<select name="category" required>
<option value="">-- Select Category --</option>
<option>Fertilizer</option>
<option>Labor</option>
<option>Transport</option>
<option>Seeds</option>
<option>Other</option>
</select>


<label>Amount (₹)</label>
<input type="number" name="amount" placeholder="Enter Amount" required>


<label>Description</label>
<input type="text" name="note" placeholder="Expense Description">


<button type="submit" class="save-btn">Save Expense</button>

<a href="dashboard.php" class="back-btn">⬅ Back to Dashboard</a>

</form>

</div>

</div>

</div>


<script>

document.getElementById("expenseForm").addEventListener("submit", function(e){

e.preventDefault();

let formData = new FormData(this);

fetch("save_expense.php", {
method: "POST",
body: formData
})

.then(response => response.text())
.then(data => {

if(data.trim() == "success"){

alert("Expense Saved Successfully ✅");
document.getElementById("expenseForm").reset();

}else{

alert("Error Saving Expense ❌");

}

});

});

</script>

</body>
</html>
