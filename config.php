<?php
$conn = new mysqli("localhost", "root", "", "farmer_db", 3307);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>