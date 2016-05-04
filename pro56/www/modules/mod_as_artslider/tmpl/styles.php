<?php

/*******************************************************************************************/
/*
/*		Web: http://www.asdesigning.com
/*		Web: http://www.astemplates.com
/*		License: GNU/GPL
/*
/*******************************************************************************************/

$title_color	 				= '#' . $params->get('title_color');
$link_title_color	 			= '#' . $params->get('link_title_color');
$link_hover_title_color			= '#' . $params->get('link_hover_title_color');
$firstword_title_color			= '#' . $params->get('firstword_title_color');
$secondword_title_color			= '#' . $params->get('secondword_title_color');

$readmore_gradient_topcolor		= $params->get('readmore_gradient_topcolor');
$readmore_gradient_bottomcolor	= $params->get('readmore_gradient_bottomcolor');
$readmore_bgcolor				= '#' . $params->get('readmore_bgcolor');
$readmore_color					= '#' . $params->get('readmore_color');

$slider_alignment 				= $params->get('slider_alignment');
$slider_autoplay 				= $params->get('slider_autoplay');
$slider_mobi_autoplay 			= $params->get('slider_mobi_autoplay');
$slider_columns 				= $params->get('slider_columns');
$slider_easing					= $params->get('slider_easing');
$slider_mobieasing				= $params->get('slider_mobieasing');
$slider_animation				= $params->get('slider_animation');
$slider_mobianimation			= $params->get('slider_mobianimation');
$slider_grid_diff				= $params->get('slider_grid_diff');
$slider_height					= $params->get('slider_height');
$slider_pause					= $params->get('slider_pause'); 
$slider_navigation				= $params->get('slider_navigation');
$slider_hover_navigation 		= $params->get('slider_hover_navigation');
$slider_grid_opacity			= $params->get('slider_grid_opacity');
$slider_pagination				= $params->get('slider_pagination');
$slider_pagination_color		= '#' . $params->get('slider_pagination_color');
$slider_pagination_hovercolor	= '#' . $params->get('slider_pagination_hovercolor');
$slider_pagination_radius		= $params->get('slider_pagination_radius');
$slider_play_pause				= $params->get('slider_play_pause');
$slider_stop					= $params->get('slider_stop');
$slider_rows					= $params->get('slider_rows');
$slider_slicedcols				= $params->get('slider_slicedcols');
$slider_slicedrows				= $params->get('slider_slicedrows');
$slider_showtime				= $params->get('slider_showtime');
$slider_transperiod				= $params->get('slider_transperiod');
$slider_caption_color			= '#' . $params->get('slider_caption_color');
$slider_caption_fontsize		= $params->get('slider_caption_fontsize');

?>

<style type="text/css">

.slide_title
{
    color: <?php echo $title_color ?>;
}

.slide_title a
{
    color: <?php echo $link_title_color ?>;
}

.slide_title a:hover
{
    color: <?php echo $link_hover_title_color ?>;
}

.slide_title .item_title_part0 
{
    color: <?php echo $firstword_title_color ?>;	
}

.slide_title .item_title_part1
{
    color: <?php echo $secondword_title_color ?>;	
}

.camera_caption p
{
    color: <?php echo $slider_caption_color ?>;
	font-size: <?php echo $slider_caption_fontsize ?>;
	line-height: <?php echo $slider_caption_fontsize ?>;
}

.camera_caption a.readmore
{
	background-color: <?php echo $readmore_bgcolor ?>;
	color: <?php echo $readmore_color ?>;
	
	<?php  if($readmore_gradient_topcolor && $readmore_gradient_bottomcolor): ?>	
	background-image: -moz-linear-gradient(top, #<?php echo $readmore_gradient_topcolor; ?>, #<?php echo $readmore_gradient_bottomcolor; ?>);
	background-image: -webkit-linear-gradient(top, #<?php echo $readmore_gradient_topcolor; ?>, #<?php echo $readmore_gradient_bottomcolor; ?>);
	background-image: -o-linear-gradient(top, #<?php echo $readmore_gradient_topcolor; ?>, #<?php echo $readmore_gradient_bottomcolor; ?>);
	background-image: linear-gradient(to bottom, #<?php echo $readmore_gradient_topcolor; ?>, #<?php echo $readmore_gradient_bottomcolor; ?>);
 	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff<?php echo $readmore_gradient_topcolor; ?>', endColorstr='#ff<?php echo $readmore_gradient_bottomcolor; ?>', GradientType=0);
	<?php endif; ?>
}

.camera_caption a.readmore:hover
{
	background-color: <?php echo $readmore_bgcolor ?>;
}

.camera_wrap .camera_pag .camera_pag_ul li.cameracurrent, 
.camera_wrap .camera_pag .camera_pag_ul li:hover
{
	background-color: <?php echo $slider_pagination_hovercolor; ?>;	
	-webkit-border-radius: <?php echo $slider_pagination_radius; ?>;		
	-moz-border-radius: <?php echo $slider_pagination_radius; ?>;		
	border-radius: <?php echo $slider_pagination_radius; ?>;	
}

.camera_wrap .camera_pag .camera_pag_ul li
{
	background-color: <?php echo $slider_pagination_color; ?>;
	-webkit-border-radius: <?php echo $slider_pagination_radius; ?>;		
	-moz-border-radius: <?php echo $slider_pagination_radius; ?>;		
	border-radius: <?php echo $slider_pagination_radius; ?>;		
}

</style>