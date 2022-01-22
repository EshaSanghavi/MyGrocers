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

	$id = $uid.$pid;

	if($qty == 1)
	{
		$sql = "INSERT INTO wishlist VALUES('$id', '$pid', '$uid')";
		if ($conn->query($sql) === TRUE) 
		{
		  echo 'Product added to wishlist!';
		  header("Location: wishlist.php");
		} 
		else 
		{
		  echo "Error: $sql <br> $conn->error";
		}
	}
	else
	{
		$sql = "DELETE FROM wishlist WHERE srno='$id'";
		if ($conn->query($sql) === TRUE) 
		{
		  echo 'Product removed from wishlist!';
		  header("Location: wishlist.php");
		} 
		else 
		{
		  echo "Error: $sql <br> $conn->error";
		}
	}
?>