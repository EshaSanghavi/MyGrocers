<?php
	include('config.php');

	$pid = $_GET['pid'];
	$qty = $_GET['qty'];
	//$qty = 1;
	$uid = $_SESSION['user'];

	$sql = "SELECT userid FROM users WHERE username='$uid'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$uid  = $row["userid"];

	$sql = "SELECT cost FROM products WHERE pid='$pid'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();

	$subcost  = $row["cost"] * $qty;
	//$subcost  = $row["cost"];

	$id = $uid.$pid;

	$sql = "INSERT INTO cart VALUES ('$id', '$pid', '$qty', '$subcost', '$uid') ON DUPLICATE KEY UPDATE cqty = '$qty', subcost = '$subcost'";
	if ($conn->query($sql) === TRUE) {
	  echo 'Product added to cart!';
	} else {
	  echo "Error: $sql <br> $conn->error";
	}

	$sql = "DELETE FROM cart WHERE cqty<=0";
	$conn->query($sql);

	$sql = "SELECT subcost FROM cart WHERE uid='$uid'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$sum = 0.0;
	foreach ($result as $r) {
		echo $r[subcost];
		$sum  += $r[subcost];
	}
	$sql = "INSERT INTO bill VALUES ('$uid', '$sum') ON DUPLICATE KEY UPDATE amount = '$sum'";
	$conn->query($sql);

	header("Location: cart.php");
?>