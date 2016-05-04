<?php
	defined('_JEXEC') or die;
?>

<div class="mod-single-article mod-single-article__<?php echo $moduleclass_sfx; ?>">
	<div class="item item__module">

		<!-- Intro Image -->
		<?php if ($params->get('show_intro_image')) : ?>
			<?php  if (isset($item_images->image_intro) and !empty($item_images->image_intro)) : ?>
			<?php $imgfloat = (empty($item_images->float_intro)) ? $params->get('float_intro') : $item_images->float_intro; ?>
			<div class="item_img img-intro img-intro__<?php echo htmlspecialchars($imgfloat); ?>"> <img
				<?php if ($item_images->image_intro_caption):
					echo 'class="caption"'.' title="' .htmlspecialchars($item_images->image_intro_caption) .'"';
				endif; ?>
				src="<?php echo htmlspecialchars($item_images->image_intro); ?>" alt="<?php echo htmlspecialchars($item_images->image_intro_alt); ?>"/> </div>
			<?php endif; ?>
		<?php endif; ?>

		<!-- Item Title -->
		<?php if ($params->get('item_title')) : ?>
			<<?php echo $item_heading; ?> class="item_title">
				<?php if ($params->get('link_titles') && isset($item->link)) : ?>
					<a href="<?php echo $item->link;?>">
						<?php echo $item->title;?></a>
				<?php else : ?>
					<?php echo $item->title; ?>
				<?php endif; ?>
			</<?php echo $item_heading; ?>>
		<?php endif; ?>

		<?php echo $item->afterDisplayTitle; ?>

		<?php echo $item->beforeDisplayContent; ?>


		<!-- Publish Date -->
		<?php if ($params->get('published_on')) : ?>
			<span class="item_published">
				<?php echo JHtml::_('date', $item->publish_up, JText::_('DATE_FORMAT_TPL1')); ?>
			</span>
		<?php endif; ?>

		<?php if ($params->get('createdby')) : ?>
			<div class="item_createdby">
				<?php $author = $item->author; ?>
				<?php $author = ($item->created_by_alias ? $item->created_by_alias : $author); ?>
					<?php echo JText::sprintf('TPL_BY', $author); ?>
			</div>
		<?php endif; ?>

		<!-- Intro Text -->

		<div class="item_introtext">
			<?php echo $item->introtext; ?>

			<?php if (isset($item->link) && $params->get('readmore')) :
				echo '<a class="btn btn_info readmore" href="'.$item->link.'">'.$item->linkText.'</a>';
			endif; ?>
		</div>	

	</div>
</div>