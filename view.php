<?php
session_start();
include "db.php";

// check login
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM transactions WHERE user_id='$user_id'";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<h2>Welcome <?php echo $_SESSION['username']; ?></h2>

<a href="add.php">Add Transaction</a> |
<a href="logout.php">Logout</a>

<br><br>

<table border="1">
<tr>
    <th>Type</th>
    <th>Amount</th>
    <th>Category</th>
    <th>Date</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?php echo $row['type']; ?></td>
    <td><?php echo $row['amount']; ?></td>
    <td><?php echo $row['category']; ?></td>
    <td><?php echo $row['date']; ?></td>
</tr>
<?php } ?>

</table>

</body>
</html>