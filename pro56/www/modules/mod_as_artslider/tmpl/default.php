<?php

/*******************************************************************************************/
/*
/*		Web: http://www.asdesigning.com
/*		Web: http://www.astemplates.com
/*		License: GNU/GPL
/*
/*******************************************************************************************/

defined('_JEXEC') or die;
require __DIR__ . '/styles.php';

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
?>

<div id="camera-slideshow" class="<?php echo $moduleclass_sfx; ?>">

<?php
foreach ($list as $item) :
	require JModuleHelper::getLayoutPath('mod_as_artslider', '_item');
endforeach;

?>
</div>


<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('#camera-slideshow').camera({
			alignment			: "<?php echo $slider_alignment; ?>",
			autoAdvance			: <?php echo $slider_autoplay; ?>,
			mobileAutoAdvance	: <?php echo $slider_mobi_autoplay; ?>,
			cols				: <?php echo $slider_columns; ?>,
			easing				: "<?php echo $slider_easing; ?>",
			mobileEasing		: "<?php echo $slider_mobieasing; ?>",
			fx					: "<?php echo $slider_animation; ?>",	
			mobileFx			: "<?php echo $slider_mobianimation; ?>",
			gridDifference		: <?php echo $slider_grid_diff; ?>,
			height				: "<?php echo $slider_height; ?>",
			imagePath			: 'images/',
			hover				: <?php echo $slider_pause; ?>,
			navigation			: <?php echo $slider_navigation; ?>,
			navigationHover		: <?php echo $slider_hover_navigation; ?>,
			mobileNavHover		: <?php echo $slider_hover_navigation; ?>,
			opacityOnGrid		: <?php echo $slider_grid_opacity; ?>,
			pagination			: <?php echo $slider_pagination; ?>,
			playPause			: <?php echo $slider_play_pause; ?>,
			pauseOnClick		: <?php echo $slider_stop; ?>,
			rows				: <?php echo $slider_rows; ?>,
			slicedCols			: <?php echo $slider_slicedcols; ?>,
			slicedRows			: <?php echo $slider_slicedrows; ?>,
			time				: <?php echo $slider_showtime; ?>,
			transPeriod			: <?php echo $slider_transperiod; ?>,
			onEndTransition		: function() {  },	//this callback is invoked when the transition effect ends
			onLoaded			: function() {  },	//this callback is invoked when the image on a slide has completely loaded
			onStartLoading		: function() {  },	//this callback is invoked when the image on a slide start loading
			onStartTransition	: function() {  }	//this callback is invoked when the transition effect starts
		});
	});
</script>
