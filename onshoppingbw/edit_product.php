<?php
session_start();

$conn = new mysqli("localhost","root","","onshoppingbw");

$id = $_GET['id'];

$sql = "SELECT * FROM products WHERE id='$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>

<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Product</title>

<style>

body{
font-family:sans-serif;
background-image: url("images/background4.jpg");
background-size: cover;
background-position: center;
background-repeat: no-repeat;
min-height: 100vh;
}

form{
background:white;
padding:20px;
border-radius:10px;
max-width:400px;
margin:auto;
}

input{
width:100%;
padding:10px;
margin-bottom:15px;
}

button{
background:#0401a8;
color:white;
padding:10px;
border:none;
width:100%;
}

</style>

</head>

<body>

<form action="update_product.php" method="POST">

<input type="hidden" name="id" value="<?php echo $row['id']; ?>">

<input type="text" name="product_name" value="<?php echo $row['product_name']; ?>" required>

<input type="text" name="price" value="<?php echo $row['price']; ?>" required>

<input type="text" name="location" value="<?php echo $row['location']; ?>" required>

<button type="submit">Update Product</button>

</form>

</body>

</html>