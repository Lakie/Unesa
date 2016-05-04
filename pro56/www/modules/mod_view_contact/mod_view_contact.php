<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_view_contact
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die('Restricted access');

require_once dirname(__FILE__).'/helper.php';
$region = $params->get('region');
$city = $params->get('city');
$adres = $params->get('adres');
$email = $params->get('email');
$phone_mob = $params->get('phone-mob');
$phone_dom = $params->get('phone-dom');

require JModuleHelper::getLayoutPath('mod_view_contact', $params->get('layout', 'default'));
