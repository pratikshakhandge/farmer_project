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

        <input type="text" name="crop" placeholder="Crop Name" required>

        <select name="category" required>
            <option value="">Select Category</option>
            <option>Fertilizer</option>
            <option>Labor</option>
            <option>Transport</option>
            <option>Seeds</option>
            <option>Other</option>
        </select>

        <input type="number" name="amount" placeholder_ctor="Amount" required>

        <input type="text" name="note" placeholder="Note">

        <button type="submit">Save Expense</button>
    </form>

    <br>
    <a href="dashboard.php">Back to Dashboard</a>

</div>

</body>
</html>