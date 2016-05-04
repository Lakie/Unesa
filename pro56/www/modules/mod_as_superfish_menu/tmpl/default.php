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
$layouttype = $params->get('sf-layout');

switch ($layouttype) 
{
	case 'hor':
		$layout_class = "";
		break;
	case 'vert':
		$layout_class = "sf-vertical";
		break;
	default:
		$layout_class = "";
		break;
}
?>

<?php if(!$params->get('sf-mobiselect')) : ?>
<a class="btn btn-navbar btn-sf-menu">
	<span class="fa fa-bars icon-paragraph-justify"></span>
</a>
<?php endif; ?> 

<ul class="sf-menu <?php echo $class_sfx;?> <?php echo $layout_class; ?><?php if($params->get('sf-sticky')) : ?> sticky<?php endif; ?>" id="module-<?php echo $module->id; ?>">

<?php
foreach ($list as $i => &$item) :
	$class = 'item-'.$item->id;
	if ($item->id == $active_id) 
	{
		$class .= ' current';
	}

	if (in_array($item->id, $path)) 
	{
		$class .= ' active';
	}
	elseif ($item->type == 'alias') 
	{
		$aliasToId = $item->params->get('aliasoptions');
		if (count($path) > 0 && $aliasToId == $path[count($path)-1]) 
		{
			$class .= ' active';
		}
		elseif (in_array($aliasToId, $path)) 
		{
			$class .= ' alias-parent-active';
		}
	}

	if ($item->deeper) 
	{
		$class .= ' deeper dropdown';
	}

	if ($item->parent) 
	{
		$class .= ' parent';
	}

	if (!empty($class)) 
	{
		$class = ' class="'.trim($class) .'"';
	}

	echo '<li'.$class.'>';

	// Render the menu item.
	switch ($item->type) :
		case 'separator':
		case 'url':
		case 'component':
			require JModuleHelper::getLayoutPath('mod_as_superfish_menu', 'default_'.$item->type);
			break;

		default:
			require JModuleHelper::getLayoutPath('mod_as_superfish_menu', 'default_url');
			break;
	endswitch;

	// The next item is deeper.
	if ($item->deeper) 
	{
		echo '
		<ul class="sub-menu">
		';
	}
	// The next item is shallower.
	elseif ($item->shallower) 
	{
		echo '</li>
		';
		echo str_repeat('</ul>
			</li>
			', $item->level_diff);
	}
	// The next item is on the same level.
	else 
	{
		echo '</li>
		';
	}
endforeach;
?></ul>

<script>
	// initialise plugins
	jQuery(function($){
		$('#module-<?php echo $module->id; ?>')
			<?php if($params->get('sf-dynamic')): ?> 
				.supersubs({
					minWidth:    12,   // minimum width of sub-menus in em units
					maxWidth:    27,   // maximum width of sub-menus in em units
					extraWidth:  1     // extra width can ensure lines don't sometimes turn over
		                         	   // due to slight rounding differences and font-family
				})
		<?php endif; ?> 
		.superfish({
			hoverClass:    'sfHover',         
			pathClass:     'overideThisToUse',
			pathLevels:    1,    
			delay:         <?php echo $params->get('sf-delay'); ?>, 
			animation:     {opacity:'show'}, 
			speed:         'normal',   
			speedOut:      'fast',   
			autoArrows:    false, 
			disableHI:     false, 
			useClick:      <?php echo $params->get('sf-onclick'); ?>,
			easing:        "swing",
			onInit:        function(){},
			onBeforeShow:  function(){},
			onShow:        function(){},
			onHide:        function(){},
			onIdle:        function(){}
		})
		<?php if($params->get('sf-mobiselect')) : ?>
		.mobileMenu({
			defaultText: "<?php echo $params->get('sf-mobinavtext'); ?>",
			className: "<?php echo $params->get('sf-mobiclassname'); ?>",
			subMenuClass: "<?php echo $params->get('sf-mobisubclassname'); ?>"
		});
		<?php endif; ?> 
		var ismobile = navigator.userAgent.match(/(iPhone)|(iPod)|(android)|(webOS)/i)
		if(ismobile){
			$('#module-<?php echo $module->id; ?>').sftouchscreen();
		}
		$('.btn-sf-menu').click(function(){
			$('#module-<?php echo $module->id; ?>').toggleClass('in')
		});
		<?php if($params->get('sf-sticky')) : ?>
			$('#module-<?php echo $module->id; ?>').parents('[id*="-row"]').scrollToFixed({minWidth :768});
		<?php endif; ?>
		<?php if($params->get('sf-mobisticky')) : ?>
			$('#module-<?php echo $module->id; ?>').parent().scrollToFixed({maxWidth :767});
		<?php endif; ?>
	})
</script>