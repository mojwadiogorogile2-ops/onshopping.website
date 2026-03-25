<?php

$conn = new mysqli("localhost","root","","onshoppingbw");

$id = $_POST['id'];
$product_name = $_POST['product_name'];
$price = $_POST['price'];
$location = $_POST['location'];
$description = $_POST['description'];

$sql = "UPDATE products 
SET product_name='$product_name',
price='$price',
location='$location'
WHERE id='$id'";

if($conn->query($sql)){
header("Location: seller_dashboard.php");
}else{
echo "Error updating product";
}

?>