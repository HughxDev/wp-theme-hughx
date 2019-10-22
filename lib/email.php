<?php
function send_email($to, $from_name, $from_email, $subject, $message, &$attachment = NULL, $attachment_name = NULL) {

if(isset($attachment)) {
	if(!isset($attachment_name)) {
		$attachment_name = $attachment['name'];
	}
	
	$boundary_def = md5(time());
	$boundary = '--' . $boundary_def;
	
	$headers = 
		"MIME-Version: 1.0\n" . 
		"From: \"$from_name\" <$from_email>\n" . 
		"Content-Type: multipart/mixed; boundary=$boundary_def";
	
	$mime = 
		"This is a multi-part message in MIME format.\n\n" .
		"$boundary\n" . 
		"Content-Type: text/plain; charset=UTF-8\n" . 
		"Content-Transfer-Encoding: 8bit\n\n" . 
		stripslashes($message) . "\n\n";
	
	$file = fopen($attachment['tmp_name'], 'rb');
	$data = fread($file, filesize($attachment['tmp_name']));
	fclose($file);
	
	$data = chunk_split(base64_encode($data));
	
	$mime .= 
		"$boundary\n" .
		'Content-Type: ' . $attachment['type'] . '; name="' . $attachment_name . "\"\n" . 
		'Content-Disposition: attachment; filename="' . $attachment_name . "\"\n" . 
		"Content-Transfer-Encoding: base64\n\n" . 
		$data . "\n\n" . 
		"$boundary--\n";
		
	return mail($to, $subject, $mime, $headers);
} else {
	$message = stripslashes( $message );

	return mail($to, $subject, $message, "From: \"$from_name\" <$from_email>\n");
}

}
?>