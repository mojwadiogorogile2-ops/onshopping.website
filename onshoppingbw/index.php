<?php
$conn = new mysqli("localhost","root","","onshoppingbw");

if($conn->connect_error){
die("Connection failed");
}

if(isset($_GET['search'])){
$search = $_GET['search'];
$sql = "SELECT * FROM products WHERE product_name LIKE '%$search%' OR location LIKE '%$search%' ORDER BY id DESC";
}else{
$sql = "SELECT * FROM products WHERE status='live' ORDER BY id DESC";
}
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>OnShopping BW</title>

<style>

body{
font-family:Arial;
margin:0;
background:#f4f4f4;
}

.container{
display:flex;
}

/* Sidebar */

.sidebar{
width:220px;
background:green;
height:100vh;
color:white;
padding-top:20px;
}

.sidebar a{
display:block;
color:white;
padding:15px;
text-decoration:none;
}

.sidebar a:hover{
background:#444;
}

/* Main */

.main {
    flex: 1;
    padding: 20px;
    background-color: #ffffff; /* plain white */
    min-height: 100vh;
}

/* Search */

.search-bar{
margin-bottom:20px;
}

.search-bar input{
width:100%;
padding:10px;
border-radius:5px;
border:1px solid #ccc;
}

/* Products */

.products{
display:grid;
grid-template-columns:repeat(auto-fill,minmax(200px,1fr));
gap:25px;
}

.product-card{
border-radius:10px;
padding:10px;
box-shadow:0 6px 15px rgba(0,0,0,0.15);

/* slightly stronger gradient */
background:linear-gradient(45deg,#f0f4ff,#ffeede,#e9fff1);

background-size:400% 400%;
animation: cardGradient 14s ease infinite;
transition:transform 0.3s;
}

.product-card:hover{
transform:translateY(-6px);
box-shadow:0 20px 45px rgba(0,0,0,0.35);
}

/* smooth color movement */
@keyframes cardGradient{

0%{
background-position:0% 50%;
}

50%{
background-position:100% 50%;
}

100%{
background-position:0% 50%;
}

}


.product-card img{
width:100%;
height:150px;
object-fit:cover;
border-radius:5px;
}

.location{
color:gray;
font-size:14px;
}

.price{
font-weight:bold;
color:#ff6600;
}

.details-btn{
display:inline-block;
margin-top:10px;
padding:10px 15px;
background:#050589;
color:orange;
text-decoration:none;
border-radius:6px;
font-weight:bold;
}

.details-btn:hover{
background:#0a05a5;
}

.product-link{
text-decoration:none;
color:black;
display:block;
}

.whatsapp-btn:hover{
background:#1ebe5d;
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

.mobile-logo{
margin-left:10px;
font-size:20px;
font-weight:bold;
color:white;
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
☰ <span class="mobile-logo">ONShoppingBW</span>
</div>

<div class="container">

<!-- SIDEBAR -->

<div class="sidebar">

<h2 style="text-align:center;">OnShopping BW</h2>

<a href="index.php">Home</a>
<a href="seller_account.html">Become Seller</a>
<a href="seller_dashboard.php">Seller Dashboard</a>
<a href="about_us.html">About Us</a>
<a href="contact_us.html">Contact Us/HELP</a>

</div>

<!-- MAIN -->

<div class="main">

<form method="GET" action="index.php" style="text-align:center;margin-bottom:30px;">

<input type="text" name="search" placeholder="Search products..."
style="padding:10px;width:260px;border-radius:6px;border:1px solid #ccc;">

<button type="submit"
style="padding:10px 16px;background:#0401a8;color:white;border:none;border-radius:6px;">
Search
</button>

</form>

<div class="products">

<?php

if($result->num_rows > 0){

while($row = $result->fetch_assoc()){

echo "

<div class='product-card'>

<img src='uploads/".$row['image']."'> 

<div class='product-name'>".$row['product_name']."</div>

<div class='price'>P ".$row['price']."</div>

<a href='product2.php?id=".$row['id']."' class='details-btn'>
View Details
</a>

</div>

";

}

}else{

echo "No products uploaded yet.";

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


<footer>

<a href="terms.html">Terms & Conditions</a> |
<a href="privacy.html">Privacy Policy</a> |
<a href="seller-policy.html">Seller Policy</a>

<p>© 2026 OnShopping BW</p>

</footer>
</body>
</html>

