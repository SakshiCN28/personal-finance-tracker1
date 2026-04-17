<?php
session_start();
include "db.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

// check login
if(!isset($_SESSION['user_id'])) {
    die("Error: User not logged in");
}

$user_id = $_SESSION['user_id'];

if(isset($_POST['submit'])) {

    $type = $_POST['type'];
    $amount = $_POST['amount'];
    $category = $_POST['category'];
    $date = $_POST['date'];

    // DEBUG (remove later)
    echo "User ID: " . $user_id;

    $sql = "INSERT INTO transactions (type, amount, category, date, user_id)
            VALUES ('$type', '$amount', '$category', '$date', '$user_id')";

    if(mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>