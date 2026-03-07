<?php
session_start();
include "config.php";

if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    header("Location: index.html");
    exit();
}

$username = trim($_POST['username'] ?? "");
$password = $_POST['password'] ?? "";

if($username === "" || $password === ""){
    echo "Username and password are required.";
    exit();
}

$stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ? LIMIT 1");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if($stmt->num_rows > 0){
    $stmt->bind_result($user_id, $hashed_password);
    $stmt->fetch();

    if(password_verify($password, $hashed_password)){
        $_SESSION['user_id'] = (int)$user_id;
        header("Location: dashboard.php");
        exit();
    }

    echo "Wrong Password";
    exit();
}

echo "User not found";
?>
