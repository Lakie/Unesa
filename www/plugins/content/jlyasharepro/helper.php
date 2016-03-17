<?php
/**
 * jlyasharepro
 *
 * @version 1.0
 * @author Arkadiy Sedelnikov
 * @copyright (C) 2014 Arkadiy Sedelnikov (http://www.joomline.ru)
* @license GNU/GPL license: http://www.gnu.org/copyleft/gpl.html 
 **/
jimport('joomla.plugin.plugin');

class PlgJLYaShareProHelper
{
    var $params = null;

    protected static $instance = null;

    private
    $link,
    $title,
    $desc,
    $image,
    $quickServices,
    $theme,
    $lang,
    $type;

    function ShowIn()
    {
		/*
		http://share42.com/ru
		
data-url 			ссылка на страницу 						<div class="share42init" data-url="http://site.name/page-title/">
data-title 			заголовок страницы 						<div class="share42init" data-title="Заголовок страницы">
data-image 			ссылка на изображение 					<div class="share42init" data-image="http://site.name/image.jpg">
data-description 	описание к странице 					<div class="share42init" data-description="Описание страницы">
data-path 			путь к папке с файлом иконок icons.png	<div class="share42init" data-path="http://site.name/share42/">
data-icons-file 	имя файла с иконками 					<div class="share42init" data-icons-file="my-icons.png">
data-zero-counter 	1 - показывать нулевой счетчик, 0 - не показывать нулевой счетчик 	<div class="share42init" data-zero-counter="1">
		
        $scriptPage = <<<HTML
			<script type="text/javascript" src="/plugins/content/jlyasharepro/share42/share42.js"></script>
			<div class="jlYaSharesContayner">
				<div class="share42init"
					data-zero-counter="0"
					data-url="{$this->link}"
					data-title="{$this->title}"
					data-description="{$this->desc}"
					data-image="{$this->image}"
				></div>
			</div>
HTML;
*/
        $scriptPage = <<<HTML
		    <script async="async" type="text/javascript" src="//yastatic.net/share/share.js"></script>
			<div class="jlYaSharesContayner">
		        <div
				    class="yashare-auto-init"
				    data-yashareLink="{$this->link}"
				    data-yashareTitle="{$this->title}"
				    data-yashareDescription="{$this->desc}"
				    data-yashareImage="{$this->image}"
				    data-yashareQuickServices="{$this->quickServices}"
				    data-yashareTheme="{$this->theme}"
				    data-yashareType="{$this->type}"
				    data-yashareL10n="{$this->lang}"
				    ></div>
			</div>
HTML;

        return $scriptPage;
    }

    function __construct($params = null)
    {
        $this->params = $params;
        $this->lang = $this->getLang();
        $providers = $this->params->get('providers', array());
        $this->quickServices = !empty($providers) ? implode(',', $providers) : 'yaru,vkontakte,facebook,twitter,odnoklassniki,moimir,gplus';
        $this->theme = $this->params->get('theme', 'counter');
        $this->type = $this->params->get('type', 'small');
    }

    function cleanText($text)
    {
        $desc = strip_tags($text);
        $words = explode(' ', $desc);
        $words = array_slice($words, 0, 20);
        $words = JString::trim(implode(' ', $words));
        $desc = JString::str_ireplace('"', '\'', $words);
        return $desc;
    }
    /**
    az - азербайджанский;
    be - белорусский;
    en - английский;
    hy - армянский;
    fr - французский;
    ka - грузинский;
    kk - казахский;
    ro - румынский;
    ru - русский;
    tr - турецкий;
    tt - татарский;
    uk - украинский.
     */
    private function getLang()
    {
        $langs = array( 'az', 'be', 'en', 'hy', 'fr', 'ka', 'kk', 'ro', 'ru', 'tr', 'tt', 'uk' );
        $lang = substr(JFactory::getLanguage()->getTag(), 0, 2);
        $lang = (in_array($lang, $langs)) ? $lang : 'ru';
        return $lang;
    }

    public static function getInstance($params = null, $folder = 'content', $plugin = 'jlyasharepro')
    {
        if (self::$instance === null) {
            if (!$params) {
                $params = self::getPluginParams($folder, $plugin);
            }
            self::$instance = new PlgJLYaShareProHelper($params);
        }

        return self::$instance;
    }

    private static function getPluginParams($folder = 'content', $name = 'jlyasharepro')
    {
        $plugin = JPluginHelper::getPlugin($folder, $name);

        if (!$plugin)
        {
            throw new RuntimeException(JText::_('JLLIKEPRO_PLUGIN_NOT_FOUND'));
        }

        $params = new JRegistry($plugin->params);

        return $params;
    }

    public function set($var, $val)
    {
        $this->$var = $val;
    }

    public static function breadcrumbs()
    {

        $mainframe = JFactory::getApplication();
        $array = array();
        $view = JRequest::getCmd('view');
        $id = JRequest::getInt('id');
        $option = JRequest::getCmd('option');
        $task = JRequest::getCmd('task');

        $db = JFactory::getDBO();
        $user = JFactory::getUser();
        $aid = (int)$user->get('aid');

        if ($option == 'com_k2')
        {

            switch ($view)
            {

                case 'item' :
                        $languageCheck = '';
                        if ($mainframe->getLanguageFilter())
                        {
                            $languageTag = JFactory::getLanguage()->getTag();
                            $languageCheck = " AND language IN (".$db->Quote($languageTag).", ".$db->Quote('*').") ";
                        }
                        $query = "SELECT * FROM #__k2_items  WHERE id={$id} AND published=1 AND trash=0 AND access IN(".implode(',', $user->getAuthorisedViewLevels()).") {$languageCheck} AND EXISTS (SELECT * FROM #__k2_categories WHERE #__k2_categories.id= #__k2_items.catid AND published=1 AND access IN(".implode(',', $user->getAuthorisedViewLevels()).")  {$languageCheck} )";

                    $db->setQuery($query);
                    $row = $db->loadObject();
                    if ($db->getErrorNum())
                    {
                        echo $db->stderr();
                        return false;
                    }
                    $title = $row->title;
                    $path = PlgJLYaShareProHelper::getK2CategoryPath($row->catid);

                    break;

                case 'itemlist' :
                    if ($task == 'category')
                    {

                        $query = "SELECT * FROM #__k2_categories  WHERE id={$id} AND published=1 AND trash=0 ";

                            $query .= " AND access IN(".implode(',', $user->getAuthorisedViewLevels()).") ";
                            if ($mainframe->getLanguageFilter())
                            {
                                $languageTag = JFactory::getLanguage()->getTag();
                                $query .= " AND language IN (".$db->Quote($languageTag).", ".$db->Quote('*').") ";
                            }

                        $db->setQuery($query);
                        $row = $db->loadObject();
                        if ($db->getErrorNum())
                        {
                            echo $db->stderr();
                            return false;
                        }
                        $title = $row->name;
                        $path = PlgJLYaShareProHelper::getK2CategoryPath($row->parent);

                    }
                    else
                    {
                        $document = JFactory::getDocument();
                        $title = $document->getTitle();
                        $path = PlgJLYaShareProHelper::getSitePath();
                    }
                    break;

                case 'latest' :
                    $document = JFactory::getDocument();
                    $title = $document->getTitle();
                    $path = PlgJLYaShareProHelper::getSitePath();
                    break;
            }

        }
        else
        {
            $document = JFactory::getDocument();
            $title = $document->getTitle();
            $path = PlgJLYaShareProHelper::getSitePath();
        }

        return array(
            $path,
            $title
        );
    }

    public static function getSitePath()
    {

        $mainframe = JFactory::getApplication();
        $pathway = $mainframe->getPathway();
        $items = $pathway->getPathway();
        $count = count($items);
        $path = array();
        for ($i = 0; $i < $count; $i++)
        {
            if (!empty($items[$i]->link))
            {
                $items[$i]->name = stripslashes(htmlspecialchars($items[$i]->name, ENT_QUOTES, 'UTF-8'));
                $items[$i]->link = JRoute::_($items[$i]->link);
                array_push($path, "<a href='".JRoute::_($items[$i]->link)."'>".$items[$i]->name."</a>");
            }

        }
        return $path;

    }

    public static function getK2CategoryPath($catid)
    {

        static $array = array();
        $mainframe = JFactory::getApplication();
        $user = JFactory::getUser();
        $aid = (int)$user->get('aid');
        $catid = (int)$catid;
        $db = JFactory::getDBO();
        $query = "SELECT * FROM #__k2_categories WHERE id={$catid} AND published=1 AND trash=0 ";

        if (K2_JVERSION != '15')
        {
            $query .= " AND access IN(".implode(',', $user->getAuthorisedViewLevels()).") ";
            if ($mainframe->getLanguageFilter())
            {
                $languageTag = JFactory::getLanguage()->getTag();
                $query .= " AND language IN (".$db->Quote($languageTag).", ".$db->Quote('*').") ";
            }
        }
        else
        {
            $query .= " AND access <= {$aid}";
        }

        $db->setQuery($query);
        $rows = $db->loadObjectList();
        if ($db->getErrorNum())
        {
            echo $db->stderr();
            return false;
        }

        foreach ($rows as $row)
        {
            array_push($array, "<a href='".urldecode(JRoute::_(K2HelperRoute::getCategoryRoute($row->id.":".urlencode($row->alias))))."'>".$row->name."</a>");
            PlgJLYaShareProHelper::getK2CategoryPath($row->parent);
        }

        return array_reverse($array);
    }


}