<?php
/*******************************************************************************************/
/*
/*        Web: http://www.asdesigning.com
/*        Web: http://www.astemplates.com
/*        License: GNU/GPL
/*
/*******************************************************************************************/


defined('_JEXEC') or die;

require_once JPATH_SITE.'/components/com_content/helpers/route.php';
JModelLegacy::addIncludePath(JPATH_SITE.'/components/com_content/models', 'ContentModel');

abstract class modArtSliderHelper
{
	public static function getList(&$params)
	{
		$app	= JFactory::getApplication();
		$db		= JFactory::getDbo();

		$model = JModelLegacy::getInstance('Articles', 'ContentModel', array('ignore_request' => true));

		$appParams = JFactory::getApplication()->getParams();
		$model->setState('params', $appParams);

		$model->setState('list.start', 0);
		$model->setState('list.limit', (int) $params->get('articles_num', 3));

		$model->setState('filter.published', 1);

		$model->setState('list.select', 'a.fulltext, a.id, a.title, a.alias, a.introtext, a.state, a.catid, a.created, a.created_by, a.created_by_alias,' . ' a.modified, a.modified_by, a.publish_up, a.publish_down, a.images, a.urls, a.attribs, a.metadata, a.metakey, a.metadesc, a.access,' . ' a.hits, a.featured' );

		$access = !JComponentHelper::getParams('com_content')->get('show_noauth');
		$authorised = JAccess::getAuthorisedViewLevels(JFactory::getUser()->get('id'));
		$model->setState('filter.access', $access);

		$model->setState('filter.category_id', $params->get('category_id', array()));

		$model->setState('filter.language', $app->getLanguageFilter());

		$ordering = $params->get('ordering', 'a.publish_up');
		$model->setState('list.ordering', $ordering);
		if (trim($ordering) == 'rand()') {
			$model->setState('list.direction', '');
		} else {
			$model->setState('list.direction', 'DESC');
		}

		$items = $model->getItems();

		foreach ($items as &$item) {
			$item->readmore = strlen(trim($item->fulltext));
			$item->slug = $item->id.':'.$item->alias;
			$item->catslug = $item->catid.':'.$item->category_alias;

			if ($access || in_array($item->access, $authorised))
			{
				$item->link = JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catid));
				$item->linkText = JText::_('Read more');
			}
			else {
				$item->link = JRoute::_('index.php?option=com_users&view=login');
				$item->linkText = JText::_('Register to Read More');
			}

			$item->introtext = JHtml::_('content.prepare', $item->introtext, '', 'mod_as_artslider.content');

			if (!$params->get('show_image')) {
				$item->introtext = preg_replace('/<img[^>]*>/', '', $item->introtext);
			}

			$results = $app->triggerEvent('onContentAfterDisplay', array('com_content.article', &$item, &$params, 1));
			$item->afterDisplayTitle = trim(implode("\n", $results));

			$results = $app->triggerEvent('onContentBeforeDisplay', array('com_content.article', &$item, &$params, 1));
			$item->beforeDisplayContent = trim(implode("\n", $results));
		}

		return $items;
	}
}
