<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$app             = JFactory::getApplication();
$doc             = JFactory::getDocument();
$user            = JFactory::getUser();
$this->language  = $doc->language;
$this->direction = $doc->direction;

// Getting params from template
$params = $app->getTemplate(true)->params;

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->get('sitename');

// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/js/template.js');

// Add Stylesheets
$doc->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/css/template.css');

// Load optional RTL Bootstrap CSS
JHtml::_('bootstrap.loadCss', false, $this->direction);

// Adjusting content width
$style_both='';
$style_left='';
$style_right='';
if ($this->countModules('main-left') && $this->countModules('main-right'))
{
	$span = "span6";
	$style_both = ' style_both';
}
elseif ($this->countModules('main-left') && !$this->countModules('main-right'))
{
	$span = "span9";
	$style_left = ' style_left';
}
elseif (!$this->countModules('main-left') && $this->countModules('main-right'))
{
	$span = "span9";
	$style_right = ' style_right';
}
else
{
	$span = "span12";
}

// Logo file or site title param
if ($this->params->get('logoFile'))
{
	$logo = '<img src="' . JUri::root() . $this->params->get('logoFile') . '" alt="' . $sitename . '" />';
}
elseif ($this->params->get('sitetitle'))
{
	$logo = '<span class="site-title" title="' . $sitename . '">' . htmlspecialchars($this->params->get('sitetitle')) . '</span>';
}
else
{
	$logo = '<span class="site-title" title="' . $sitename . '">' . $sitename . '</span>';
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<jdoc:include type="head" />
	<!--[if lt IE 9]>
		<script src="<?php echo JUri::root(true); ?>/media/jui/js/html5.js"></script>
	<![endif]-->
</head>

<body class="site <?php echo $option
	. ' view-' . $view
	. ($layout ? ' layout-' . $layout : ' no-layout')
	. ($task ? ' task-' . $task : ' no-task')
	. ($itemid ? ' itemid-' . $itemid : '')
	. ($params->get('fluidContainer') ? ' fluid' : '');
	echo ($this->direction == 'rtl' ? ' rtl' : '');
?>">
	<!-- Body -->
<div class="topground"></div>
	<div class="body">
		<div class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : ''); ?>">
			<!-- Header -->
			<header class="header" role="banner">
				<div class="header-inner clearfix">
					<a class="brand pull-left" href="<?php echo $this->baseurl; ?>/">
						<?php echo $logo; ?>
						<?php if ($this->params->get('sitedescription')) : ?>
							<?php echo '<div class="site-description">' . htmlspecialchars($this->params->get('sitedescription')) . '</div>'; ?>
						<?php endif; ?>
					</a>
                    <div class="header-baner">
						<jdoc:include type="modules" name="header-baner" style="none" />
					</div>
					<?php if ($this->countModules('search')) : ?>
						<div class="header-search pull-right">
							<jdoc:include type="modules" name="search" style="none" />
						</div>
					<?php endif; ?>
				</div>
			</header>
			<?php if ($this->countModules('nav-menu')) : ?>
				<nav class="navigation" role="navigation">
					<div id="nav">
						<div class = "nav-menu">
							<jdoc:include type="modules" name="nav-menu" style="none" />
						</div>
						<div class = "levy"></div>
						<div class = "pravy"></div>
					</div>
				</nav>
			<?php endif; ?>
			<?php if ($this->countModules('slider')) : ?>
				<jdoc:include type="modules" name="slider" style="xhtml" />
			<?php endif; ?>
			<div id="main-content">
				<?php if ($this->countModules('main-left')) : ?>
					<div id="main-left" class="span3">
						<!-- Begin Left Sidebar -->
						<div class="sidebar-nav">
							<jdoc:include type="modules" name="main-left" style="xhtml" />
						</div>
						<!-- End Left Sidebar -->
					</div>
				<?php endif; ?>
				<?php if ($this->countModules('main-right')) : ?>
					<div id="main-right" class="span3">
						<!-- Begin Right Sidebar -->
						<div class="sidebar-nav">
							<jdoc:include type="modules" name="main-right" style="xhtml" />
						</div>
						<!-- End Right Sidebar -->
					</div>
				<?php endif; ?>
				<div id="content" role="main" class="<?php echo $span, $style_both, $style_left, $style_right ; ?>">
					<!-- Begin Content -->
					<div class="content-container">
						<jdoc:include type="modules" name="main-content" style="xhtml" />
						<jdoc:include type="message" />
						<jdoc:include type="component" />
						<jdoc:include type="modules" name="main-content-2" style="none" />
					</div>
					<!-- End Content -->
				</div>
					<div class="clear-both"></div>
			</div>
		</div>
	</div>
	<!-- Footer -->
	<footer class="footer" role="contentinfo">
		<div class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : ''); ?>">
			<?php if ($this->countModules('metrika')) : ?>
				<div class = ya-metrika>
					<jdoc:include type="modules" name="metrika" style="none" />
				</div>
			<?php endif; ?>
			<jdoc:include type="modules" name="footer" style="none" />
			<div class="custom">
				<p class="copyright-footer">
					&copy; <?php echo date('Y'); ?> <?php echo $sitename; ?>
				</p>
				<p>&nbsp;</p>
			</div>
		</div>
	</footer>
	<jdoc:include type="modules" name="debug" style="none" />
</body>
</html>
