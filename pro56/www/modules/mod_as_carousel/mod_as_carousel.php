<?php

/*******************************************************************************************/
/*
/*        Web: http://www.asdesigning.com
/*        Web: http://www.astemplates.com
/*        License: GNU General Public License version
/*
/*******************************************************************************************/

defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once __DIR__ . '/helper.php';

$app 	  = JFactory::getApplication();	
$doc = JFactory::getDocument();
$document =& $doc;
$template = $app->getTemplate();
$layout   = $app->input->getCmd('layout', '');

switch($params->get('theme'))
{
	case 0:
		$document->addStyleSheet(JURI::base() . 'modules/mod_as_carousel/css/ascarousel.css');
		break;
	case 1:
		$document->addStyleSheet(JURI::base() . 'templates/'.$template.'/css/ascarousel.css');
		break;
}

if($params->get('autoPlay'))
	$document->addScript(JURI::base() . 'modules/mod_as_carousel/js/jquery.caroufredsel.auto.js');
else
	$document->addScript(JURI::base() . 'modules/mod_as_carousel/js/jquery.caroufredsel.static.min.js');
	
$document->addScript(JURI::base() . 'modules/mod_as_carousel/js/jquery.touchSwipe.min.js');
$document->addScript(JURI::base() . 'modules/mod_as_carousel/js/jquery.mousewheel.min.js');


$list = modASCarouselHelper::getList($params);
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

require JModuleHelper::getLayoutPath('mod_as_carousel', $params->get('layout', 'default'));
