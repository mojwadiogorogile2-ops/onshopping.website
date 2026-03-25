<?php
session_start();

if(!isset($_SESSION['seller_id'])){
echo "<h2 style='text-align:center;margin-top:100px;font-family:sans-serif;'>You don't have a seller account.</h2>";
exit();
}

$conn = new mysqli("localhost","root","","onshoppingbw");

$seller_id = $_SESSION['seller_id'];

// Total product views
$views_sql = "SELECT SUM(views) as total_views FROM products WHERE seller_id='$seller_id'";
$views_result = $conn->query($views_sql);
$total_views = $views_result->fetch_assoc()['total_views'];

// Seller insights
$total_products_sql = "SELECT COUNT(*) as total FROM products WHERE seller_id='$seller_id'";
$total_products_result = $conn->query($total_products_sql);
$total_products = $total_products_result->fetch_assoc()['total'];

$total_value_sql = "SELECT SUM(price) as total_value FROM products WHERE seller_id='$seller_id'";
$total_value_result = $conn->query($total_value_sql);
$total_value = $total_value_result->fetch_assoc()['total_value'];

$avg_price_sql = "SELECT AVG(price) as avg_price FROM products WHERE seller_id='$seller_id'";
$avg_price_result = $conn->query($avg_price_sql);
$avg_price = $avg_price_result->fetch_assoc()['avg_price'];


$sql = "SELECT * FROM products WHERE seller_id='$seller_id' ORDER BY id DESC";

$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html>

<head>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<meta name="viewport" content="width=device-width, initial-scale=1.0"> 

<title>Seller Dashboard</title>

<style>

body {
    font-family: 'Poppins', sans-serif;
}

.container{
display:flex;
}

.sidebar{
width:230px;
background:#0401a8;
height:100vh;
color:white;
padding:25px;
animation: headerColor 8s infinite;
}

.sidebar h2{
margin-bottom:40px;
}

.sidebar a{
display:block;
color:white;
text-decoration:none;
margin-bottom:20px;
font-size:16px;
}

.sidebar a:hover{
opacity:0.7;
}

.main{
    flex: 1;
    padding: 20px;
    background-color: #ffffff; /* plain white */
    min-height: 100vh;
}

.welcome-card {
    background: linear-gradient(135deg, #1a1aff, #4da6ff);
    color: white;
    padding: 25px;
    margin: 20px;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
}

.welcome-card h1 {
    font-size: 26px;
    margin: 0;
    font-weight: 600;
}

.welcome-card p {
    margin-top: 5px;
    font-size: 14px;
    opacity: 0.9;
}

.products{
display:grid;
grid-template-columns:repeat(auto-fill,minmax(200px,1fr));
gap:20px;
padding:10px;
}

.product-card{
background:white;
padding:15px;
border-radius:12px;
box-shadow:0 10px 25px rgba(0,0,0,0.2);
transition:0.3s;
}

.product-card:hover{
transform:translateY(-6px);
box-shadow:0 20px 45px rgba(0,0,0,0.35);
}

.product-card img{
width:100%;
height:170px;
object-fit:cover;
border-radius:8px;
}

.product-name{
font-size:18px;
font-weight:bold;
margin-top:10px;
}

.price{
color:#ff6600;
font-weight:bold;
margin-top:5px;
}

.logout{
color:#ff4d4d;
font-weight:bold;
}

.edit-btn{
display:inline-block;
margin-top:10px;
padding:6px 10px;
background:#0401a8;
color:white;
text-decoration:none;
border-radius:5px;
font-size:14px;
margin-right:5px;
}

.edit-btn:hover{
background:#02006b;
}

.delete-btn{
display:inline-block;
margin-top:10px;
padding:6px 10px;
background:red;
color:white;
text-decoration:none;
border-radius:5px;
font-size:14px;
}

.delete-btn:hover{
background:#cc0000;
}

@media (max-width:600px){

.products{
grid-template-columns:repeat(2,1fr);
gap:15px;
}

.product-card img{
height:130px;
}

}

.mobile-menu-btn{
display:none;
font-size:28px;
padding:15px;
cursor:pointer;
background:#0401a8;
color:white;
animation: headerColor 8s infinite;
}

@media (max-width:768px){

.sidebar{
position:fixed;
left:-250px;
top:0;
width:230px;
height:100%;
transition:0.3s;
z-index:1000;
}

.sidebar.active{
left:0;
}

.mobile-menu-btn{
display:block;
}

.whatsapp-btn{
background:#25D366;
padding:10px;
border-radius:6px;
color:white;
text-align:center;
display:block;
margin-top:15px;
}

.whatsapp-btn:hover{
background:#1ebe5d;
}

.insights{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(180px,1fr));
gap:20px;
margin-bottom:40px;
}

.insight-box{
background:white;
padding:20px;
border-radius:10px;
box-shadow:0 10px 25px rgba(0,0,0,0.2);
text-align:center;

}

.insight-box h3{
margin:0;
font-size:26px;
color:#0401a8;
}

.insight-box p{
margin-top:5px;
font-size:14px;
color:#555;
}

@keyframes headerColor{

0%{
background:#0401a8;
}

33%{
background:#ff8800;
}

66%{
background:#00a651;
}

100%{
background:#0401a8;
}

}

@keyframes headerColor{

0%{
background:#0401a8;
}

33%{
background:#ff8800;
}

66%{
background:#00a651;
}

100%{
background:#0401a8;
}

}
}

</style>

</head>

<body>

<div class="mobile-menu-btn" onclick="toggleMenu()">
☰
</div>

<div class="container">

<div class="sidebar">

<h2>Seller Panel</h2>

<a href="seller_dashboard.php">Dashboard</a>

<a href="upload_product.html">Upload Product</a>

<a href="index.php">View Website</a>

<a href="https://chat.whatsapp.com/https://chat.whatsapp.com/JFFMRF3MYUS4p7KhgzbZqp
" target="_blank">
Join Sellers WhatsApp
</a>







<a href="logout.php" class="logout">Logout</a>

</div>

<div class="main">

<div class="welcome-card">
    <h1>Welcome, <?php echo $_SESSION['seller_name']; ?> 👋</h1>
    <p>Here’s your store performance overview</p>
</div>

<div class="insights">

<div class="insight-box">
<h3><?php echo $total_products; ?></h3>
<p>Total Products</p>
</div>

<div class="insight-box">
<h3>P <?php echo number_format((float)$total_value); ?></h3>
<p>Total Product Value</p>
</div>

<div class="insight-box">
<h3>P <?php echo number_format((float)$avg_price,2); ?></h3>
<p>Average Price</p>
</div>

<div class="insight-box">
<h3><?php echo $total_views ? $total_views : 0; ?></h3>
<p>Total Product Views</p>
</div>

</div>

<div class="products">

<?php

if($result->num_rows > 0){

while($row = $result->fetch_assoc()){

echo "

<div class='product-card' style='position:relative;'>

<a href='toggle_status.php?id=".$row['id']."'
style='
position:absolute;
top:10px;
right:10px;
width:15px;
height:15px;
border-radius:50%;
display:block;
background:".($row['status']=='live' ? 'green' : 'red').";
'>
</a>

<img src='uploads/".$row['image']."'> 

<div class='product-name'>".$row['product_name']."</div>

<div class='price'>P ".$row['price']."</div>

<a href='edit_product.php?id=".$row['id']."' class='edit-btn'>Edit</a>

<a href='delete_product.php?id=".$row['id']."' 
class='delete-btn'
onclick=\"return confirm('Are you sure you want to delete this product?')\">
Delete
</a>

</div>

";

}

}else{

echo "No products uploaded yet";

}

?>

</div>

</div>

</div>

<script>

function toggleMenu(){
document.querySelector(".sidebar").classList.toggle("active");
}

</script>

</body>
</html>