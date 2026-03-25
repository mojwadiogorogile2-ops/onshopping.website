<?php

$conn = new mysqli("localhost","root","","onshoppingbw");

$id = $_GET['id'];

$sql = "SELECT * FROM products WHERE id=$id";

$result = $conn->query($sql);

$row = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html>

<head>
 
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?php echo $row['product_name']; ?></title>

<style>

body{
font-family:Arial;
background:#f4f4f4;
padding:40px;
}

.product-container{
background:white;
max-width:900px;
margin:auto;
padding:30px;
border-radius:10px;
box-shadow:0 5px 20px rgba(0,0,0,0.1);
}

.product-container img{
width:100%;
max-height:400px;
object-fit:cover;
border-radius:10px;
}

.price{
color:#ff6600;
font-size:22px;
font-weight:bold;
}

.whatsapp-btn{
display:inline-block;
margin-top:20px;
padding:12px 20px;
background:#25D366;
color:white;
text-decoration:none;
border-radius:6px;
font-weight:bold;
}

</style>

</head>

<body>

<div class="product-container">

<img src="uploads/<?php echo $row['image']; ?>">

<h1><?php echo $row['product_name']; ?></h1>

<p><?php echo $row['location']; ?></p>

<p class="price">P <?php echo $row['price']; ?></p>

<p><?php echo $row['description']; ?></p>

<a href="https://wa.me/267<?php echo $row['whatsapp']; ?>" class="whatsapp-btn" target="_blank">
Chat Seller on WhatsApp
</a>

</div>

</body>

</html>