<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,400;1,300&display=swap" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">
    <style type="text/css">
        .center1 {
            margin: auto;
            width: 40%;
            margin-top: 20px;
            margin-bottom: 40px;
            padding: 20px 40px;
            color: #5c5c5c; 
            border: 3px solid lightgrey;
            border-radius: 20px;
        }
    </style>
</head>
<body>
<?php include('config.php'); 

  if(isset($_POST["cancel"]))
  {
    header('location: cart.php'); 
  }
  if(isset($_POST["submit"]))
  {
    $uname = mysqli_real_escape_string($conn, $_POST['username']);
    $addr = mysqli_real_escape_string($conn, $_POST['addr']);
    $pin = mysqli_real_escape_string($conn, $_POST['pin']);
    $query = "UPDATE users SET address='$addr', pin='$pin' WHERE username='$uname'";
    mysqli_query($conn, $query);
    header('location: securityPin.php'); 
  }
  else{
  $amount = $_GET['amt'];
  $usern = $_SESSION['user'];
  $sql = "SELECT * FROM users WHERE username='$usern'";
  $result = mysqli_query($conn, $sql);
  $user = mysqli_fetch_assoc($result);

echo"<div class='row'>
</div><br><br>
<div class='sub-title' style='font-size: 15px;'><p><a href='index.php'>Home</a> > <a href='cart.php'>Cart</a> > <a style='color:#5c5c5c;'>Shipping Details</a></p>
<hr></div>

  <form class='center1' method='POST' action='shipDetails.php'>
  	<?php include('errors.php'); ?>
      <h2>Shipping Details</h2>
  	<div class='input-group'>
  	  <label>Name</label>
  	  <input type='text' name='username' value='$user[username]'>
  	</div>
  	<div class='input-group'>
  	  <label>Address</label>
  	  <textarea name='addr' value='$user[address]'>$user[address]</textarea>
  	</div>
    <div class='input-group'>
      <label>Pin Code:</label>
      <input type='text' name='pin' value='$user[pin]'>
    </div>
    <div class='input-group'>
  	  <label>Phone No.:</label>
  	  <input type='text' name='phone' value='$user[phone]'>
  	</div>
    <div class='input-group'>
      <label>Email:</label>
      <input type='email' name='email' value='$user[email]'>
    </div>
    <p style='font-size:x-large;'>
      Your total amount:  <a class='links' style='font-size:x-large; font-weight:bold;'>₹$amount</a>
    </p>
    <div class='input-group' style='display: block; float: right; height:50px'>
      <button class='btn-orange' name='cancel' style='margin-right: 20px;'>Cancel</button>
      <button type='submit' class='btn' name='submit'>Submit</button>
    </div>
  </form>";}
?>

<?php include('footer.php');?>
</body>
</html>