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
$class = $item->anchor_css ? 'class="'.$item->anchor_css.'" ' : '';
$title = $item->anchor_title ? 'title="'.$item->anchor_title.'" ' : '';

if ($item->menu_image) 
{
	$item->params->get('menu_text', 1 ) ?
	$linktype = '<img src="'.$item->menu_image.'" alt="'.$item->title.'" /><span class="image-title">'.html_entity_decode($item->title).'</span> ' :
	$linktype = '<img src="'.$item->menu_image.'" alt="'.$item->title.'" />';
}
else 
{ 
	$linktype = $item->title . ($item->subtitle ? '<br/><small>'.$item->subtitle.'</small>': '');
}

switch ($item->browserNav) :
	default:
	case 0:
?>
<a <?php echo $class; ?>href="<?php echo $item->flink; ?>" <?php echo html_entity_decode($title); ?>><?php echo html_entity_decode($linktype); ?></a><?php
		break;
	case 1:
		// _blank
?>
<a <?php echo $class; ?>href="<?php echo $item->flink; ?>" target="_blank" <?php echo html_entity_decode($title); ?>><?php echo html_entity_decode($linktype); ?></a><?php
		break;
	case 2:
	// window.open
?>
<a <?php echo $class; ?>href="<?php echo $item->flink; ?>" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes');return false;" <?php echo html_entity_decode($title); ?>><?php echo html_entity_decode($linktype); ?></a><?php
		break;
endswitch;
