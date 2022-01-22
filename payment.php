<?php
  
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
  
	require 'vendor/autoload.php';

	include('config.php');

	//get uid of user
	$uid = $_SESSION['user'];

	//get user
	$sql = "SELECT * FROM users WHERE username='$uid'";
	$result = $conn->query($sql);
	$user = $result->fetch_assoc();
	$uid = $user[userid];
	$uname = $user[username];
	$usermail = $user[email];


	//get bill of user
	$sql = "SELECT * FROM bill WHERE userid='$uid'";
	$result = $conn->query($sql);
	$bill = $result->fetch_assoc();
	$amount = $bill[amount];

	echo $amount;

	//add new record into payment table
	$sql = "INSERT INTO payment(uid, amount) VALUES ('$uid', '$amount')";
	$conn->query($sql);

	//deduct paid amount from user wallet-amount
	$newallet = $user[walletamt] - $amount;
	$sql = "UPDATE users SET walletamt='$newallet' WHERE userid='$uid'";
	$conn->query($sql);

	//send payment successfull mail
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
	    $mail->Subject = 'Payment Successfull';
	    $mail->Body    = 'Dear '.$uname.', <br>Payment of <b>₹'.$amount.'</b> received successfully by MyGrocers<br><br><br>__<br><b>MyGrocers</b><br>';
	    //$mail->AltBody = 'Body in plain text for non-HTML mail clients';
	    $mail->send();
	    
	    //delete bill
	    $sql = "DELETE FROM bill WHERE userid='$uid'";
	    $conn->query($sql);
	    //empty cart
	    $sql = "DELETE FROM cart WHERE uid='$uid'";
	    $conn->query($sql);

	    header("Location: paysuccess.php");
	    //echo "Mail has been sent successfully!";
	} catch (Exception $e) {
	    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}
	
	//header("Location: index.php");
?>