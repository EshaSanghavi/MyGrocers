<?php
session_start();
$servername = "localhost";
$username = "user name";
$password = "pass";
$dbname = "Groceries";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);

if(!empty($_SESSION['user']))
	$link = $_SESSION['user'];
else
	$link = 'Login';
}
?>
<html>
<head>
	<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,400;1,300&display=swap" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
</head>
<body>
<div class="topnav">
  	<a href="index.php" style="font-size: 23px; padding-top: 20px; padding-left:20px; font-weight: bold; color:#42dcff;">MyGrocers</a>
  	<!-- <a href="#">Link</a>
  	<a href="#">Link</a> -->
  	<div class="search"> 
  		<form action="list.php" method="GET">
		    <input type="text" placeholder="Search..." name="searchval"> 
    		<button><img src="icons/search.png" class="icons" id="search"></button> 
		</form>
	</div>
	<?php
	if(!empty($_SESSION['user']))
		$link = $_SESSION['user'];
	else
		$link = 'Login';
	if($_SESSION['user'] == "admin")
	{
		echo "<a href='login.php'><img src='icons/name.png' class='icons-small'>$link</a>"; 
		echo "<a href='addProduct.php'><img src='icons/plushover.png' class='icons-small'>Add</a>";
		echo "<a href='composeMail.php'><img src='icons/mail.png' class='icons-small'>Mail</a>";
	}
	else
	{
		echo "<a href='login.php'><img src='icons/name.png' class='icons-small'>$link</a>"; 
		echo "<a href='cart.php'><img src='icons/cart.png' class='icons-small'>Cart</a>";
		echo "<a href='wishlist.php'><img src='icons/heart.png' class='icons-small'>Wishlist</a>";
	}
	?>											 
</div>
</body>
</html>
