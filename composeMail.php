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
  <div class="row">
</div><br><br>
<div class="sub-title" style="font-size: 15px;"><p><a href="index.php">Home</a> <a style="color:#5c5c5c;"> > Mail</a></p>
<hr></div>

<?php  
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  
  require 'vendor/autoload.php';

  include('config.php');

  if(isset($_POST["mail"]))
  {
    $users = array();

    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $body = mysqli_real_escape_string($conn, $_POST['body']);
    //send marketing mail
    foreach ($_POST['usernames'] as $u) 
    {
      $users[] = $u;
      $mail = new PHPMailer(true);
      try 
      {
        $mail->SMTPDebug = 0;                                       
        $mail->isSMTP();                                            
        $mail->Host       = 'smtp.gmail.com;';                    
        $mail->SMTPAuth   = true;                             
        $mail->Username   = 'xvz@gmail.com';                 
        $mail->Password   = 'pass';                        
        $mail->SMTPSecure = 'tls';                              
        $mail->Port       = 587;  
      
        $mail->setFrom('xyz@gmail.com', 'MyGrocers');           
        $mail->addAddress($u);
        //$mail->addAddress('receiver2@gfg.com', 'Name');
           
        $mail->isHTML(true);                                  
        $mail->Subject = $subject;
        $mail->Body    = $body;
        //$mail->AltBody = 'Body in plain text for non-HTML mail clients';
        $mail->send();
      } 
      catch (Exception $e) 
      {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }
    }
    header("Location: mailSuccess.php");
    
  }
  else
  {
      $sql = "SELECT * FROM users";
      $res = $conn->query($sql);
      $users = array();
      // output data of each row into resultset
      while($row = $res->fetch_assoc()) 
      {
        $users[] = $row;
      }
      echo "<form class='center1' method='post' action='composeMail.php'>
          <h2>Mail</h2>
          <div class='input-group'>
            <label>Username</label>
            <select name='usernames[]' id='usernames' multiple='multiple' style='height: 100px;'>";
            foreach ($users as $u)
            {
              echo "<option value='$u[email]' style='padding:3px; border-bottom: 1px solid lightgrey;'>$u[username] - $u[email]</option>";
            }
      echo  "</select>
          </div>
          <div class='input-group'>
            <label>Mail Subject</label>
            <input type='text' name='subject'>
          </div>
          <div class='input-group'>
            <label>Mail Body</label>
            <textarea type='text' name='body'></textarea>
          </div>
          <div class='input-group'>
            <button type='submit' class='btn' name='mail'>Send Mail</button>
          </div>
        </form>";
  }
?>
<?php include('footer.php');?>
</body>
</html>
