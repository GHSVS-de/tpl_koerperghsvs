<?php
defined('_JEXEC') or die;
defined('_ASTROID') or die('Please install and activate <a href="https://www.astroidframe.work/" target="_blank">Astroid Framework</a> in order to use this template.');

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use GHSVS\Template\KoerperGhsvs\Site\Helper\TemplateHelper;

$isRobot = (int) Factory::getApplication()->client->robot;

$wa = $this->getWebAssetManager();
$wa->usePreset('koerperghsvs.framework');

$color_mode = Astroid\Framework::getTemplate()->getColorMode();
$color_mode_theme = $color_mode ? ' data-bs-theme="'.$color_mode.'"' : '';

$document = Astroid\Framework::getDocument(); // Astroid Document
// Output as HTML5
$this->setHtml5(true);
$this->setMetaData('viewport', 'width=device-width, initial-scale=1');
// Momentan joomla-fontawesome.min.css einfach ins SCSS reingepastet.
//$wa->useStyle('fontawesome');
?>
<!DOCTYPE html>
<html class="no-js jsNotActive" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>"<?php echo $color_mode_theme; ?>>

<head>
	<jdoc:include type="metas" />
	<jdoc:include type="styles" />
	<jdoc:include type="scripts" />
	<astroid:include type="head-styles" />
	<astroid:include type="head-scripts" />
	<?php $document->include('ghsvs.favicons', ['template' => $this->template]); ?>
</head> <!-- document head -->

<body class="<?php echo $document->getBodyClass(); ?>">
   <?php $document->include('document.body'); ?>
   <!-- body and layout -->
   <astroid:include type="body-scripts" /> <!-- body scripts -->
		<?php
		if (!$isRobot)
		{ ?>
		<div id="noscriptdiv" role="alert" aria-hidden="true">
			<?php echo Text::_('TPL_ACTIVATE_JAVASCRIPT');?>
		</div>
		<?php
		} ?>
</body> <!-- document body -->

</html> <!-- document end -->
