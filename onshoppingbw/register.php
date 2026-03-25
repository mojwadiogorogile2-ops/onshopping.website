<?php
session_start();

$conn = new mysqli("localhost","root","","onshoppingbw");

$business = $_POST['business_name'];
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$whatsapp = $_POST['whatsapp'];

$pic = $_FILES['profile_pic']['name'];
$tmp = $_FILES['profile_pic']['tmp_name'];

move_uploaded_file($tmp, "seller_profiles/".$pic);

$sql = "INSERT INTO sellers (business_name,name,email,password,whatsapp,profile_pic)
VALUES ('$business','$name','$email','$password','$whatsapp','$pic')";

if($conn->query($sql)){

$seller_id = $conn->insert_id;

$_SESSION['seller_id'] = $seller_id;
$_SESSION['seller_name'] = $name;
$_SESSION['seller_whatsapp'] = $whatsapp;

header("Location: seller_dashboard.php");
exit();

}else{

echo "Error creating account";

}
?>