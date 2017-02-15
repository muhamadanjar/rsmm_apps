<?php namespace App\Lib;
class MailWebGIS {

    public $mail_local;
    public $username_mail;
    public $password_mail;
    public function __contruct(){
        $this->mail_local->host = "smtp.gmail.com";
        $this->username_mail = "arvanria02@gmail.com";
        $this->password_mail = "greatknight2";
    }

    public function sendmail($subject,$body,$tomail){
        $mail = new \PHPMailer();
		// Set up SMTP
		$mail->IsSMTP();                // Sets up a SMTP connection
		$mail->SMTPDebug  = 0;          // This will print debugging info
		$mail->SMTPAuth = true;         // Connection with the SMTP does require authorization
		$mail->SMTPSecure = "tls";      // Connect using a TLS connection
		$mail->Host = "smtp.gmail.com";
		$mail->Port = 587;
		$mail->Encoding = '7bit';       // SMS uses 7-bit encoding
		
		// Authentication
		$mail->Username   = $this->username_mail; // Login
		$mail->Password   = $this->password_mail; // Password
		
		// Compose
		$mail->Subject = $subject;     // Subject (which isn't required)
		$mail->Body = $body;        // Body of our message
		
		// Send To
		$mail->AddAddress( $tomail ); // Where to send it
		if(!$mail->Send()) {
			echo "Mailer Error: " . $mail->ErrorInfo;
		} else {
			echo "Message has been sent";
		}
		//var_dump( $mail->send() );      // Send!
    }

	function check_email_valid($email){
		$email = filter_var($email, FILTER_SANITIZE_EMAIL);

		if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
			return true;
		} else {
			return false
		}
	}
}