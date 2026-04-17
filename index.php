<?php
session_start();
include "db.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

// ✅ correct session check
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Finance Tracker</title>

<style>
body{
    font-family: 'Segoe UI';
    background: linear-gradient(to right, #4facfe, #00f2fe);
}

.container{
    width:70%;
    margin:auto;
    margin-top:30px;
    background:white;
    padding:20px;
    border-radius:10px;
    box-shadow:0 0 10px gray;
}

h2{text-align:center;}

form{text-align:center;}

input, select{
    padding:10px;
    margin:5px;
}

button{
    padding:10px 15px;
    background:#007bff;
    color:white;
    border:none;
}

table{
    width:100%;
    margin-top:20px;
    border-collapse:collapse;
}

th{
    background:#007bff;
    color:white;
}

td, th{
    padding:10px;
    text-align:center;
}

tr:nth-child(even){
    background:#f2f2f2;
}

a{
    text-decoration:none;
    padding:5px 10px;
    color:white;
}

.edit{background:green;}
.delete{background:red;}

.top{
    text-align:right;
    margin-bottom:10px;
}

.card{
    display:flex;
    justify-content:space-around;
    margin-top:15px;
}

.box{
    padding:10px;
    background:#eee;
    border-radius:10px;
    width:30%;
    text-align:center;
}
</style>
</head>

<body>

<div class="container">

<div class="top">
<a href="logout.php" class="delete">Logout</a>
</div>

<h2>💰 Personal Finance Tracker</h2>

<!-- ✅ FORM FIXED -->
<form action="add.php" method="POST">
<select name="type">
<option value="Income">Income</option>
<option value="Expense">Expense</option>
</select>

<input type="number" name="amount" placeholder="Amount" required>
<input type="text" name="category" placeholder="Category" required>
<input type="date" name="date" required>

<button type="submit" name="submit">Add</button>
</form>

<?php
// ✅ FILTER BY USER
$income = $conn->query("SELECT SUM(amount) as total FROM transactions WHERE type='Income' AND user_id='$user_id'")->fetch_assoc()['total'] ?? 0;

$expense = $conn->query("SELECT SUM(amount) as total FROM transactions WHERE type='Expense' AND user_id='$user_id'")->fetch_assoc()['total'] ?? 0;

$savings = $income - $expense;
?>

<div class="card">
<div class="box">Income: ₹<?php echo $income; ?></div>
<div class="box">Expense: ₹<?php echo $expense; ?></div>
<div class="box">Savings: ₹<?php echo $savings; ?></div>
</div>

<table>
<tr>
<th>ID</th>
<th>Type</th>
<th>Amount</th>
<th>Category</th>
<th>Date</th>
<th>Action</th>
</tr>

<?php
// ✅ SHOW ONLY LOGGED USER DATA
$result = $conn->query("SELECT * FROM transactions WHERE user_id='$user_id'");

while($row = $result->fetch_assoc()){
echo "<tr>
<td>".$row['id']."</td>
<td>".$row['type']."</td>
<td>".$row['amount']."</td>
<td>".$row['category']."</td>
<td>".$row['date']."</td>
<td>
<a class='edit' href='edit.php?id=".$row['id']."'>Edit</a>
<a class='delete' href='delete.php?id=".$row['id']."'>Delete</a>
</td>
</tr>";
}
?>

</table>

<!-- ✅ GRAPH -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<canvas id="myChart"></canvas>

<script>
var ctx = document.getElementById('myChart');

new Chart(ctx, {
type: 'pie',
data: {
labels: ['Income', 'Expense'],
datasets: [{
data: [<?php echo $income; ?>, <?php echo $expense; ?>]
}]
}
});
</script>

</div>

</body>
</html>