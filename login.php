<?php
session_start();
include "db.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];

        header("Location: index.php");
        exit();
    } else {
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>

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
    background:#007bff;
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
</style>

</head>

<body>

<div class="container">

<!-- ✅ YOUR PROJECT NAME ADDED -->
<h1>💰 PERSONAL FINANCE TRACKER</h1>

<h2>🔐 Login</h2>

<?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>

<form method="POST">
<input type="text" name="username" placeholder="Username" required>
<input type="password" name="password" placeholder="Password" required>

<button type="submit" name="login">Login</button>
</form>

<br>
<a href="register.php">Create Account</a>

</div>

</body>
</html>