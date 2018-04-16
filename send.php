<?php

// include phpmailer
include( "lib/phpmailer/class.phpmailer.php" );


// email validation function
function valid_email( $email ) {
	$email_valid=filter_var( $email, FILTER_VALIDATE_EMAIL);
	if ( $email_valid ) {
		return true;
	}
	return false;
}


if ( isset( $_POST["email"] ) ) {

	// check and die if either are invalid
	if ( !valid_email( $_POST["email"] ) ) die( "invalid email" );


	// message content
	$message_content = "<h2>Loan Inquiry</h2><hr />" .
		"<p><strong>Name:</strong><br />" . $_REQUEST["name"] . "</p>" .
		"<p><strong>Email:</strong><br />".$_REQUEST["email"] . "</p>" .
		"<p><strong>Phone:</strong><br />".$_REQUEST["phone"] . "</p>" .
		"<p><strong>Message:</strong><br />".$_REQUEST["message"] . "</p>" .
		"<hr />" . 
		"<p><small>This message was generated healthierbanking.com.</small></p>";


	// instantiate the mailer script
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->CharSet = 'UTF-8';

	$mail->Host       = "smtp.mailgun.org";        // SMTP server example
	$mail->SMTPDebug  = 0;                       // enables SMTP debug information (for testing)
	$mail->SMTPAuth   = true;                    // enable SMTP authentication
	$mail->SMTPSecure = "ssl";
	$mail->Port       = 465;                     // set the SMTP port for the GMAIL server
	$mail->Username   = "postmaster@mg.healthierbanking.com";   // SMTP account username example
	$mail->Password   = "42d5e413af186736250a05868881c7b9-80bfc9ce-406195a0";      // SMTP account password example

	$mail->From = 'noreply@healthierbanking.com';
	$mail->FromName = 'healthierbanking.com';
	//$mail->addAddress( 'info@alivecu.coop' );
	$mail->addAddress( 'kelley@giraphcu.com' );
	$mail->addCC( 'james@jpederson.com' );

	$mail->WordWrap = 50;                        // Set word wrap to 50 characters
	$mail->isHTML(true);                         // Set email format to HTML

	$mail->Subject = '[healthierbanking.com] Loan Inquiry';
	$mail->Body    = $message_content;
	$mail->AltBody = str_replace("<br />","
	", $message_content );


	if( !$mail->send() ) {
		die( $mail->ErrorInfo );
	} else {
		die( 'success' );
	}

}


?>