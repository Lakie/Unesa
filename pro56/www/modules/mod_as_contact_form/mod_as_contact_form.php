<?php

/*******************************************************************************************/
/*
/*        Web: http://www.asdesigning.com
/*        Web: http://www.astemplates.com
/*        License: GNU General Public License
/*
/*******************************************************************************************/

defined('_JEXEC') or die;

require_once('recaptchalib.php');

require_once(__DIR__ . '/helper.php');

$document = JFactory::getDocument();

$document->addStylesheet(JURI::base(true).'/modules/mod_as_contact_form/css/style.css');

JHtml::_('jquery.framework');

$document->addScript(JURI::base(true) . '/modules/mod_as_contact_form/js/jquery.validate.min.js');
$document->addScript(JURI::base(true) . '/modules/mod_as_contact_form/js/additional-methods.min.js');
$document->addScript(JURI::base(true) . '/modules/mod_as_contact_form/js/ajaxcaptcha.js');
$document->addScript(JURI::base(true) . '/modules/mod_as_contact_form/js/ajaxsendmail.js');

require JModuleHelper::getLayoutPath('mod_as_contact_form', $params->get('layout', 'default'));

?>