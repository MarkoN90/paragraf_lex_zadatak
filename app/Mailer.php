<?php
namespace App;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mailer
{

	public function send($to, $subject, $content, $attachment) {
 			$mail = new PHPMailer(true);
			$config = $GLOBALS['config']['email'];
	try {
 	   // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
	    $mail->isSMTP();
	    $mail->Host       = $config['host'];
	    $mail->SMTPAuth   = true;
	    $mail->Username   = $config['username'];
	    $mail->Password   = $config['password'];
	    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
	    $mail->Port       = $config['port'];

 	    $mail->setFrom($config['from']);
	    $mail->addAddress($to);

 	  $mail->addAttachment($attachment);

	    $mail->Subject = $subject;
	    $mail->Body    = $content;

	    $mail->send();
 	}

	catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
 }


}
}


?>
