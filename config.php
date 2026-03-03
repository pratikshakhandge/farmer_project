<?php
$conn = new mysqli("localhost", "root", "", "farmer_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>