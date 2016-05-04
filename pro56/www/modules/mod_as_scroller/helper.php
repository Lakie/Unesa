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
defined('_JEXEC') or die;

jimport('joomla.filesystem.file');

abstract class modASScrollerHelper
{
	public static function getImages(&$params, $folder)
	{
		$images	= array();
		$scroller_usesubs   	= $params->get('scroller_usesubs', 0);

		$scroller_randomizing   = $params->get('scroller_randomizing', 0);
		$scroller_direction 	= $params->get('scroller_direction', 'left');
		$scroller_imgspacing    = intval($params->get('scroller_imgspacing', 3));
		if ($scroller_imgspacing) :
			switch ( $scroller_direction ) {
				case 'left';
					$space = 'margin-right:'.$scroller_imgspacing.'px';
					break;
				case 'right';
					$space = 'margin-left:'.$scroller_imgspacing.'px';
					break;
			}
		endif;
		$scroller_imgwidth    	= $params->get('scroller_imgwidth');
		$scroller_imgheight   	= $params->get('scroller_imgheight');
		
		$scroller_urls     		= explode(',', $params->get('scroller_urls'));
		$scroller_urltarget    	= $params->get('scroller_urltarget', '_self');
		$scroller_urlrepeat   	= $params->get('scroller_urlrepeat', 0);
		
		

		if (is_dir(JPATH_BASE.DIRECTORY_SEPARATOR.$folder))  		// if directory exists
		{
			$files = modASScrollerHelper::getFiles($folder, $scroller_usesubs, $scroller_randomizing);
			$i = 0;
			$repeated = 0;
			foreach ($files as $file)
			{
				if (modASScrollerHelper::isImage($file)) 
				{
					$file	    = str_replace( '\\', '/', $file );
					$attribs    = array();
					if ($scroller_imgspacing) $attribs['style']  = $space;
					if ($scroller_imgwidth) $attribs['width'] = intval($scroller_imgwidth);
					if ($scroller_imgheight) $attribs['height'] = intval($scroller_imgheight);
					$images[$i] = JHTML::_('image', $file, '', $attribs);
					if ($scroller_urls && (isset($scroller_urls[$i]) or $scroller_urlrepeat)) :
						if (isset($scroller_urls[$i])) 
						{
							$images[$i] = JHTML::_('link', trim($scroller_urls[$i]), $images[$i], ($scroller_urltarget ? array('target' => '_blank') : '' ) );
						} 
						else 
						{
							$repeated++;
							$images[$i] = JHTML::_('link', trim($scroller_urls[$repeated-1]), $images[$i], ($scroller_urltarget ? array('target' => '_blank') : '' ) );
							if ($repeated == count($scroller_urls)) $repeated = 0 ;
						}
					endif;
					++$i;
				}
			}
		}

		return $images;
	}


	public static function getFolder(&$params)
	{
		$folder 	= $params->get('scroller_folder');
		
		// removing trailing slash from the url
		if (substr($folder, -1) == '/') 
		{
			$folder = substr($folder, 0 ,-1);
		}

		$site_baseurl 	= JURI::base();

		// if folder includes site info, remove it
		if ( JString::strpos($folder, $site_baseurl) === 0 ) 
		{
			$folder = str_replace( $site_baseurl, '', $folder );
		}
		
		// if folder includes absolute path, remove it
		if ( JString::strpos($folder, JPATH_SITE) === 0 ) 
		{
			$folder= str_replace( JPATH_BASE, '', $folder );
		}
		$folder = str_replace('\\',DIRECTORY_SEPARATOR, $folder);
		$folder = str_replace('/',DIRECTORY_SEPARATOR, $folder);

		return $folder;
	}
	
	
	public static function getFiles($folder, $scroller_usesubs, $scroller_randomizing) 
	{
	
		$dir      = JPATH_BASE.DIRECTORY_SEPARATOR.$folder;
			
		$files	  = array();
		$subfiles = array();
	
		if ($handle = opendir($dir)) 
		{
			while (false !== ($file = readdir($handle))) 
			{
				if ($file != '.' && $file != '..' && $file != 'CVS' && $file != 'index.html' ) 
				{
					if (!is_dir($dir . DIRECTORY_SEPARATOR . $file))
					{
						$files[] = $folder . DIRECTORY_SEPARATOR . $file;
					} elseif ($scroller_usesubs != 0) {
						$newfolder = $folder . DIRECTORY_SEPARATOR . $file;
						$subfiles[]  = modASScrollerHelper::getFiles($newfolder, $scroller_usesubs, $scroller_randomizing);
					}
				}
			}
		}
		closedir($handle);
		
		sort($files);
		
		foreach ($subfiles as $subfile) :
			$files = array_merge($files,$subfile);
		endforeach;
		
		if ($scroller_randomizing) :
			shuffle($files);
		endif;
		
		return $files;
	}
		
    public static function isImage($file) 
	{
		$file  = JFile::getName($file);
		$file  = JFile::getExt($file);
		$file  = strtolower($file);
        $types = array("jpg", "jpeg", "gif", "png");
        if (in_array($file, $types)) return true;
        else return false;
    }
}
