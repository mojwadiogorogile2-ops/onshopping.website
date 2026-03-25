<?php
session_start();

$conn = new mysqli("localhost","root","","onshoppingbw");

$seller_id = $_SESSION['seller_id'];
$seller_name = $_SESSION['seller_name'];
$whatsapp = $_SESSION['seller_whatsapp'];
$description = $_POST['description'];

if($conn->connect_error){
die("Connection failed");
}

if(isset($_POST['upload_product'])){
$seller_id = $_SESSION['seller_id'];
}
$product_name = $_POST['product_name'];
$price = $_POST['price'];
$location = $_POST['location'];

$image = $_FILES['image']['name'];
move_uploaded_file($_FILES['image']['tmp_name'], "uploads/".$image);

$sql = "INSERT INTO products (product_name,price,location,image,description,seller_id,whatsapp)
VALUES ('$product_name','$price','$location','$image','$description','$seller_id','$whatsapp')";

if($conn->query($sql) === TRUE){
header("Location: seller_dashboard.php");


    echo "Product uploaded successfully";

}

$conn->close();

?>