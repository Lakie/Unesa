(function(jQuery){
function init() {
		jQuery('#constructor').parents('.controls').css({'margin-left':'0px'}).prev().css({'display':'none'});
		var mapdata = jQuery.evalJSON(jQuery('#map_data').val()),
		geolocation = ymaps.geolocation,
        coords = mapdata.coordinates,
		maptype = mapdata.type,
		mapzoom = mapdata.zoom;
		if (coords === undefined) {
			coords = [geolocation.latitude, geolocation.longitude];
			mapdata.coordinates = coords;
		}
		if (maptype === undefined) {
			maptype = 'yandex#map';
			mapdata.type = maptype;
		}
		if (mapzoom === undefined) {
			mapzoom = '10';
			mapdata.zoom = mapzoom;
		}
        myMap = new ymaps.Map('map', {
            center: coords,
            zoom: mapzoom,
			type: maptype 
        });
		
		datajson = JSON.stringify(mapdata);
		jQuery('#map_data').val(datajson);	
		
		placemarks = mapdata.placemarks;
		for(var key in placemarks) {
			myMap.geoObjects.add(new ymaps.Placemark( placemarks[key]['coordinates'], 
				{iconContent: placemarks[key]['iconContent'], hintContent:  placemarks[key]['hintContent'], balloonContent:  placemarks[key]['balloonContent']}, 
				{preset: placemarks[key]['preset'], draggable: true}
			  ));
		}

		myMap.events.add(['boundschange', 'typechange'], function() {
				var mapdata = jQuery.evalJSON(jQuery('#map_data').val());						
				mapdata.coordinates = myMap.getCenter(),
				mapdata.zoom = myMap.getZoom(),
				mapdata.type = myMap.getType(),
				datajson = JSON.stringify(mapdata);
				jQuery('#map_data').val(datajson);
			});
		myMap.controls.add('typeSelector').add('smallZoomControl', { right: 5, top: 75 });
		jQuery('#controls button').bind('click',function(){
			  var buttn = jQuery(this);
			  var buttnvl = jQuery(this).val();
			  var mapdata = jQuery.evalJSON(jQuery('#map_data').val());
			  if (!buttn.hasClass('btn-success')) {
				  buttn.addClass('btn-success');
				  if (buttnvl == 'typeSelector')  mapdata.typeSelector = true;
				  if (buttnvl == 'mapTools') mapdata.mapTools = true;
				  if (buttnvl == 'zoomControl') mapdata.zoomControl = true;
				  if (buttnvl == 'smallZoomControl') mapdata.smallZoomControl = true;
				  if (buttnvl == 'trafficControl') {
					  mapdata.trafficControl = true;
				  } 
				  else
				  myMap.controls.add(buttnvl);
				  			
			  }
			  else {
				  buttn.removeClass('btn-success');
				  if (buttnvl == 'typeSelector') mapdata.typeSelector = false;
				  if (buttnvl == 'mapTools') mapdata.mapTools = false;
				  if (buttnvl == 'zoomControl') mapdata.zoomControl = false;
				  if (buttnvl == 'smallZoomControl') mapdata.smallZoomControl = false;
				  if (buttnvl == 'trafficControl') {
					  mapdata.trafficControl = false;
				  }
				  else 
				  myMap.controls.remove(buttnvl);		  
			  }
			  datajson = JSON.stringify(mapdata);
				  jQuery('#map_data').val(datajson);
			  return false;
		  });
		 jQuery('#hidemap').bind('click',function(){
			 if (jQuery(this).hasClass('btn-warning')) {
				 jQuery('#constructor').removeClass('json-edit'); 
				 jQuery(this).removeClass('btn-warning');
			 }
			 else {
				 jQuery('#constructor').addClass('json-edit'); 
				 jQuery(this).addClass('btn-warning');
			 }
			 return false;
		 });
		 
	     myMap.geoObjects.events.add('contextmenu', function (e) {
                e.get('domEvent').callMethod('preventDefault');
                if (jQuery('#add-placemark').css('display') == 'block') {
                    jQuery('#add-placemark').remove();
                } else {
                    // HTML-содержимое контекстного меню.
                    var menuContent =
                        '<div id="add-placemark">\
                             <ul id="menu_list">\
                                 <li>Название: <br /> <input type="text" name="icon_text" /></li>\
                                 <li>Подсказка: <br /> <input type="text" name="hint_text" /></li>\
                                 <li>Балун: <br /> <textarea  name="balloon_text"></textarea></li>\
								 <li>Стиль: <select name="icon_style">\
								 <optgroup label="Растягиваемые">\
								 <option value="twirl#lightblueStretchyIcon">twirl#lightblueStretchyIcon</option>\
					<option value="twirl#whiteStretchyIcon">twirl#whiteStretchyIcon</option>\
					<option value="twirl#greenStretchyIcon">twirl#greenStretchyIcon</option>\
					<option value="twirl#redStretchyIcon">twirl#redStretchyIcon</option>\
					<option value="twirl#yellowStretchyIcon">twirl#yellowStretchyIcon</option>\
					<option value="twirl#nightStretchyIcon">twirl#nightStretchyIcon</option>\
					<option value="twirl#greyStretchyIcon">twirl#greyStretchyIcon</option>\
					<option value="twirl#darkblueStretchyIcon">twirl#darkblueStretchyIcon</option>\
					<option value="twirl#blueStretchyIcon">twirl#blueStretchyIcon</option>\
					<option value="twirl#orangeStretchyIcon">twirl#orangeStretchyIcon</option>\
					<option value="twirl#darkorangeStretchyIcon">twirl#darkorangeStretchyIcon</option>\
					<option value="twirl#pinkStretchyIcon">twirl#pinkStretchyIcon</option>\
					<option value="twirl#violetStretchyIcon">twirl#violetStretchyIcon</option>\
					</optgroup>\
					<optgroup label="Цветные круглые">\
					<option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/blue.png" value="twirl#blueIcon">twirl#blueIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/darkblue.png" value="twirl#darkblueIcon">twirl#darkblueIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/darkgreen.png" value="twirl#darkgreenIcon">twirl#darkgreenIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/darkorange.png" value="twirl#darkorangeIcon">twirl#darkorangeIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/green.png" value="twirl#greenIcon">twirl#greenIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/grey.png" value="twirl#greyIcon">twirl#greyIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/lightblue.png" value="twirl#lightblueIcon">twirl#lightblueIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/night.png" value="twirl#nightIcon">twirl#nightIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/orange.png" value="twirl#orangeIcon">twirl#orangeIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/pink.png" value="twirl#pinkIcon">twirl#pinkIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/red.png" value="twirl#redIcon">twirl#redIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/violet.png" value="twirl#violetIcon">twirl#violetIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/white.png" value="twirl#whiteIcon">twirl#whiteIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/yellow.png" value="twirl#yellowIcon">twirl#yellowIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/brown.png" value="twirl#brownIcon">twirl#brownIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/black.png" value="twirl#blackIcon">twirl#blackIcon</option>\
					</optgroup>\
					<optgroup label="Тематические">\
					<option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/airplane.png" value="twirl#airplaneIcon">twirl#airplaneIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/anchor.png" value="twirl#anchorIcon">twirl#anchorIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/badminton.png" value="twirl#badmintonIcon">twirl#badmintonIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/bank.png" value="twirl#bankIcon">twirl#bankIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/bar.png" value="twirl#barIcon">twirl#barIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/barberShop.png" value="twirl#barberShopIcon">twirl#barberShopIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/bicycle.png" value="twirl#bicycleIcon">twirl#bicycleIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/bowling.png" value="twirl#bowlingIcon">twirl#bowlingIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/buildings.png" value="twirl#buildingsIcon">twirl#buildingsIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/bus.png" value="twirl#busIcon">twirl#busIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/cafe.png" value="twirl#cafeIcon">twirl#cafeIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/camping.png" value="twirl#campingIcon">twirl#campingIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/car.png" value="twirl#carIcon">twirl#carIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/cellular.png" value="twirl#cellularIcon">twirl#cellularIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/cinema.png" value="twirl#cinemaIcon">twirl#cinemaIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/downhillSkiing.png" value="twirl#downhillSkiingIcon">twirl#downhillSkiingIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/dps.png" value="twirl#dpsIcon">twirl#dpsIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/dryCleaner.png" value="twirl#dryCleanerIcon">twirl#dryCleanerIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/electricTrain.png" value="twirl#electricTrainIcon">twirl#electricTrainIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/factory.png" value="twirl#factoryIcon">twirl#factoryIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/theater.png" value="twirl#theaterIcon">twirl#theaterIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/fishing.png" value="twirl#fishingIcon">twirl#fishingIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/gasStation.png" value="twirl#gasStationIcon">twirl#gasStationIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/gym.png" value="twirl#gymIcon">twirl#gymIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/hospital.png" value="twirl#hospitalIcon">twirl#hospitalIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/house.png" value="twirl#houseIcon">twirl#houseIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/keyMaster.png" value="twirl#keyMasterIcon">twirl#keyMasterIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/mailPost.png" value="twirl#mailPostIcon">twirl#mailPostIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/metroKiev.png" value="twirl#metroKievIcon">twirl#metroKievIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/metroMoscow.png" value="twirl#metroMoscowIcon">twirl#metroMoscowIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/metroStPetersburg.png" value="twirl#metroStPetersburgIcon">twirl#metroStPetersburgIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/metroYekaterinburg.png" value="twirl#metroYekaterinburgIcon">twirl#metroYekaterinburgIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/motobike.png" value="twirl#motobikeIcon">twirl#motobikeIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/mushroom.png" value="twirl#mushroomIcon">twirl#mushroomIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/phone.png" value="twirl#phoneIcon">twirl#phoneIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/photographer.png" value="twirl#photographerIcon">twirl#photographerIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/pingPong.png" value="twirl#pingPongIcon">twirl#pingPongIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/restauraunt.png" value="twirl#restaurauntIcon">twirl#restaurauntIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/ship.png" value="twirl#shipIcon">twirl#shipIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/shop.png" value="twirl#shopIcon">twirl#shopIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/skating.png" value="twirl#skatingIcon">twirl#skatingIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/stadium.png" value="twirl#stadiumIcon">twirl#stadiumIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/skiing.png" value="twirl#skiingIcon">twirl#skiingIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/smartphone.png" value="twirl#smartphoneIcon">twirl#smartphoneIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/workshop.png" value="twirl#workshopIcon">twirl#workshopIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/storehouse.png" value="twirl#storehouseIcon">twirl#storehouseIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/swimming.png" value="twirl#swimmingIcon">twirl#swimmingIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/tailorShop.png" value="twirl#tailorShopIcon">twirl#tailorShopIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/tennis.png" value="twirl#tennisIcon">twirl#tennisIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/tire.png" value="twirl#tireIcon">twirl#tireIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/truck.png" value="twirl#truckIcon">twirl#truckIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/train.png" value="twirl#trainIcon">twirl#trainIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/tramway.png" value="twirl#tramwayIcon">twirl#tramwayIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/trolleybus.png" value="twirl#trolleybusIcon">twirl#trolleybusIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/wifi.png" value="twirl#wifiIcon">twirl#wifiIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/wifiLogo.png" value="twirl#wifiLogoIcon">twirl#wifiLogoIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/turnLeft.png" value="twirl#turnLeftIcon">twirl#turnLeftIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/turnRight.png" value="twirl#turnRightIcon">twirl#turnRightIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/arrowDownLeft.png" value="twirl#arrowDownLeftIcon">twirl#arrowDownLeftIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/arrowDownRight.png" value="twirl#arrowDownRightIcon">twirl#arrowDownRightIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/arrowLeft.png" value="twirl#arrowLeftIcon">twirl#arrowLeftIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/arrowRight.png" value="twirl#arrowRightIcon">twirl#arrowRightIcon</option><option data-path="http://api.yandex.ru/maps/doc/jsapi/2.x/ref/images/styles/arrowUp.png" value="twirl#arrowUpIcon">twirl#arrowUpIcon</option></optgroup>\</select></li>\
                             </ul>\
                         <div align="center"><input type="submit" value="Сохранить" /><br/><a href="#" class="del">Удалить</a></div>\
                         </div>';
						 
                    jQuery('#constructor').append(menuContent);


                    jQuery('#add-placemark ul').css({
                        'list-style-type': 'none',
                        padding: 0,
                        margin: 0
                    });

                    jQuery('#add-placemark input[name="icon_text"]').val(e.get('target').properties.get('iconContent'));
                    jQuery('#add-placemark input[name="hint_text"]').val(e.get('target').properties.get('hintContent'));
                    jQuery('#add-placemark textarea[name="balloon_text"]').val(e.get('target').properties.get('balloonContent'));
					jQuery('#add-placemark select[name="icon_style"]').val(e.get('target').options.get('preset'));


					
					
                    jQuery('#add-placemark input[type="submit"]').click(function () {
						var iconText = jQuery('#add-placemark input[name="icon_text"]').val(),
                            hintText = jQuery('#add-placemark input[name="hint_text"]').val(),
                            balloonText = jQuery('#add-placemark textarea[name="balloon_text"]').val();
                        e.get('target').properties.set({
                            iconContent: iconText,
                            hintContent: hintText,
                            balloonContent: balloonText
                        });

						var mapdata = jQuery.evalJSON(jQuery('#map_data').val()),
						md = {}, mark = 0;
						myMap.geoObjects.each(function (item) { 
						md['placemark'+mark] = { 'preset' : item.options.get('preset'),
						'iconContent': item.properties.get('iconContent'),
						'hintContent': item.properties.get('hintContent'),
						'balloonContent': item.properties.get('balloonContent'),
						'coordinates': item.geometry.getCoordinates()}
							
							mark = mark +1;
						});
						mapdata.placemarks = md;
						djson = JSON.stringify(mapdata);
						jQuery('#map_data').val(djson);
						
						jQuery('#add-placemark').remove();
                    });
					
					jQuery('#add-placemark select[name="icon_style"]').click(function(){
						var iconStyle = jQuery('#add-placemark select[name="icon_style"]').val();
						e.get('target').options.set({preset:iconStyle});
						jQuery("#jform_params_iconstyle").val(iconStyle)
					});	
					
					jQuery('#add-placemark a.del').click(function () {
						myMap.geoObjects.remove(e.get('target'));
						jQuery('#add-placemark').remove();
						var mapdata = jQuery.evalJSON(jQuery('#map_data').val()),
						md = {}, mark = 0;
						myMap.geoObjects.each(function (item) { 
						md['placemark'+mark] = { 'preset' : item.options.get('preset'),
						'iconContent': item.properties.get('iconContent'),
						'hintContent': item.properties.get('hintContent'),
						'balloonContent': item.properties.get('balloonContent'),
						'coordinates': item.geometry.getCoordinates()}
							
							mark = mark +1;
						});
						mapdata.placemarks = md;
						djson = JSON.stringify(mapdata);
						jQuery('#map_data').val(djson);
						return false;
					});
                }
            });
			myMap.geoObjects.events.add("dragend", function (e) {
              coords = e.get('target').geometry.getCoordinates()
			  var mapdata = jQuery.evalJSON(jQuery('#map_data').val()),
						md = {}, mark = 0;
						myMap.geoObjects.each(function (item) { 
						md['placemark'+mark] = { 'preset' : item.options.get('preset'),
						'iconContent': item.properties.get('iconContent'),
						'hintContent': item.properties.get('hintContent'),
						'balloonContent': item.properties.get('balloonContent'),
						'coordinates': item.geometry.getCoordinates()}
							
							mark = mark +1;
						});
						mapdata.placemarks = md;
						djson = JSON.stringify(mapdata);
						jQuery('#map_data').val(djson);
						
						jQuery('#add-placemark').remove();
			});
		
		 
		////dfdfdf
		 jQuery('#placemark').on('click',function(){
			 myMap.geoObjects.add(new ymaps.Placemark(myMap.getCenter(), 
				{iconContent: 'Метка', hintContent: 'Щелкни по мне правой кнопкой мыши!', balloonContent: ''}, 
				{preset:'twirl#redStretchyIcon', draggable: true}
			  ));
			////  
			  
			 return false;		 
					
		 });
		 
		 
	};
	jQuery(document).ready(function(){
		ymaps.ready(init);
	;});
})(jQuery);