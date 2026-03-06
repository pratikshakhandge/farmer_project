<?php
session_start();
include "config.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM expenses 
        WHERE user_id='$user_id' 
        ORDER BY crop_name ASC, expense_date ASC";

$result = $conn->query($sql);

$crops = [];

while($row = $result->fetch_assoc()){
    $crops[$row['crop_name']][] = $row;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>My Crops</title>
<link rel="stylesheet" href="style.css">

<style>

body{
font-family: Arial;
background:#f4f4f4;
}

.crop-box{
background:white;
padding:20px;
margin:20px;
border-radius:8px;
box-shadow:0 0 10px rgba(0,0,0,0.1);
}

table{
width:100%;
border-collapse:collapse;
margin-top:10px;
}

table th, table td{
border:1px solid #ddd;
padding:10px;
text-align:center;
}

table th{
background:green;
color:white;
}

.total-row{
background:#f2f2f2;
font-weight:bold;
}

</style>
</head>

<body>

<h2 style="text-align:center;">My Crop Records 🌾</h2>

<?php foreach($crops as $cropName => $records){ ?>

<div class="crop-box">

<h3><?php echo $cropName; ?></h3>

<table>

<tr>
<th>Date</th>
<th>Category</th>
<th>Amount</th>
<th>Note</th>
</tr>

<?php 
$total = 0;
foreach($records as $r){ 
$total += $r['amount'];
?>

<tr>
<td><?php echo $r['expense_date']; ?></td>
<td><?php echo $r['category']; ?></td>
<td>₹<?php echo $r['amount']; ?></td>
<td><?php echo $r['note']; ?></td>
</tr>

<?php } ?>

<tr class="total-row">
<td colspan="2">Total Expense</td>
<td colspan="2">₹<?php echo $total; ?></td>
</tr>

</table>

</div>

<?php } ?>

</body>
</html>