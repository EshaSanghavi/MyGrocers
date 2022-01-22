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
<?php 
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
   
  require 'vendor/autoload.php';

  include('config.php');

  if(isset($_POST["cancel"]))
  {
    header('location: login.php'); 
  }
  if(isset($_POST["submit"]))
  {
    $usern = mysqli_real_escape_string($conn, $_POST['username']);
    $_SESSION['user'] = $usern;
    header('location: resetPass.php');
  } 
  else
  {
    echo"<div class='row'>
    </div><br><br>
    <div class='sub-title' style='font-size: 15px;'><p><a href='index.php'>Home</a> > <a href='login.php'>Login</a> > <a style='color:var(--purple);'>Reset Password</a></p>
    <hr></div>

      <form class='center1' method='POST' action='resetPassOTP.php'>
          <h2>Reset Password</h2>
        <div class='input-group'>
          <label>Name:</label>
          <input type='text' name='username'>
        </div>
        <div class='input-group'>
          <label>Email:</label>
          <input type='email' name='email'>
        </div>
        <div class='input-group' style='display: block; float: right; height:60px'>
          <button class='btn-orange' name='cancel' style='margin-right: 20px;'>Cancel</button>
          <button type='submit' class='btn' name='submit'>Submit</button>
        </div>
      </form>";
  }
?>
<?php include('footer.php');?>
</body>
</html>