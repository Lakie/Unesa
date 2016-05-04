<?php

defined('JPATH_BASE') or die;

jimport('joomla.form.formfield');

class JFormFieldMap extends JFormField {

	protected $type = 'Map';
	protected $constructor;
	
	public function getLabel() {
		return '';
	}
	public function getInput() {
		$map_params = json_decode($this->value);
		$jertva = array ('\r','\t','\n','\0','\x0B','\r\n',chr(13),chr(10));
		$gumno = array ('','','','','',' ',' ',' ');	
		
		$doc = JFactory::getDocument();
		$doc->addScript("//api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=ru-RU");
		$version = new JVersion; if(!$version->isCompatible('3.0'))
		$doc->addScript("//yandex.st/jquery/2.1.0/jquery.min.js	");
		$doc->addScript("/modules/mod_flymaps/assets/flymap.js");
		$doc->addScript("/modules/mod_flymaps/assets/jquery.json-2.4.min.js");
		
		//$doc->addScriptDeclaration($this->constructor());
		$doc->addStyleSheet( '/modules/mod_flymaps/assets/flymap.css' );
		$html = "<div class='control-group'><div class='ctrl1' id='controls' ><p>Подключить инструменты:</p>";
		$html .= $map_params->mapTools ? "<button value='mapTools' class='btn btn-success'>Tools</button>" : "<button value='mapTools' class='btn'>Tools</button>";
		$html .= $map_params->zoomControl ? "<button value='zoomControl' class='btn btn-success'>Zoom</button>" : "<button value='zoomControl' class='btn'>Zoom</button>";
		$html .= $map_params->smallZoomControl ? "<button value='smallZoomControl' class='btn btn-success'>smallZoom</button>" : "<button value='smallZoomControl' class='btn'>smallZoom</button>";
		$html .= $map_params->typeSelector ? "<button value='typeSelector' class='btn btn-success'>Type</button>" : "<button value='typeSelector' class='btn'>Type</button>";
		$html .= $map_params->trafficControl ? "<button value='trafficControl' class='btn btn-success'>Traffic</button>" : "<button value='trafficControl' class='btn'>Traffic</button>";
		$html .=  "</div><div class='ctrl2'><p>Добавить элементы:</p><button id='placemark' class='btn'>Метка</button></div></div>";
		$html.= "<div id='constructor'>"; 
		$html.= "<h3>Настройки карты</h3>";
		$html.= "<p>Редактируем на свой страх и риск. Перечисление параметров в формате JSON. Старайтесь хотябы кавычки закрывать :)</p>";
		$html.= "<textarea name='$this->formControl[$this->group][$this->fieldname]' id='map_data'>$this->value</textarea>";
		$html.= "<p>Это тестовая версия модуля пожелания можете оставлять <a href='http://flyleaf.su/blog/joomla/modul-yandeks-kart-s-rasshirennymi-nastroykami-dlya-joomla-2.5.html#comment-495' target='_blank'>в комментариях </a>";
		$html.= "<div id='map'></div>";			
		$html.= "</div>";
		$html.= "<div class='control-group'><a href='#' id='hidemap' class='btn'>Выключить карту</a></div>";
		
		
		return str_replace($jertva,$gumno,$html);
	}
	function constructor($html = array()) {
		$html[] = '';
		
		return implode("\n",$html);
	}
}