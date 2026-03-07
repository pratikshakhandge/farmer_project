<?php
session_start();
include "config.php";

if(!isset($_SESSION['user_id'])){
    header("Location: index.html");
    exit();
}

$user_id = (int)$_SESSION['user_id'];

$sql = "SELECT crop_name, category, amount, note, expense_date
        FROM expenses
        WHERE user_id=$user_id
        ORDER BY crop_name ASC, expense_date DESC";

$result = $conn->query($sql);
$crops = [];

if($result){
    while($row = $result->fetch_assoc()){
        $crops[$row['crop_name']][] = $row;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>View Crops</title>
<link rel="stylesheet" href="dashboard.css">
<style>
.crop-box {
    background: #fff;
    border: 1px solid #dde7da;
    border-radius: 14px;
    padding: 16px;
    box-shadow: 0 8px 18px rgba(26, 47, 30, 0.06);
    margin-bottom: 16px;
}

.crop-box h3 {
    margin: 0 0 10px;
}

.table-wrap {
    overflow: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
}

table th,
table td {
    border: 1px solid #e4ece1;
    padding: 10px;
    text-align: left;
}

table th {
    background: #f3f8f2;
}

.total-row td {
    font-weight: 700;
    background: #f9fbf8;
}

.empty-state-box {
    background: #fff;
    border: 1px solid #dde7da;
    border-radius: 14px;
    padding: 20px;
    box-shadow: 0 8px 18px rgba(26, 47, 30, 0.06);
}
</style>
</head>

<body>

<div class="dashboard">
<div class="sidebar">
<h2>Farmer Panel</h2>
<ul>
<li><a href="dashboard.php">Dashboard</a></li>
<li><a href="profile.php">My Profile</a></li>
<li><a href="add_crop.php">Add Expense</a></li>
<li><a href="view_crops.php" class="active">View Crops</a></li>
<li><a href="profit.php">Profit Calculator</a></li>
<li><a href="logout.php">Logout</a></li>
</ul>
</div>

<div class="main">
<section class="hero">
<div>
<p class="hero-kicker">Crop Records</p>
<h1>My Crops</h1>
</div>
</section>

<?php if(count($crops) === 0){ ?>
<div class="empty-state-box">
<p class="empty-state">No crop records found. Add expense entries to view them here.</p>
</div>
<?php } ?>

<?php foreach($crops as $crop_name => $records){ ?>
<div class="crop-box">
<h3><?php echo htmlspecialchars($crop_name); ?></h3>
<div class="table-wrap">
<table>
<tr>
<th>Date</th>
<th>Category</th>
<th>Amount</th>
<th>Note</th>
</tr>

<?php
$total = 0;
foreach($records as $record){
    $total += (float)$record['amount'];
?>
<tr>
<td><?php echo htmlspecialchars($record['expense_date']); ?></td>
<td><?php echo htmlspecialchars($record['category']); ?></td>
<td>Rs <?php echo number_format((float)$record['amount'], 2); ?></td>
<td><?php echo htmlspecialchars($record['note']); ?></td>
</tr>
<?php } ?>

<tr class="total-row">
<td colspan="2">Total Expense</td>
<td colspan="2">Rs <?php echo number_format($total, 2); ?></td>
</tr>
</table>
</div>
</div>
<?php } ?>

</div>
</div>

</body>
</html>
