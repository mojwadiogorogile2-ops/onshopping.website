<?php

$conn = new mysqli("localhost","root","","onshoppingbw");

if($conn->connect_error){
die("Connection failed");
}

$email= $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM sellers
WHERE email='$email' AND password='$password'";

$result = $conn->query($sql);

if($result->num_rows > 0){

$row = $result->fetch_assoc();

session_start();
$_SESSION['seller_id'] = $row['id'];
$_SESSION['seller_name'] = $row['name'];
$_SESSION['seller_whatsapp'] = $row['whatsapp'];

header("Location: seller_dashboard.php");

}else{

echo "Wrong email or password";

}

$conn->close();

?>