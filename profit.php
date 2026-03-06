<?php
session_start();
include "config.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Profit Calculator</title>
<link rel="stylesheet" href="style.css">

<style>

.container{
width:500px;
margin:40px auto;
background:white;
padding:25px;
border-radius:8px;
box-shadow:0 0 10px rgba(0,0,0,0.1);
}

input, select{
width:100%;
padding:10px;
margin:10px 0;
}

button{
width:100%;
padding:10px;
background:green;
color:white;
border:none;
cursor:pointer;
}

.result{
margin-top:20px;
font-size:18px;
font-weight:bold;
text-align:center;
}

</style>
</head>

<body>

<div class="container">

<h2>Profit Calculator 💰</h2>

<label>Select Crop</label>
<select id="crop">
<option>Tomato</option>
<option>Potato</option>
<option>Onion</option>
<option>Wheat</option>
<option>Rice</option>
<option>Sugarcane</option>
</select>

<label>Total Expense (₹)</label>
<input type="number" id="expense">

<label>Total Production (kg)</label>
<input type="number" id="production">

<label>Selling Price per kg (₹)</label>
<input type="number" id="price">

<button onclick="calculateProfit()">Calculate Profit</button>

<div class="result" id="result"></div>

<br>
<a href="dashboard.php">⬅ Back to Dashboard</a>

</div>

<script>
function calculateProfit() {

let expense = parseFloat(document.getElementById("expense").value);
let production = parseFloat(document.getElementById("production").value);
let price = parseFloat(document.getElementById("price").value);

let revenue = production * price;
let profit = revenue - expense;

let result = document.getElementById("result");

if(profit > 0){
    result.innerHTML = "Profit: ₹" + profit;
    result.style.color = "green";
}
else if(profit < 0){
    result.innerHTML = "Loss: ₹" + Math.abs(profit);
    result.style.color = "red";
}
else{
    result.innerHTML = "No Profit No Loss";
    result.style.color = "orange";
}

}
</script>

</body>
</html>