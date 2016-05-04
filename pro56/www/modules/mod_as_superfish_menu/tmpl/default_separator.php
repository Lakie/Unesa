<?php

/*******************************************************************************************/
/*
/*        Web: http://www.asdesigning.com
/*        Web: http://www.astemplates.com
/*        License: GNU General Public License version 3 or later
/*
/*******************************************************************************************/

// No direct access.
defined('_JEXEC') or die;

// Note. It is important to remove spaces between elements.
$title = $item->anchor_title ? 'title="'.$item->anchor_title.'" ' : '';
if ($item->menu_image) {
		$item->params->get('menu_text', 1 ) ?
		$linktype = '<img src="'.$item->menu_image.'" alt="'.$item->title.'" /><span class="image-title">'.html_entity_decode($item->title).'</span> ' :
		$linktype = '<img src="'.$item->menu_image.'" alt="'.$item->title.'" />';
}
else { 
  $linktype = $item->title . ($item->subtitle ? '<br/><small>'.$item->subtitle.'</small>': '');
}

?><span class="separator"<?php echo html_entity_decode($item->title); ?>><?php echo html_entity_decode($linktype); ?></span>
