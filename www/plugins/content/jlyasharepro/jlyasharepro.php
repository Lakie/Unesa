<?php Header("Content-Type: application/x-javascript; charset=UTF-8"); ?>
<?php
/**
 * jlyasharepro
 *
 * @version 1.0
 * @author Arkadiy Sedelnikov
 * @copyright (C) 2014 Arkadiy Sedelnikov (http://www.joomline.ru)
* @license GNU/GPL license: http://www.gnu.org/copyleft/gpl.html 
 **/

// no direct access
defined('_JEXEC') or die;

jimport('joomla.plugin.plugin');

require_once JPATH_ROOT.'/plugins/content/jlyasharepro/helper.php';

class plgContentJlyasharepro extends JPlugin
{
    public function onContentPrepare($context, &$article, &$params, $page = 0)
    {

        $allowContext = array(
            'com_content.article',
            'com_k2.item',
            'easyblog.blog',
            'com_virtuemart.productdetails'
        );

        $allow_in_category = $this->params->get('allow_in_category', 0);

        if($allow_in_category)
        {
            $allowContext[] = 'com_content.category';
        }


        if(!in_array($context, $allowContext)){
            return true;
        }

        if (strpos($article->text, '{jlyasharepro-off}') !== false) {
            $article->text = str_replace("{jlyasharepro-off}", "", $article->text);
            return true;
        }

        $autoAdd = $this->params->get('autoAdd',0);
        $sharePos = (int)$this->params->get('shares_position', 1);
        $option = JRequest::getCmd('option');
        $helper = PlgJLYaShareProHelper::getInstance($this->params);

        if (strpos($article->text, '{jlyasharepro}') === false && !$autoAdd)
        {
            return true;
        }

        if (!isset($article->catid))
        {
            $article->catid = '';
        }

        //JFactory::getDocument()->addScript('//yastatic.net/share/share.js', 'text/javascript', false, true);
        $style="div.socialButtonShare {margin: -40px 3% 0 0 !important; transform: scale(1) !important;}";
		JFactory::getDocument()->addStyleDeclaration($style);

        $url = 'http://' . $this->params->get('pathbase', '') . str_replace('www.', '', $_SERVER['HTTP_HOST']);


        $print = JRequest::getCmd('print');

        switch ($option) {
            case 'com_content':

                if(!$article->id){
                    //если категория, то завершаем
                    return true;
                }

                include_once JPATH_ROOT.'/components/com_content/helpers/route.php';

                if ($context == 'com_content.article')
                {
                    If (!$print)
                    {
                        $cat = $this->params->get('categories', array());
                        $exceptcat = is_array($cat) ? $cat : array($cat);
                        if (!in_array($article->catid, $exceptcat))
                        {
                            $view = JRequest::getCmd('view');
                            if ($view == 'article')
                            {
                                if ($autoAdd == 1 || strpos($article->text, '{jlyasharepro}') == true)
                                {
                                    $images = json_decode($article->images);

                                    if(!empty($images->image_intro))
                                    {
                                        $image = $url . '/' . stripslashes($images->image_intro);
                                    }
                                    else if(!empty($images->image_fulltext))
                                    {
                                        $image = $url . '/' . stripslashes($images->image_fulltext);
                                    }
                                    else
                                    {
                                        $image = '';
                                    }

                                    $desc = $helper->cleanText($article->text);

                                    $helper->set('link', $url . JRoute::_(ContentHelperRoute::getArticleRoute($article->slug, $article->catid)));
                                    $helper->set('title', $article->title);
                                    $helper->set('desc', $desc);
                                    $helper->set('image', $image);

                                    $shares = $helper->ShowIN();

                                    switch($sharePos){
                                        case 0:
                                            $article->text = $shares . str_replace("{jlyasharepro}", "", $article->text);
                                            break;
                                        default:
                                            $article->text = str_replace("{jlyasharepro}", "", $article->text) . $shares;
                                            break;
                                    }
                                }
                            }
                        }
                        else
                        {
                            $article->text = str_replace("{jlyasharepro}", "", $article->text);
                        }
                    }
                }
                else if ($context == 'com_content.category')
                {
                    If (!$print)
                    {
                        $cat = $this->params->get('categories', array());
                        $exceptcat = is_array($cat) ? $cat : array($cat);
                        if (!in_array($article->catid, $exceptcat))
                        {
                            if ($autoAdd == 1 || strpos($article->text, '{jlyasharepro}') == true)
                            {
                                $images = json_decode($article->images);

                                if(!empty($images->image_intro))
                                {
                                    $image = $url . '/' . stripslashes($images->image_intro);
                                }
                                else if(!empty($images->image_fulltext))
                                {
                                    $image = $url . '/' . stripslashes($images->image_fulltext);
                                }
                                else
                                {
                                    $image = '';
                                }

                                $desc = $helper->cleanText($article->text);

                                $helper->set('link', $url . JRoute::_(ContentHelperRoute::getArticleRoute($article->slug, $article->catid)));
                                $helper->set('title', $article->title);
                                $helper->set('desc', $desc);
                                $helper->set('image', $image);
                                $shares = $helper->ShowIN();

                                $article->text = str_replace("{jlyasharepro}", "", $article->text) . $shares;
                            }
                        }
                        else
                        {
                            $article->text = str_replace("{jlyasharepro}", "", $article->text);
                        }
                    }
                }
                break;
            case 'com_k2':
                $doc =& JFactory::getDocument();
                $app    = JFactory::getApplication();

                $show = $this->params->get('k2After', 0);
                if ($context == 'com_k2.item' && $show)
                {
                    $k2categories = $this->params->get('k2categories', array());
                    $k2categories = (is_array($k2categories)) ? $k2categories : array();

                    if(in_array($article->catid, $k2categories))
                    {
                        break;
                    }

                    $showIntro = (!empty($article->params)) ? $article->params->get('itemIntroText', 1) : 1;
                    $showFull  = (!empty($article->params)) ? $article->params->get('itemFullText', 1)  : 1;

                    if(!empty($article->imageXLarge))
                    {
                        $image = $url . '/' . stripslashes($article->imageXLarge);
                    }
                    else
                    {
                        $image = '';
                    }

                    $fromEmail = $app->getCfg('mailfrom');
                    $fromName = $app->getCfg('fromname');
                    $siteName = $app->getCfg('sitename');

                    $title = "«".$article->title."» sur ".$siteName." (".$_SERVER['SERVER_NAME'].")";
                    $breadcrumbs = PlgJLYaShareProHelper::breadcrumbs();
                    if(isset($breadcrumbs[0]) && count($breadcrumbs[0])){
                        $description = $helper->cleanText($siteName.' > '.(implode(' > ', $breadcrumbs[0])));
                    }else {
                        $description = '';
                    }
                    if(!$doc->getMetaData('twitter:title')) {
                        $doc->setMetaData('twitter:title', $title);
                    }
                    if(!$doc->getMetaData('twitter:card')) {
                        $doc->setMetaData('twitter:card', 'summary');
                    }
                    if(!$doc->getMetaData('twitter:site')) {
                        $doc->setMetaData('twitter:site', '@'.str_replace(' ', '', $siteName));
                    }
                    if(!$doc->getMetaData('twitter:creator')) {
                        $doc->setMetaData('twitter:creator', '@'.str_replace(' ', '', $fromName));
                    }
                    if(!$doc->getMetaData('twitter:url')) {
                        $doc->setMetaData('twitter:url', JURI::current());
                    }
                    if(!$doc->getMetaData('twitter:description')) {
                        $doc->setMetaData('twitter:description', $description);
                    }
                    if(!$doc->getMetaData('twitter:image')) {
                        $doc->setMetaData('twitter:image', $image);
                    }
                    if(!$doc->getMetaData('og:title')) {
                        $doc->setMetaData('og:title', $title);
                    }
                    if(!$doc->getMetaData('og:type')) {
                        $doc->setMetaData('og:type', 'article');
                    }
                    if(!$doc->getMetaData('og:url')) {
                        $doc->setMetaData('og:url', JURI::current());
                    }
                    if(!$doc->getMetaData('og:image')) {
                        $doc->setMetaData('og:image', $image);
                    }
                    if(!$doc->getMetaData('og:site_name')) {
                        $doc->setMetaData('og:site_name', $siteName);
                    }
                    if(!$doc->getMetaData('og:description')) {
                        $doc->setMetaData('og:description', $description);
                    }
                    if(!$doc->getMetaData('og:email')) {
                        $doc->setMetaData('og:email', $fromEmail);
                    }

/*
                    if($showIntro)
                    {
                        $desc = $helper->cleanText($article->introtext);
                    }
                    else
                    {
                        $desc = $helper->cleanText($article->fulltext);
                    }
*/
                    $helper->set('link', JURI::current());
                    $helper->set('title', $title);
                    $helper->set('desc', $description);
                    $helper->set('image', $image);

                    $shares = $helper->ShowIN();

                    if($print)
                    {
                        $show = 0;
                    }
                    $article->shares = $shares;
                    $article->showShares = $show;
                    switch($show){
                        case 1:
                            if($showFull && $showIntro)
                            {
                                $article->introtext = $shares . str_replace("{jlyasharepro}", "", $article->introtext);
                                $article->fulltext  = str_replace("{jlyasharepro}", "", $article->fulltext);
                            }
                            else if(!$showFull && $showIntro)
                            {
                                $article->introtext = $shares . str_replace("{jlyasharepro}", "", $article->introtext);
                            }
                            else
                            {
                                $article->fulltext  = $shares . str_replace("{jlyasharepro}", "", $article->fulltext);
                            }
                            break;
                        case 2:
                            if(!defined('JLLICKEPRO_K2_REPLACED')){
                                define('JLLICKEPRO_K2_REPLACED', '1');
                                if($showFull && $showIntro)
                                {
                                    $article->introtext = str_replace("{jlyasharepro}", "", $article->introtext);
                                    $article->fulltext  = str_replace("{jlyasharepro}", "", $article->fulltext) . $shares;
                                }
                                else if(!$showFull && $showIntro)
                                {
                                    $article->introtext = str_replace("{jlyasharepro}", "", $article->introtext) . $shares;
                                }
                                else
                                {
                                    //$article->fulltext  = str_replace("{jlyasharepro}", "", $article->fulltext) . $shares;
                                    $article->fulltext  = str_replace("{jlyasharepro}", "", $article->fulltext);
                                }
                            }
                            break;
                        default:
                            if($showIntro)
                            {
                                $article->introtext = str_replace("{jlyasharepro}", "", $article->introtext);
                            }
                            $article->fulltext  = str_replace("{jlyasharepro}", "", $article->fulltext);
                            break;
                    }
                }
                break;
            case 'com_virtuemart':
                if ($context == 'com_virtuemart.productdetails') {
                    $VirtueShow = $this->params->get('virtcontent', 1);
                    if ($VirtueShow == 1)
                    {
                        $autoAddvm = $this->params->get('autoAddvm', 0);
                        if ($autoAddvm == 1 || strpos($article->text, '{jlyasharepro}') !== false)
                        {
                            $db = JFactory::getDbo();
                            $q = $db->getQuery(true);
                            $q->select('vm.file_url')
                                ->from('#__virtuemart_medias as vm')
                                ->innerJoin('#__virtuemart_product_medias as vpm ON vpm.virtuemart_media_id = vm.virtuemart_media_id')
                                ->where('vpm.virtuemart_product_id = '.(int)$article->virtuemart_product_id)
                                ->where('vm.file_is_downloadable = 0')
                                ->where('vm.file_is_forSale = 0')
                                ->where('vm.published = 1')
                            ;
                            $db->setQuery($q,0,1);
                            $image = $db->loadResult();

                            if(!empty($image))
                            {
                                $image = $url . '/' . $image;
                            }
                            else
                            {
                                $image = '';
                            }

                            $desc = $helper->cleanText($article->text);

                            $helper->set('link', JURI::current());
                            $helper->set('title', $article->product_name);
                            $helper->set('desc', $desc);
                            $helper->set('image', $image);

                            $shares = $helper->ShowIN();

                            switch($sharePos){
                                case 0:
                                    $article->text = $shares . str_replace("{jlyasharepro}", "", $article->text);
                                    break;
                                default:
                                    $article->text = str_replace("{jlyasharepro}", "", $article->text) . $shares;
                                    break;
                            }
                        }
                    }
                }
                break;
            case 'com_easyblog':
                if (($context == 'easyblog.blog') && ($this->params->get('easyblogshow', 0) == 1))
                {
                    if ($autoAdd == 1 || strpos($article->text, '{jlyasharepro}') == true)
                    {

                        $shares = $helper->ShowIN($article->id);
                        switch($sharePos){
                            case 0:
                                $article->text = $shares . str_replace("{jlyasharepro}", "", $article->text);
                                break;
                            default:
                                $article->text = str_replace("{jlyasharepro}", "", $article->text) . $shares;
                                break;
                        }
                    }
                }
                break;
            default:
                break;
        }
    }
}