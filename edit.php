<?php
include "db.php";

$id = $_GET['id'];

$data = $conn->query("SELECT * FROM transactions WHERE id=$id")->fetch_assoc();

if(isset($_POST['update'])){
$type = $_POST['type'];
$amount = $_POST['amount'];
$category = $_POST['category'];
$date = $_POST['date'];

$conn->query("UPDATE transactions SET type='$type',amount='$amount',category='$category',date='$date' WHERE id=$id");

header("Location: index.php");
}
?>

<form method="POST">
<input type="text" name="type" value="<?php echo $data['type']; ?>">
<input type="number" name="amount" value="<?php echo $data['amount']; ?>">
<input type="text" name="category" value="<?php echo $data['category']; ?>">
<input type="date" name="date" value="<?php echo $data['date']; ?>">
<button name="update">Update</button>
</form>