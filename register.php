<?php
session_start();
include "db.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

if(isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // check if user already exists
    $check = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $check);

    if(mysqli_num_rows($result) > 0) {
        $error = "Username already exists!";
    } else {
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

        if(mysqli_query($conn, $sql)) {
            $success = "Account created successfully!";
        } else {
            $error = "Error creating account";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Register</title>

<style>
body{
    font-family: 'Segoe UI';
    background: linear-gradient(to right, #4facfe, #00f2fe);
}

.container{
    width:350px;
    margin:auto;
    margin-top:100px;
    background:white;
    padding:25px;
    border-radius:12px;
    box-shadow:0 0 15px gray;
    text-align:center;
}

h1{
    margin-bottom:10px;
}

h2{
    margin-bottom:20px;
}

input{
    width:90%;
    padding:10px;
    margin:10px 0;
    border-radius:5px;
    border:1px solid #ccc;
}

button{
    width:95%;
    padding:10px;
    background:#28a745;
    color:white;
    border:none;
    border-radius:5px;
    font-size:16px;
}

a{
    text-decoration:none;
    color:#007bff;
}

.error{
    color:red;
}

.success{
    color:green;
}
</style>

</head>

<body>

<div class="container">

<!-- ✅ PROJECT NAME -->
<h1>💰 PERSONAL FINANCE TRACKER</h1>

<h2>📝 Register</h2>

<?php 
if(isset($error)) echo "<p class='error'>$error</p>";
if(isset($success)) echo "<p class='success'>$success</p>";
?>

<form method="POST">
<input type="text" name="username" placeholder="Username" required>
<input type="password" name="password" placeholder="Password" required>

<button type="submit" name="register">Create Account</button>
</form>

<br>
<a href="login.php">Back to Login</a>

</div>

</body>
</html>