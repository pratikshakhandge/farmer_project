<?php
include "config.php";
session_start();

$error_message = "";
$success_message = "";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = trim($_POST['name'] ?? "");
    $username = trim($_POST['username'] ?? "");
    $password_raw = $_POST['password'] ?? "";
    $mobile = trim($_POST['mobile'] ?? "");
    $address = "";
    $village = trim($_POST['village'] ?? "");
    $district = trim($_POST['district'] ?? "");
    $state = trim($_POST['state'] ?? "");

    if($name === "" || $username === "" || $password_raw === ""){
        $error_message = "Name, username, and password are required.";
    }else{
        $check_stmt = $conn->prepare("SELECT id FROM users WHERE username = ? LIMIT 1");
        $check_stmt->bind_param("s", $username);
        $check_stmt->execute();
        $check_stmt->store_result();

        if($check_stmt->num_rows > 0){
            $error_message = "Username already exists. Please choose another one.";
        }else{
            $password = password_hash($password_raw, PASSWORD_DEFAULT);
            $insert_stmt = $conn->prepare("INSERT INTO users (name, username, password, mobile, address, village, district, state) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $insert_stmt->bind_param("ssssssss", $name, $username, $password, $mobile, $address, $village, $district, $state);

            if($insert_stmt->execute()){
                $_SESSION['user_id'] = (int)$conn->insert_id;
                header("Location: dashboard.php");
                exit();
            }else{
                $error_message = "Unable to create account: " . $conn->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Create Account</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<div class="register-container">

<div class="register-box">

<h2>Create Farmer Account</h2>

<?php if($error_message !== ""){ ?>
<p style="color:#b00020; font-weight:bold; margin-bottom:10px;"><?php echo htmlspecialchars($error_message); ?></p>
<?php } ?>

<?php if($success_message !== ""){ ?>
<p style="color:#1b5e20; font-weight:bold; margin-bottom:10px;"><?php echo htmlspecialchars($success_message); ?></p>
<?php } ?>

<form method="POST">

<input type="text" name="name" placeholder="Full Name" required>

<input type="text" name="username" placeholder="Username" required>

<input type="password" name="password" placeholder="Password" required>

<input type="text" name="mobile" placeholder="Mobile Number">

<input type="text" name="village" placeholder="Village">

<input type="text" name="district" placeholder="District">

<input type="text" name="state" placeholder="State">

<button type="submit" name="register">Create Account</button>

</form>

<p class="login-link">
Already have account? <a href="index.html">Login</a>
</p>

</div>

</div>

</body>
</html>
