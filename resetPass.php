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

  $generator = "1357902468";
  $OTP = "";
  for ($i = 1; $i <= 6; $i++) {
    $OTP .= substr($generator, (rand()%(strlen($generator))), 1);
  }

  if(isset($_POST["cancel"]))
  {
    header('location: login.php'); 
  }
  if(isset($_POST["submit"]))
  {
    $otp = mysqli_real_escape_string($conn, $_POST['otp']);
    $uname = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);
    $pass =  md5($pass);
    if(strcmp($otp, $OTP))
    {
      $sql = "UPDATE users SET password = '$pass' WHERE username = '$uname'";
      if ($conn->query($sql) === TRUE)
      {
        $_SESSION['user'] = $uname;
        header('location: index.php');
      }
    }
    else
      echo "Wrong otp!";
  }
  else
  {
    $usern = $_SESSION['user'];
    $sql = "SELECT * FROM users WHERE username='$usern'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
    $usermail = $user['email'];
    $mail = new PHPMailer(true);
    try {
      $mail->SMTPDebug = 0;                                       
      $mail->isSMTP();                                            
      $mail->Host       = 'smtp.gmail.com;';                    
      $mail->SMTPAuth   = true;                             
      $mail->Username   = 'eshasanghavi1@gmail.com';                 
      $mail->Password   = 'esha1san1';                        
      $mail->SMTPSecure = 'tls';                              
      $mail->Port       = 587;  
    
      $mail->setFrom('eshasanghavi1@gmail.com', 'MyGrocers');           
      $mail->addAddress($usermail);
      //$mail->addAddress('receiver2@gfg.com', 'Name');
         
      $mail->isHTML(true);                                  
      $mail->Subject = 'Reset Password OTP';
      $mail->Body    = 'Dear '.$usern.',<br><b>'.$OTP.'</b> is your one time password (OTP).<br>Please enter the OTP to reset password.<br><br><br>__<br><b>MyGrocers</b><br>';
      //$mail->AltBody = 'Body in plain text for non-HTML mail clients';
      $mail->send();
      //echo "Mail has been sent successfully!";
      } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      } 

  echo"<div class='row'>
  </div><br><br>
  <div class='sub-title' style='font-size: 15px;'><p><a href='index.php'>Home</a> > <a href='resetPassOTP.php'>Send OTP</a> > <a style='color:var(--purple);'>Reset Password</a></p>
  <hr></div>

    <form class='center1' method='POST' action='resetPass.php'>
        <h2>Reset Password</h2>
      <div class='input-group'>
        <label>Name:</label>
        <input type='text' name='username' value='$user[username]' readonly>
      </div>
      <div class='input-group'>
        <label>Email:</label>
        <input type='email' name='email' value='$user[email]' readonly>
      </div>
      <div class='input-group'>
        <label>Enter OTP:</label>
        <input type='text' name='otp'>
      </div>
      <div class='input-group'>
        <label>Password</label>
        <input type='password' name='password'>
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