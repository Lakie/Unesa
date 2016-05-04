<?php

/*******************************************************************************************/
/*
/*        Web: http://www.asdesigning.com
/*        Web: http://www.astemplates.com
/*        License: GNU General Public License
/*
/*******************************************************************************************/

defined('_JEXEC') or die;

class modASContactFormHelper
{
	public static function recaptchaAjax()
	{
		jimport('joomla.application.module.helper');
		require_once('recaptchalib.php');
		$input  		= JFactory::getApplication()->input;
		$module 		= JModuleHelper::getModule('as_contact_form');
		$params 		= new JRegistry();
		$params->loadString($module->params);
		$inputs 		= $input->get('data', array(), 'ARRAY');
		foreach ($inputs as $input) {
			
			if( $input['name'] == 'recaptcha_challenge_field' )
			{
				$recaptcha_challenge_field 			= $input['value'];
			}

			if( $input['name'] == 'recaptcha_response_field' )
			{
				$recaptcha_response_field 			= $input['value'];
			}

		}
		$resp = recaptcha_check_answer ($params->get('private_key'), $_SERVER["REMOTE_ADDR"], $recaptcha_challenge_field, $recaptcha_response_field);
		if (!$resp->is_valid) {
		    //Captcha was entered incorrectly
			$result = "captcha_error";
		  } else {
		    //Captcha was entered correctly
		    $result = "success";
		}
		return $result;
	}

	public static function getAjax()
	{
		jimport('joomla.application.module.helper');
		$input  		= JFactory::getApplication()->input;
		$module 		= JModuleHelper::getModule('as_contact_form');
		$params 		= new JRegistry();
		$params->loadString($module->params);

		$mail 			= JFactory::getMailer();

		$success 		= $params->get('success_notify');
		$failed 		= $params->get('failure_notify');
		$recipient 		= $params->get('admin_email');
		$cc_email 		= $params->get('cc_email');
		$bcc_email 		= $params->get('bcc_email');

		//inputs
		$inputs 		= $input->get('data', array(), 'ARRAY');

		foreach ($inputs as $input) {
			
			if( $input['name'] == 'email' )
			{
				$email 			= $input['value'];
			}

			if( $input['name'] == 'name' )
			{
				$name 			= $input['value'];
			}

			if( $input['name'] == 'phone' )
			{
				$phone 			= $input['value'];
			}

			if( $input['name'] == 'type' )
			{
				$type 			= $input['value'];
			}

			if( $input['name'] == 'message' )
			{
				$message 			= nl2br( $input['value'] );
			}

		}

		$name_name	= $params->get('name_name');
		$email_name	= $params->get('email_name');
		$phone_name	= $params->get('phone_name');
		$subject_name	= $params->get('subject_name');
		$message_name	= $params->get('message_name');

		// Building Mail Content
		$formcontent = "\n".$name_name.": $name";
		if(isset($email)){
			$formcontent .= "\n\n".$email_name.": $email";
		}
		if(isset($phone)){
			$formcontent .= "\n\n".$phone_name.": $phone";
		}
		if(isset($type)){
			$formcontent .= "\n\n".$subject_name.": $type";
		}
		if(isset($message)){
			$formcontent .= "\n\n".$message_name.": $message";
		}

		$subject = $name.", ".$_SERVER['HTTP_HOST'];
		if(isset($type)){
			$subject .= " for $type";
		}
		if(isset($_POST['email']))
			$sender = array($email, $name);	
		else
			$sender = $name;
		$mail->setSender($sender);
		$mail->addRecipient($recipient);
		if(isset($cc_email))
			$mail->addCC($cc_email);
		if(isset($bcc_email))
			$mail->addBCC($bcc_email);
		$mail->setSubject($subject);
		$mail->isHTML(true);
		$mail->Encoding = 'base64';	
		$mail->setBody($formcontent);
		 
		if ($mail->Send() === true) {
		  	return $success;
		} else {
		   	return '<span>'.$failed . "<br>" . $mail->Send()->__toString().'</span>';
		}
	}
}