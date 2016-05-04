<?php
/**
* @package RSForm! Pro
* @copyright (C) 2007-2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/

defined('_JEXEC') or die('Restricted access');

require_once dirname(__FILE__).'/../formlayout.php';

class RSFormProFormLayoutBootstrap3 extends RSFormProFormLayout
{
	public $errorClass = ' has-error';
	
	public function __construct($loadFramework) {
		if ($loadFramework) {
			// Load the CSS files
			$this->addStyleSheet('com_rsform/frameworks/bootstrap3/bootstrap.min.css');	
			
			// Load jQuery
			$this->addjQuery();
			
			// Load Javascript
			$this->addScript('com_rsform/frameworks/bootstrap3/bootstrap.min.js');
			
			// Set the script for the tooltips
			$script = 'jQuery(function () {
				  jQuery(\'[data-toggle="tooltip"]\').tooltip({"html": true,"container": "body"});
				})';
			$this->addScriptDeclaration($script);
		}
	}
}