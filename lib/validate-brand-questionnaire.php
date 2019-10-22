<?
error_reporting(E_ALL);
require_once('email.php');

if ( !function_exists( 'in_arrayi' ) ) {
	// http://www.php.net/manual/en/function.in-array.php#88554
	function in_arrayi( $needle, $haystack ) { 
		$found = false; 
		foreach( $haystack as $value ) { 
			if( strtolower( $value ) == strtolower( $needle ) ) { 
				$found = true; 
			}
		}
		return $found; 
	}
} 

$ajaxMode = false;
$hiddenAttr = '';

// @todo: Doesn't work with existing JS which is built solely for requestForm
// if(isset($_REQUEST['ajax']) && $_REQUEST['ajax'] !== 'false')
// {
//     $ajaxMode = true;
//     $hiddenAttr = ' hidden="hidden"';
// }

$to = '"Hugh Guiney" <hugh@hughguiney.com>';
$subject = (isset($_REQUEST['client-name']) && !empty($_REQUEST['client-name'])) ? $_REQUEST['client-name'] . ' Branding Questionnaire' : 'Brand Questionnaire'; //'Request For Quote';

$name_label = 'Client Name:';
$name_label_class = '';
$name_input_attr = '';

$message_label = 'Message:'; //'Describe your project:';
$message_label_class = '';
$message_input_value = '';

$success_message = <<<EOT
<div id="contact-result"$hiddenAttr class="success msg">
<h3>Thank you!</h3>
<p>Your questionnaire has been submitted. I’ll assess it and get back to you.</p>
</div>
EOT;
	
if(!isset($_REQUEST['submit']))
{
	$form = true;
}
else
{
	//$message = http_build_query($_REQUEST, null, "\n\n"); //("\n\n", $_REQUEST);
	$message = json_encode($_REQUEST, JSON_PRETTY_PRINT);

	//var_dump($message); exit;

    # Validation
	$send = send_email($to, $_REQUEST['client-name'], '', $subject, $message);

	if($send)
	{
		# Show delivery successful message
		$form = false;
	} else
	{
		$form = false;
		header('HTTP/1.1 500 Internal Server Error');
	}

	if($ajaxMode)
	{
		ob_clean();
		// echo $error_messages;
		echo $success_message;
		exit;
	}
}
?>