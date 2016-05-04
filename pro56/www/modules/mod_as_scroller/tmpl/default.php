<?php

/*******************************************************************************************/
/*
/*        Designed by 'AS Designing'
/*        Web: http://www.asdesigning.com
/*        Web: http://www.astemplates.com
/*        License: GNU/GPL
/*
/*******************************************************************************************/

// no direct access
defined('_JEXEC') or die('Restricted access');
require __DIR__ . '/styles.php';

?>

<link rel="stylesheet" href="<?php echo JURI::base() ?>/modules/mod_as_scroller/css/styles.css" type="text/css" />

<div id="mod_as_scroller">
    <div class="as_marquee" id="as_scroller_<?php echo $module_id; ?>">
        <?php foreach ( $images as $image ) { echo $image; } ?>
    </div>
</div>
<?php

$style = "'width':'" . $params->get('scroller_width') . "',".
		 "'height':'" . $params->get('scroller_height') . "'";
	
$scroller_bgcolor = 'transparent';		 

if($params->get('scroller_bgcolor'))
{
	$scroller_bgcolor = '#' . $params->get('scroller_bgcolor');
	$style .= ",'background':'".$scroller_bgcolor."'";
}

$doc = JFactory::getDocument();
$doc->addScript(JURI::root(true).'/modules/mod_as_scroller/scripts/scroller.js');

if (!defined('_MOD_VARGAS_ONLOAD')) 
{
    define ('_MOD_VARGAS_ONLOAD',1);
    $doc->addScriptDeclaration("function addLoadEvent(func){if(typeof window.addEvent=='function'){window.addEvent('load',function(){func()});}else if(typeof window.onload!='function'){window.onload=func;}else{var oldonload=window.onload;window.onload=function(){if(oldonload){oldonload();}func();}}}");
}

$doc->addScriptDeclaration("addLoadEvent(function(){marqueeInit({uniqueid: 'as_scroller_".$module_id."',style:{".$style."},inc:".$params->get( 'scroller_speed' ).",mouse:'".$params->get( 'scroller_onmouseover' )."',direction:'".$params->get( 'scroller_direction' )."',valign:'".$params->get( 'scroller_valignment' )."',moveatleast: 1 ,neutral:0, savedirection:true});});");
