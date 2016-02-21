<?php
session_start();


require 'PHPMailer/PHPMailerAutoload.php';

		$mail = new PHPMailer;



		$name = $_POST['name'];
		$email = $_POST['email'];

		$phone = $_POST['PHONE'];
		$DEP_LNG= $_POST['DEP_LNG'];
		$TYPE_TOPIC = $_POST['TYPE_TOPIC'];

		$detail = $_POST['DETAIL'];

		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'mrdark6996@gmail.com';                 // SMTP username
		$mail->Password = '14041982';                           // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    // TCP port to connect to

		$mail->From = $email;
		$mail->FromName = $name;
		//$mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
		$mail->addAddress('oh_darkman@hotmail.com');               // Name is optional
		//$mail->addReplyTo('info@example.com', 'Information');
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');

		//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = 'website Contact';
		$mail->Body    = $name ."<br/>" .$phone . "<br/>" .  $DEP_LNG ."<br/>".$TYPE_TOPIC ."<br/>".$detail;
		//$mail->AltBody = $detail;

		if(!$mail->send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
			echo 'Message has been sent';
		}

//if( isset($_POST['name']) && strtoupper($_POST['captcha']) == $_SESSION['captcha_id'] )
//{
//	$to = 'support@htmlstream.com'; // Replace with your email
//	$subject = 'Message from website'; // Replace with your $subject
//	$headers = 'From: ' . $_POST['email'] . "\r\n" . 'Reply-To: ' . $_POST['email'];
//
//	$message = 'Name: ' . $_POST['name'] . "\n" .
//	           'E-mail: ' . $_POST['email'] . "\n" .
//	           'Subject: ' . $_POST['subject'] . "\n" .
//	           'Message: ' . $_POST['message'];
//
//	mail($to, $subject, $message, $headers);
//
//	if( $_POST['copy'] == 'on' )
//	{
//		mail($_POST['email'], $subject, $message, $headers);
//	}
//}
?>