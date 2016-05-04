<?php
/* @package Joomla
 * @copyright Copyright (C) Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * @extension Phoca Extension
 * @copyright Copyright (C) Jan Pavelka www.phoca.cz
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */
defined( '_JEXEC' ) or die();
jimport( 'joomla.application.component.view' );
phocagalleryimport( 'phocagallery.render.renderinfo' );

class PhocaGalleryCpViewPhocaGallerycp extends JViewLegacy
{
	protected $t;
	
	public function display($tpl = null) {
	
		$this->t	= PhocaGalleryUtils::setVars('cp');
		$this->views= array(
		'imgs'		=> $this->t['l'] . '_IMAGES',
		'cs'		=> $this->t['l'] . '_CATEGORIES',
		't'			=> $this->t['l'] . '_THEMES',
		'ra'		=> $this->t['l'] . '_CATEGORY_RATING',
		'raimg'		=> $this->t['l'] . '_IMAGE_RATING',
		'cos'		=> $this->t['l'] . '_CATEGORY_COMMENTS',
		'coimgs'	=> $this->t['l'] . '_IMAGE_COMMENTS',
		'users'		=> $this->t['l'] . '_USERS',
		'fbs'		=> $this->t['l'] . '_FB',
		'tags'		=> $this->t['l'] . '_TAGS',
		'efs'	=> $this->t['l'] . '_STYLES',
		'in'		=> $this->t['l'] . '_INFO'
		);
		
		
		JHTML::stylesheet( $this->t['s'] );
		//JHTML::_('behavior.tooltip');
		$this->t['version'] = PhocaGalleryRenderInfo::getPhocaVersion();
		
		$this->addToolbar();
		parent::display($tpl);
	}
	
	protected function addToolbar() {
		require_once JPATH_COMPONENT.DS.'helpers'.DS.'phocagallerycp.php';

		$state	= $this->get('State');
		$canDo	= PhocaGalleryCpHelper::getActions();
		JToolBarHelper::title( JText::_( 'COM_PHOCAGALLERY_PG_CONTROL_PANEL' ), 'phoca.png' );
		
		if ($canDo->get('core.admin')) {
			JToolBarHelper::preferences('com_phocagallery');
			JToolBarHelper::divider();
		}
		
		JToolBarHelper::help( 'screen.phocagallery', true );
	}
}
?>