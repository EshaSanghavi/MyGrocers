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
// LOGIN USER

  $user = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  if (empty($user)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

    $password = md5($password);
  	$query = "SELECT * FROM users WHERE username='$user' AND password='$password'";
  	$results = mysqli_query($conn, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['user'] = $user;
  	  header('location: index.php');
  	}
    else {
  		array_push($errors, "Wrong username/password combination");
    }

?>
?>

<div class="row">
</div><br><br>
<div class="sub-title" style="font-size: 15px;"><p><a href="index.php">Home</a><a style="color:#5c5c5c;"> > Login</a></p>
<hr></div>

  <form class="center1" method="post" action="login.php">
  	<?php include('errors.php'); ?>
      <h2>Login</h2>
  	<div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="username" value="<?php echo $user; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="login">Login</button>
  	</div>
  	<p>
        Forgot password? <a href="resetPassOTP.php" class="links">Reset Password</a>
    </p>
    <p>
        Not yet a member? <a href="signup.php" class="links">Sign up</a>
    </p>
  </form>

<?php include('footer.php');?>
</body>
</html>