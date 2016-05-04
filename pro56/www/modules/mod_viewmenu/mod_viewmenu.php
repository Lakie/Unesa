<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_view_menu
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die('Restricted access');

require_once dirname(__FILE__).'/helper.php';
$colParam = $params->get('qty','4');

require JModuleHelper::getLayoutPath('mod_viewmenu', $params->get('layout', 'default'));
