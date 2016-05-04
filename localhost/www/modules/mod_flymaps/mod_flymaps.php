<?php
/**
* @author    Evgeny Zakirov http://flyleaf.su
* @copyright Copyright (C) flyleaf.su
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
* спасибо можно отправить на 
* WM R138753723227 или про ЯД 41001613153284 
*/
defined('_JEXEC') or die('Restricted access');

$doc = JFactory::getDocument(); 

$width = $params->get('width','auto') == "auto" ? "100%": $params->get('width')."px";
$height = $params->get('height','300')."px";
$jertva = array ('\r','\t','\n','\0','\x0B','\r\n',chr(13),chr(10));
$gumno = array ('','','','','',' ',' ',' ');
$map_params = json_decode($params->get('map'));
$selfscript		= str_replace($jertva,$gumno,$params->get("object_data"));	

	$mapitems = array();
	if(count($map_params->placemarks	)) 
	foreach ($map_params->placemarks as $mapitem) {
		$mapitems[] = "cluster.add(new ymaps.Placemark([".$mapitem->coordinates[0].",".$mapitem->coordinates[1]."], {iconContent:\"".htmlspecialchars($mapitem->iconContent)."\",balloonContent:\"".htmlspecialchars($mapitem->balloonContent)."\",hintContent:\"".htmlspecialchars($mapitem->hintContent)."\"},{preset:\"".$mapitem->preset."\"}))";
	}
	
	$left = 5;
	$controls = array();
	if ($map_params->typeSelector) $controls[] = ".add('typeSelector')";
	if ($map_params->mapTools) {
		$controls[] = ".add('mapTools', { left: ".$left.", top: 5 })";
		$left = $left+30;
	}
	if ($map_params->zoomControl) {
		$controls[] = ".add('zoomControl', { left: ".$left.", top: 5 })";
	}
	if ($map_params->smallZoomControl) $controls[] = ".add('smallZoomControl', { right: 5, top: 75 })";
	if ($map_params->trafficControl) $traffic = "var trafficControl = new ymaps.control.TrafficControl();
    myMap.controls
        .add(trafficControl)
        .add(new ymaps.control.MiniMap({
            type: '".$map_params->type."'
        }));"; else $traffic = '';
	
	if (count($controls > 0)) 
		$control = "myMap.controls".implode('',$controls).";";
	else $control = "";
	
	$map_id = 'map'.uniqid();
	$map = "ymaps.ready(".$map_id.");
	function ".$map_id." () {
		var myMap = new ymaps.Map('".$map_id."', {
		  center: [".$map_params->coordinates[0].",".$map_params->coordinates[1]."],
		  zoom: ".$map_params->zoom.",
		  type: '".$map_params->type."'
		  }),
		  cluster = new ymaps.Clusterer(),
		  collection = new ymaps.GeoObjectCollection(),
		  bounds = myMap.getBounds();
		  ".$control."
		  ".$traffic."
		  ".implode(";\n",$mapitems)."; 
		  myMap.geoObjects.add(cluster);
		  \n".$selfscript."\n
	};";

$doc->addScript("//api-maps.yandex.ru/2.0-stable/?load=package.full&lang=ru-RU");
$doc->addScriptDeclaration($map);
echo '<div class="ymaps" id="'.$map_id.'" style="width:'.$width.';height:'.$height.';"></div>';
