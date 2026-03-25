<?php

$conn = new mysqli("localhost","root","","onshoppingbw");

$id = $_GET['id'];

$sql = "SELECT status FROM products WHERE id='$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if($row['status'] == 'live'){
$new_status = 'offline';
}else{
$new_status = 'live';
}

$conn->query("UPDATE products SET status='$new_status' WHERE id='$id'");

header("Location: seller_dashboard.php");

?>