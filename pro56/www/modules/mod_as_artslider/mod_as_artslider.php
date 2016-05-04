<?php

/*******************************************************************************************/
/*
/*		Web: http://www.asdesigning.com
/*		Web: http://www.astemplates.com
/*		License: GNU/GPL
/*
/*******************************************************************************************/

defined('_JEXEC') or die;

require __DIR__ . '/helper.php';

$app 	  = JFactory::getApplication();	
$document = JFactory::getDocument();
$template = $app->getTemplate();

switch($params->get('slider_style')){
	case 0:
		$document->addStyleSheet(JURI::base() . 'modules/mod_as_artslider/css/ext.artslider.css');
		break;
	case 1:
		$document->addStyleSheet(JURI::base() . 'templates/'.$template.'/css/ext.artslider.css');
		break;
}

$document->addScript(JURI::base() . 'modules/mod_as_artslider/js/camera.min.js');
$document->addScript(JURI::base() . 'modules/mod_as_artslider/js/easing-v1.3.js');

$list = modArtSliderHelper::getList($params);
require JModuleHelper::getLayoutPath('mod_as_artslider', $params->get('layout', 'default'));
