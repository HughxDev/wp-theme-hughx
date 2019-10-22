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

if(isset($_REQUEST['ajax']) && $_REQUEST['ajax'] !== 'false')
{
    $ajaxMode = true;
    $hiddenAttr = ' hidden="hidden"';
}

$to = '"Hugh Guiney" <hello@hughguiney.com>';
$subject = (isset($_REQUEST['inquirySubject']) && !empty($_REQUEST['inquirySubject'])) ? $_REQUEST['inquirySubject'] : 'Hugh Guiney Contact Form'; //'Request For Quote';

$name_label = 'Name:';
$name_label_class = '';
$name_input_attr = '';

$email_label = 'E-mail Address:';
$email_label_class = '';
$email_input_attr = '';

/*$budget_label = 'Budget:';
$budget_label_class = '';
$budget_input_attr = '';*/

$message_label = 'Message:'; //'Describe your project:';
$message_label_class = '';
$message_input_value = '';

//$project_planner_label = 'Attach Project Planner:';

//$challenge_label = 'Prove you’re not a spambot:';
$challenge_label_class = '';
$challenge_input_attr = '';
$challenge = array(
	  array('q' => 'Prove you’re not a spambot: what does UX stand for?', 'a' => 'user experience')
	, array('q' => 'Please leave the following field blank.', 'a' => '')
	, array('q' => 'What is 2 + 2?', 'a' => '4')
	, array('q' => 'What is the opposite of down?', 'a' => 'up')
	, array('q' => 'What is the opposite of up?', 'a' => 'down')
	, array('q' => 'What sound does a cow make?', 'a' => 'moo')
	, array('q' => 'What color is the sky?', 'a' => array('blue', 'gray'))
	, array('q' => 'Who invented Facebook?', 'a' => 'Mark Zuckerberg')
	, array('q' => 'What is my first name?', 'a' => 'Hugh')
	, array('q' => 'What is my last name?', 'a' => 'Guiney')
	, array('q' => 'How does one spell out the number 5?', 'a' => 'five')
	, array('q' => 'The Beatles once said, “All you need is… ”?', 'a' => 'Love')
	, array('q' => 'What’s a popular nickname for “Timothy”?', 'a' => array('Tim', 'Timmy'))
	, array('q' => 'If it’s half past four, what time is it?', 'a' => array('4:30', '16:30', 'four thirty', 'four-thirty'))
	, array('q' => 'Which comes second in the sequence “HTML, CSS, JavaScript”?', 'a' => 'CSS')
	//, array('q' => 'How much wood could a woodchuck chuck if a woodchuck could chuck wood?', 'a' => 'idk')
);
$challenge_max_id = count($challenge) - 1;
$challenge_id = rand(0, $challenge_max_id);
$challenge_question = $challenge[$challenge_id]['q'];

#$brand_name_input_attr = '';
#$brand_name_label_class = '';

#$phone_label_class = '';
#$phone_input_attr = '';

#$existing_site_input_attr = '';

$my_email_addresses = array('hello@hughguiney.com', 'hugh@hughguiney.com', 'hugh.guiney@gmail.com', 'hugh.guiney@nospoon.tv');

if( isset($_REQUEST['inquirySubject']) && $_REQUEST['inquirySubject'] !== 'Form Test')
{
	$success_message = <<<EOT
<h3 class="h">Thank you!</h3>
<p>Your request has been submitted. Your project will be assessed and a quote e-mailed to you as soon as possible.</p>
EOT;
}
else
{
	$success_message = <<<EOT
<h3 class="h">Thank you!</h3>
<p>Your request has been fake submitted. If this weren’t a test, your project would have been assessed and a quote e-mailed to you as soon as possible.</p>
EOT;
}
	
if(!isset($_REQUEST['submit']))
{
	$form = true;
}
else
{
	$attention = ' class="attention"';
	$errors = array();
	
    # Validation
	
	// Name
	if(empty($_REQUEST['inquirerName'])) {
		$errors['inquirer-name'] = ' provide a name.';
		$name_label_class =& $attention;
	}
	
	// E-mail Address
  if(empty($_REQUEST['inquirerEmail']))
  {
		$errors['inquirer-email'] = ' provide an e-mail address.';
		$email_label_class =& $attention;
	}
  elseif(isset($_REQUEST['inquirerEmail']) && (in_array(strtolower($_REQUEST['inquirerEmail']), $my_email_addresses)))
  {
		$errors['inquirer-email'] = ' stop trying to steal my identity!';
		//var_dump($_REQUEST);
	}
  elseif(!filter_var($_REQUEST['inquirerEmail'], FILTER_VALIDATE_EMAIL))
  {
		$errors['inquirer-email'] = ' provide a valid e-mail address.';
		$email_label_class =& $attention;
	}
	
	// Message Body
  if(empty($_REQUEST['inquiry'])) {
	  $errors['inquiry'] = ' enter your message.';
	  $message_label_class =& $attention;
  }
	
	// Human Verification
	$user_challenge_answer = strtolower($_REQUEST['challenge']['answer']);
	$challenge_answer = $challenge[$_REQUEST['challenge']['id']]['a'];
	
	if(!is_array($challenge_answer))
	{
		$challenge_answer = strtolower($challenge_answer);
		$challenge_multiple_answers = false;
	}
	else
	{
		$challenge_multiple_answers = true;
	}

	if(
		(
			($challenge_multiple_answers == false)
			&& ($user_challenge_answer !== $challenge_answer)
		)
		|| (
			($challenge_multiple_answers == true)
			&& !in_arrayi($user_challenge_answer, $challenge_answer)
		)
	) {
		$errors['challenge-answer'] = ' answer the human verification challenge correctly.';
		$challenge_label_class =& $attention;
	}
	
	// Project Planner
    if(!empty($_FILES['project-planner']['name']))
    {
		if(
			(
			($_FILES['project-planner']['type'] == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') 
			|| ($_FILES['project-planner']['type'] == 'application/msword') 
			//|| ($_FILES['project-planner']['type'] == 'application/pdf') 
			|| ($_FILES['project-planner']['type'] == 'application/vnd.oasis.opendocument.text') 
			|| ($_FILES['project-planner']['type'] == 'text/plain')) 
			&& ($_FILES['project-planner']['size'] <= 25000000)
		) {
			if($_FILES['project-planner']['error'] > 0) {
				$errors['project-planner'] = ' address this error with your file: "' . $_FILES['project-planner']['error'] . '".';
			} else {
				// Rename File?
				$file_basename = filename_basename($_FILES['project-planner']['name']);
				if($file_basename == 'planner') {
					if(!empty($_REQUEST['brand-name'])) {
						$pieces = explode(' ', strtolower($_REQUEST['brand-name']));
						$planner_ext = filename_extension($_FILES['project-planner']['name']);
						$newfilename = implode('-', $pieces) . '.' . $planner_ext;
					}
				}
				$attachment = true;
			}
		} else {
			// , Oasis OpenOffice, Adobe PDF,
			$errors['project-planner'] = ' upload a Microsoft Word or Plain Text file less than or equal to 25 <abbr title="Megabytes">MB</abbr>.';
		}
	} else {
		$attachment = false;
	}
	
	if ( !empty( $errors ) ) {
		# List of errors
		//$error_messages = "<div id=\"contact-result\"$hiddenAttr class=\"error msg\">\n";
		$error_messages = "<h3 class=\"h\">There Were Errors With Your Request</h3>\n";
		$error_messages .= "<ul>\n";
		foreach($errors as $key => $value) {
			$error_messages .= '<li><a href="#' . $key . '">Please' . $value . "</a></li>\n";
		}
		$error_messages .= "</ul>\n";
		//$error_messages .= "</div><!-- .error.msg -->\n\n";
		
		# Re-populate fields
		$name_input_attr = (!empty($_REQUEST['inquirerName']) ? ' value="' . $_REQUEST['inquirerName'] . '"' : '');

		$email_input_attr = (!empty($_REQUEST['inquirerEmail']) ? ' value="' . $_REQUEST['inquirerEmail'] . '"' : '');
        
        //$budget_input_attr = (!empty($_REQUEST['projectBudget']) ? ' value="' . $_REQUEST['projectBudget'] . '"' : '');
		
		$message_input_value = (!empty($_REQUEST['inquiry']) ? $_REQUEST['inquiry'] : '');
        
        $challenge_input_attr = ''; //(!empty($_REQUEST['challenge']['answer']) ? ' value="' . $_REQUEST['challenge']['answer'] . '"' : '');

		# Show form
		$form = true;
        
        header('HTTP/1.1 422 Unprocessable Entity');
        
        if($ajaxMode)
        {
            ob_clean();
            echo $error_messages;
            exit;
        }
	} else { // no errors
		if ( $_REQUEST['inquirySubject'] !== 'Form Test' ) {
			$message = 
					
				"$message_label " . (isset($_REQUEST['inquiry']) ? $_REQUEST['inquiry'] : 'No') . "\n\n" .
		
				'IP Address: ' . $_SERVER['REMOTE_ADDR']
			;
			
			if(isset($attachment) && $attachment) {
				if(isset($newfilename)) {
					$send = send_email($to, $_REQUEST['inquirerName'], $_REQUEST['inquirerEmail'], $subject, $message, $_FILES['project-planner'], $newfilename);
				} else {
					$send = send_email($to, $_REQUEST['inquirerName'], $_REQUEST['inquirerEmail'], $subject, $message, $_FILES['project-planner']);
				}
			} else {
				$send = send_email($to, $_REQUEST['inquirerName'], $_REQUEST['inquirerEmail'], $subject, $message);
			}
					
			if($send)
			{
				# Show delivery successful message
				$form = false;
				$result_page = '/thank-you/request-submitted.php';
				//$submitted = "<h2>Thank You!</h2>\n<p>Your request has been submitted. Your project will be assessed and a quote will be e-mailed to you as soon as possible.</p>\n";
			} else
			{
				$form = false;
				header('HTTP/1.1 500 Internal Server Error');
				//$submitted = "<h2>Error 500</h2>\n<p>Your request has not been submitted due to an error on this site. Please call <a href=\"tel:+15303776660\">+1 (530) 377-6660</a> for assistance.</p>\n";
				$result_page = '/thank-you/email-down';
			}
		} // Form Test
        
	  if ( $ajaxMode ) {
	    ob_clean();
	    echo $success_message;
	    exit;
	  }
	} // else
}
?>