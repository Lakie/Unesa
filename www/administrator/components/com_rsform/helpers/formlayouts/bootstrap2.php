<?php
/**
* @package RSForm! Pro
* @copyright (C) 2007-2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/

defined('_JEXEC') or die('Restricted access');

require_once dirname(__FILE__).'/../formlayout.php';

class RSFormProFormLayoutBootstrap2 extends RSFormProFormLayout
{
	public $errorClass = ' error';
	
	public function __construct($loadFramework) {
		if ($loadFramework) {
			$jversion = new JVersion;
			$is30	  = $jversion->isCompatible('3.0');
			$doc = JFactory::getDocument();
			
			if ($is30) {
				JHtml::_('bootstrap.framework');
				JHtmlBootstrap::loadCss(true, $doc->direction);
				
				// tooltip initialization
				if (RSFormProHelper::isJ('3.3')) {
					JHtml::_('behavior.core');
				}
				JHtml::_('bootstrap.tooltip');
			} else {
				// Load the CSS files
				$this->addStyleSheet('com_rsform/frameworks/bootstrap2/bootstrap.min.css');
				$this->addStyleSheet('com_rsform/frameworks/bootstrap2/bootstrap-extended.css');
				$this->addStyleSheet('com_rsform/frameworks/bootstrap2/bootstrap-responsive.min.css');
				if ($doc->direction == 'rtl') {
					$this->addStyleSheet('com_rsform/frameworks/bootstrap2/bootstrap-rtl.css');	
				}
				// Load jQuery
				$this->addjQuery();
				
				// Load Javascript
				$this->addScript('com_rsform/frameworks/bootstrap2/bootstrap.min.js');
				// Set the script for the tooltips
				$script = '
						jQuery(document).ready(function(){
							jQuery(\'.hasTooltip\').tooltip({"html": true,"container": "body"});
						});
				';
				$this->addScriptDeclaration($script);
			}
		}
	}
}