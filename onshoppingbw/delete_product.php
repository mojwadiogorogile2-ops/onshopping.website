<?php
session_start();

$conn = new mysqli("localhost","root","","onshoppingbw");

if($conn->connect_error){
die("Connection failed");
}

if(isset($_GET['id'])){

$id = $_GET['id'];

$sql = "DELETE FROM products WHERE id='$id'";

if($conn->query($sql)){
header("Location: seller_dashboard.php");
}else{
echo "Error deleting product";
}

}

?>