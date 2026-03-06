
<?php
session_start();
include "config.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Crop Expense</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

<h2>Add Crop Expense</h2>

<form id="expenseForm">

<h3>Select Crop</h3>
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

<h3>Expense Category</h3>
<select name="category" required>
<option value="">-- Select Category --</option>
<option>Fertilizer</option>
<option>Labor</option>
<option>Transport</option>
<option>Seeds</option>
<option>Other</option>
</select>

<input type="number" name="amount" placeholder="Enter Amount" required>
<input type="text" name="note" placeholder="Description">

<button type="submit">Save Expense</button>

<a href="dashboard.php">⬅ Back</a>
</form>

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