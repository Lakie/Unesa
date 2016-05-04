<?php

/*******************************************************************************************/
/*
/*        Web: http://www.asdesigning.com
/*        Web: http://www.astemplates.com
/*        License: GNU General Public License version 3 or later
/*
/*******************************************************************************************/

// no direct access
defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once dirname(__FILE__).'/helper.php';

$doc = JFactory::getDocument();
$document =& $doc;
$document->addStyleSheet('modules/mod_as_superfish_menu/css/superfish.css');

$document->addScript('modules/mod_as_superfish_menu/js/superfish.min.js');

$list	= modSFMenuHelper::getList($params);
$app	= JFactory::getApplication();
$menu	= $app->getMenu();
$active	= $menu->getActive();
$active_id = isset($active) ? $active->id : $menu->getDefault()->id;
$path	= isset($active) ? $active->tree : array();
$showAll	= $params->get('showAllChildren');
$class_sfx	= htmlspecialchars($params->get('class_sfx'));

if($active)
{
	$pagetitle = $document->getTitle();
	if(strpos($pagetitle, '||'))
	{
		$pagetitle = explode('||', $pagetitle);
		$pagetitle = $pagetitle[0];
	}
	$document->setTitle($pagetitle);
}

if(count($list)) 
{
	require_once JModuleHelper::getLayoutPath('mod_as_superfish_menu', $params->get('layout', 'default'));
}