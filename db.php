<?php
$conn = new mysqli("localhost","root","","finance_new");

if($conn->connect_error){
die("Connection failed");
}
?>