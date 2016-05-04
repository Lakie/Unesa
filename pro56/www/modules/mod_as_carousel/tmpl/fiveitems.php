<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_camera_slideshow
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
JHtml::addIncludePath(JPATH_BASE.'/components/com_content/helpers');

?>

<div class="five-items rounded">

	<?php if ($params->get('pretext')): ?>
    <div class="pretext">
        <?php echo $params->get('pretext') ?>
    </div>
    <?php endif; ?>
    
    <div class="mod_caroufredsel mod_caroufredsel__<?php echo $moduleclass_sfx; ?>" id="module_<?php echo $module->id; ?>">
        <div id="list_carousel_<?php echo $module->id; ?>" class="list_carousel">
    
            <ul id="images_caroufredsel_<?php echo $module->id; ?>" class="images_block">
                <?php
                foreach ($list as $key => $item) :
                    $class = '';
                    switch ($key) {
                        case 0:
                        $class = ' large';
                        break;
                        case 1:
                        $class = ' medium';
                        break;
                        case 4:
                        $class = ' medium';
                        break;
                        default:
                        $class = '';
                        break;
                    }
                 ?>
                    <li class="item<?php echo $class; ?>" id="item_<?php echo $item->id; ?>">	
                        <?php $item_images = json_decode($item->images);
                        if ($params->get('intro_image')): ?>
                        <!-- Intro Image -->
                        <figure class="item_img img-intro img-intro__<?php echo htmlspecialchars($params->get('intro_image_align')); ?>"> 
                            <?php if ((($params->get('item_title') && $params->get('link_titles')) || $params->get('readmore')) && $item->readmore) : ?>
                            <a href="<?php echo $item->link;?>">
                            <?php endif; ?>
                                <img src="<?php echo htmlspecialchars($item_images->image_intro); ?>" alt="<?php echo htmlspecialchars($item_images->image_intro_alt); ?>">
                                <?php if ($item_images->image_intro_caption): ?>
                                <figcaption><?php echo htmlspecialchars($item_images->image_intro_caption); ?></figcaption>
                                <?php endif;
                            if ((($params->get('item_title') && $params->get('link_titles')) || $params->get('readmore')) && $item->readmore) : ?>
                            </a>
                            <?php endif; ?>
                        </figure>
                        <?php endif; ?>
                    </li>
                <?php endforeach;	?>
            </ul>
    
            <ul id="caroufredsel_<?php echo $module->id; ?>">
                <?php
                foreach ($list as $key => $item) : ?>
                    <li class="item" id="item_<?php echo $item->id; ?>">
                        <?php require JModuleHelper::getLayoutPath('mod_as_carousel', '_fiveitems-rounded'); ?>
                    </li>
                <?php endforeach;	?>
            </ul>
    
            <div class="clearfix"></div>
        </div>
        <?php if($params->get('mod_button') == 1): ?>   
        <div class="mod-newsflash-adv_custom-link">
          <?php 
            $menuLink = $menu->getItem($params->get('custom_link_menu'));
    
              switch ($params->get('custom_link_route')) 
              {
                case 0:
                  $link_url = $params->get('custom_link_url');
                  break;
                case 1:
                  $link_url = JRoute::_($menuLink->link.'&Itemid='.$menuLink->id);
                  break;            
                default:
                  $link_url = "#";
                  break;
              }
              echo '<a href="'. $link_url .'">'. $params->get('custom_link_title') .'</a>';
          ?>
        </div>
    <?php endif; ?>
    </div>

	<?php if ($params->get('navigation') && $key>0): ?>
        <div id="carousel_<?php echo $module->id; ?>_prev" class="caroufredsel_prev"><i class="icon-arrow-left-5"></i></div>
        <div id="carousel_<?php echo $module->id; ?>_next" class="caroufredsel_next"><i class="icon-arrow-right-5"></i></div>
    <?php endif; ?>

</div>

<script>
jQuery(function($) {
	var images_carousel = $("#images_caroufredsel_<?php echo $module->id; ?>")
	images_carousel.carouFredSel({
		width: '100%',
		items		: {
			height: 'variable',
			visible		: {
				min			: <?php echo $params->get('min_items');?>,
				max			: <?php echo $params->get('max_items');?>
			},
			minimum: 1,
			start: 3
		},
		scroll: {
			items: 1,
			fx: "<?php echo $params->get('fx'); ?>",
			easing: "<?php echo $params->get('easing'); ?>",
			duration: <?php echo $params->get('duration'); ?>,
			onBefore: function( data ) {

				//	0  1  2  3 [ 4 ]
				data.items.old.removeClass('medium').removeClass('large');
				//	0 [ 1 ] 2  3  4
				data.items.visible.eq(1).addClass('medium')
				
				// 0  1  2  [ 3 ] 4
				data.items.visible.eq(2).addClass('large');
				
				//	0  1 [ 2 ] 3  4
				data.items.visible.eq(3).addClass('medium');
				
			}
		},
		auto: false,
		swipe:{
			onTouch: false
		}
	});
	var carousel = $("#caroufredsel_<?php echo $module->id; ?>")
	carousel.carouFredSel({
		responsive: true,
		width: '100%',
		items		: {
			height: 'variable',
			width : <?php echo $params->get('max_width'); ?>,
			visible		: {
				min			: 1,
				max			: 1
			},
			minimum: 1
		},
		scroll: {
			items: 1,
			fx: "fade",
			easing: "<?php echo $params->get('easing'); ?>",
			duration: <?php echo $params->get('duration'); ?>
		},
		auto: false,
		swipe:{
			onTouch: false
		}
	});
	<?php if ($params->get('navigation')): ?>
	$("#carousel_<?php echo $module->id; ?>_prev").click(function(){
		images_carousel.trigger('prev')
		carousel.trigger('prev')
	})
	$("#carousel_<?php echo $module->id; ?>_next").click(function(){
		images_carousel.trigger('next')
		carousel.trigger('next')
	})
	<?php endif; ?>
});
</script>
