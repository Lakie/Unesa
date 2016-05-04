<?php
/**
* @package RSForm! Pro
* @copyright (C) 2007-2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

$out = '<div class="rsform-table" id="rsform-table1">'."\n";

foreach ($fields as $field) {
	if ($field->indetails) {
		if ($field->componentId < 0 && isset($headers[$field->componentId])) {
			$caption = JText::_('RSFP_'.$headers[$field->componentId]);
			$value	 = $this->getStaticPlaceholder($headers[$field->componentId]);
		} else {
			$caption = '{'.$field->FieldName.':caption}';
			$value 	 = '{'.$field->FieldName.':value}';
		}
		
		$out .= "\t".'<div class="rsform-table-row">'."\n";
		$out .= "\t\t".'<div class="rsform-left-col">'.$caption.'</div>'."\n";
		$out .= "\t\t".'<div class="rsform-right-col">'.$value.'</div>'."\n";
		$out .= "\t".'</div>'."\n";
	}
}

$out .= '</div>'."\n";
	
return $out;