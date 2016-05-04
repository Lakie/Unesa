<?php

defined('_JEXEC') or die;
$qty = '';
switch ($colParam) {
	case 1:
		$qty = 'span12';
		break;
	case 2:
		$qty = 'span6';
		break;
	case 3:
		$qty = 'span4';
		break;
	default:
		$qty = 'span3';
		break;
}

?>
<div class="main-content-menu">
	<?php
		for($count=1; $count<=$colParam; $count++){
	?>
	<div class="col-menu <?php echo $qty; ?>">
		<div class="col-menu-in">
			<div class="title-menu">
				<h3><a href="<?php echo $params->get('link_'.$count); ?>"><?php echo $params->get('title_'.$count); ?></a></h3>
			</div>
			<div class="img-menu">
				<a href="<?php echo $params->get('link_'.$count); ?>"><img src="<?php echo $params->get('img_'.$count); ?>" alt=""/></a>
			</div>
			<div class="desc-menu">
				<div class="desc-menu-in">
					<?php echo $params->get('link_'.$count.'_text'); ?>
				</div>
			</div>
			<div class="readmore-menu">
				<a href="<?php echo $params->get('link_'.$count); ?>"><?php echo JText::_('MOD_VIEW-MENU_READMORE'); ?></a>
			</div>
		</div>
	</div>
	<?php } ?>
</div>