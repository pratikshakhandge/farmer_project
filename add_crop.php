<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Crop</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

<h2>Add Crop Expense</h2>

<form action="save_expense.php" method="POST">

<label>Select Crop</label>
<select name="crop" required>
<option value="">Select Crop</option>
<option>Onion</option>
<option>Tomato</option>
<option>Green Chili</option>
<option>Wheat</option>
<option>Rice</option>
<option>Sugarcane</option>
<option>Potato</option>
</select>

<label>Category</label>
<select name="category" required>
<option>Fertilizer</option>
<option>Labor</option>
<option>Transport</option>
<option>Seeds</option>
<option>Other</option>
</select>

<input type="number" name="amount" placeholder="Amount" required>

<input type="text" name="note" placeholder="Description">

<button type="submit">Save Expense</button>

</form>

</div>

</body>
</html>