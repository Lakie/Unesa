<?php

/*******************************************************************************************/
/*
/*		Web: http://www.asdesigning.com
/*		Web: http://www.astemplates.com
/*		License: GNU/GPL
/*
/*******************************************************************************************/

defined('_JEXEC') or die;
$images = json_decode($item->images);

?>

<div class="camera-item" data-src="<?php echo JURI::base().htmlspecialchars($images->image_intro); ?>">

	<?php if($params->get('slider_caption')): ?>
	
		<div class="camera_caption <?php echo $params->get('slider_caption_animation'); ?>">
			<?php $title_heading = $params->get('title_heading', 'h2'); ?>

			<?php if ($params->get('show_title')) : ?>
				<?php 
                echo '<' . $title_heading . ' class="slide_title slide_title__' . $params->get('moduleclass_sfx'); 
                ?>">
				<?php if ($params->get('link_titles') && $item->link != '') : ?>
					<a href="<?php echo $item->link;?>">
						<?php echo $item->title;?></a>
				<?php else : ?>
					<?php 
						$string_array = explode(" ", $item->title); 
						$string_spans[] = "";
						unset($string_spans);
						foreach ($string_array as $key => $value) 
						{
							$string_spans[] = '<span class="item_title_part' . $key . '">' . $value . '</span> ';
						}
						echo implode($string_spans);
					?>
				<?php endif; ?>
				</<?php echo $title_heading; ?>>
			<?php endif; ?>
	
			<?php if (!$params->get('intro_only')) :
				echo $item->afterDisplayTitle;
			endif; ?>
	
			<?php echo $item->beforeDisplayContent; ?>
				
			<?php echo $item->introtext; ?>
	
			<?php if (isset($item->link) && $item->readmore != 0 && $params->get('readmore')) :
				echo '<a class="readmore" href="'.$item->link.'">'.JText::_($params->get('readmore_txt')).'<span class="arrow"></span></a>';
			endif; ?>
		</div>
	<?php endif; ?>

</div>
