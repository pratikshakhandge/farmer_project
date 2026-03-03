<?php
include 'config.php';

if(isset($_POST['register'])){

    $username = $_POST['username'];
    $password = $_POST['password'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username, password)
            VALUES ('$username', '$password')";

    if($conn->query($sql) === TRUE){
        echo "Registration Successful!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>

<h2>Register</h2>

<form method="POST">
    <input type="text" name="username" placeholder="Username" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <button type="submit" name="register">Register</button>
</form>

</body>
</html>