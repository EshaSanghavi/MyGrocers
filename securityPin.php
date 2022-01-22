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
    header('location: cart.php'); 
  }
  if(isset($_POST["submit"]))
  {
    $otp = mysqli_real_escape_string($conn, $_POST['otp']);
    if(strcmp($otp, $OTP))
      header('location: payment.php'); 
    else
      echo "Wrong otp!";
  }
  else
  {
    $usern = $_SESSION['user'];
    $sql = "SELECT * FROM users WHERE username='$usern'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
    $usermail = $user[email];
    $mail = new PHPMailer(true);
    try {
      $mail->SMTPDebug = 0;                                       
      $mail->isSMTP();                                            
      $mail->Host       = 'smtp.gmail.com;';                    
      $mail->SMTPAuth   = true;                             
      $mail->Username   = 'xyz@gmail.com';                 
      $mail->Password   = 'pass';                        
      $mail->SMTPSecure = 'tls';                              
      $mail->Port       = 587;  
    
      $mail->setFrom('xyz@gmail.com', 'MyGrocers');           
      $mail->addAddress($usermail);
      //$mail->addAddress('receiver2@gfg.com', 'Name');
         
      $mail->isHTML(true);                                  
      $mail->Subject = 'OTP';
      $mail->Body    = 'Dear '.$usern.',<br><b>'.$OTP.'</b> is your one time password (OTP).<br>Please enter the OTP to proceed.<br><br><br>__<br><b>MyGrocers</b><br>';
      //$mail->AltBody = 'Body in plain text for non-HTML mail clients';
      $mail->send();
      //echo "Mail has been sent successfully!";
    } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }  

  echo"<div class='row'>
  </div><br><br>
  <div class='sub-title' style='font-size: 15px;'><p><a href='index.php'>Home</a> > <a href='cart.php'>Cart</a> > <a style='color:#5c5c5c;'>OTP</a></p>
  <hr></div>

    <form class='center1' method='POST' action='securityPin.php'>
        <h2>Enter OTP</h2>
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
      <div class='input-group' style='display: block; float: right; height:50px'>
        <button class='btn-orange' name='cancel' style='margin-right: 20px;'>Cancel</button>
        <button type='submit' class='btn' name='submit'>Submit</button>
      </div>
    </form>";
  }
?>

<?php include('footer.php');?>
</body>
</html>
