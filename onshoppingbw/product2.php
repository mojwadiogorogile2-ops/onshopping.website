<?php
session_start();

$conn = new mysqli("localhost","root","","onshoppingbw");

if(!isset($_GET['id'])){
    echo "Product not found";
    exit();
}

$id = $_GET['id'];

// get product seller
$seller_check = $conn->query("SELECT seller_id FROM products WHERE id='$id'");
$product = $seller_check->fetch_assoc();

$product_seller = $product['seller_id'];

// check if current user is the seller
if(!isset($_SESSION['seller_id']) || $_SESSION['seller_id'] != $product_seller){

    // increase views only if viewer is not the seller
    $conn->query("UPDATE products SET views = views + 1 WHERE id='$id'");

}

$id = $_GET['id'];

$sql = "SELECT products.*, 
        sellers.name AS seller_name,
        sellers.business_name AS shop_name,
        sellers.profile_pic AS seller_pic
        FROM products
        JOIN sellers ON products.seller_id = sellers.id
        WHERE products.id='$id'";

$result = $conn->query($sql);

if(!$result || $result->num_rows == 0){
    echo "Product not found";
    exit();
}

$row = $result->fetch_assoc();  
$seller_id = $row['seller_id'];

$seller_products = $conn->query("
    SELECT * FROM products 
    WHERE seller_id='$seller_id' 
    AND id!='$id'
");

?>

<!DOCTYPE html>
<html>

<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?php echo $row['product_name']; ?></title>

<style>

body{
font-family:sans-serif;
margin:0;
background-image: url("images/background4.jpg");
background-size: cover;
background-position: center;
background-repeat: no-repeat;
min-height: 100vh;
}

.container{
max-width:900px;
margin:auto;
padding:20px;
}

.product-box{
background:white;
padding:20px;
border-radius:10px;
box-shadow:0 4px 10px rgba(0,0,0,0.1);
}

.product-box img{
width:100%;
max-height:400px;
object-fit:cover;
border-radius:10px;
}

.product-name{
font-size:28px;
font-weight:bold;
margin-top:15px;
}

.price{
font-size:22px;
color:#ff6600;
font-weight:bold;
margin-top:10px;
}

.location{
margin-top:10px;
color:gray;
}

.description{
margin-top:20px;
line-height:1.6;
}

.whatsapp-btn{
display:inline-block;
margin-top:20px;
padding:12px 18px;
background:#25D366;
color:white;
text-decoration:none;
border-radius:6px;
font-weight:bold;
}

.seller-card{
margin-top:30px;
padding:15px;
background:#f5f5f5;
border-radius:8px;
display:flex;
align-items:center;
}

.seller-card {
    width: 250px;
    padding: 15px;
    border-radius: 12px;
    background: #f5f5f5;
    text-align: center;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.seller-pic {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 10px;
}

.seller-name{
font-weight:bold;
}

.products{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
gap:20px;
margin-top:20px;
}

.product-card{
background:white;
padding:10px;
border-radius:10px;
box-shadow:0 4px 10px rgba(0,0,0,0.1);
}

.product-card img{
width:100%;
height:180px;
object-fit:cover;
border-radius:8px;
}


</style>

</head>

<body>

<div class="container">

<div class="product-box">

<img src="uploads/<?php echo $row['image']; ?>">

<div class="product-name">
<?php echo $row['product_name']; ?>
</div>

<div class="price">
P <?php echo $row['price']; ?>
</div>

<div class="location">
Location: <?php echo $row['location']; ?>
</div>

<div class="description">
<?php echo $row['description']; ?>
</div>

<a href="https://wa.me/267<?php echo $row['whatsapp']; ?>?text=Hi%20I%20saw%20your%20product%20<?php echo $row['product_name']; ?>%20on%20OnShopping%20BW.%20Is%20it%20still%20available?" 
class="whatsapp-btn" target="_blank">
Chat Seller
</a>

<div class="seller-card">

<img src="seller_profiles/<?php echo $row['seller_pic'] ? $row['seller_pic'] : 'default.png'; ?>" class="seller-pic">

<div class="seller-name">
<?php echo $row['shop_name']; ?>
</div>

</div>


<h2>More from this seller</h2>

<div class="products">

<?php
while($p = $seller_products->fetch_assoc()){
?>

<div class="product-card" onclick="window.location='product2.php?id=<?php echo $p['id']; ?>'" style="cursor:pointer;">

<img src="uploads/<?php echo $p['image']; ?>">

<div class="product-name">
<?php echo $p['product_name']; ?>
</div>

<div class="price">
P <?php echo $p['price']; ?>
</div>

</div>

<?php } ?>

</div>

</div>

</div>

</body>
</html>