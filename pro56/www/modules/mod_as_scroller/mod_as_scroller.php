<?php
/*******************************************************************************************/
/*
/*        Designed by 'AS Designing'
/*        Web: http://www.asdesigning.com
/*        Web: http://www.astemplates.com
/*        License: GNU/GPL
/*
/*******************************************************************************************/

// no direct access
defined('_JEXEC') or die;

global $module_id;
$module_id = $module->id;

// Include the syndicate functions only once
require_once (dirname(__FILE__).DIRECTORY_SEPARATOR.'helper.php');

$folder	= modASScrollerHelper::getFolder($params);
$images	= modASScrollerHelper::getImages($params, $folder);

if (!count($images)) {
	echo JText::_( 'No images ');
	return;
}

require JModuleHelper::getLayoutPath('mod_as_scroller', $params->get('layout', 'default'));
