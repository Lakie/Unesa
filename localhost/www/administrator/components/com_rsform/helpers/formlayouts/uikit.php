<?php
/**
* @package RSForm! Pro
* @copyright (C) 2007-2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/

defined('_JEXEC') or die('Restricted access');

require_once dirname(__FILE__).'/../formlayout.php';

class RSFormProFormLayoutUIkit extends RSFormProFormLayout
{
	public $errorClass = ' uk-form-danger';
	
	public function __construct($loadFramework) {
		if ($loadFramework) {
			// Load the CSS files
			$this->addStyleSheet('com_rsform/frameworks/uikit/uikit.min.css');
			$this->addStyleSheet('com_rsform/frameworks/uikit/tooltip.min.css');
			$this->addStyleSheet('com_rsform/frameworks/uikit/form-advanced.min.css');
			$this->addStyleSheet('com_rsform/frameworks/uikit/progress.min.css');
			
			// Load jQuery
			$this->addjQuery();
			
			// Load Javascript
			$this->addScript('com_rsform/frameworks/uikit/uikit.min.js');
			$this->addScript('com_rsform/frameworks/uikit/tooltip.min.js');
		}
	}
}