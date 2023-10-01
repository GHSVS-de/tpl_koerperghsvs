<?php
defined('_JEXEC') or die;
defined('_ASTROID') or die('Please install and activate <a href="https://www.astroidframe.work/" target="_blank">Astroid Framework</a> in order to use this template.');

use GHSVS\Template\KoerperGhsvs\Site\Helper\TemplateHelper;

$wa = $this->getWebAssetManager();
$wa->usePreset('koerperghsvs.framework');

$color_mode = Astroid\Framework::getTemplate()->getColorMode();
$color_mode_theme = $color_mode ? ' data-bs-theme="'.$color_mode.'"' : '';

$document = Astroid\Framework::getDocument(); // Astroid Document
// Output as HTML5
$this->setHtml5(true);

// Momentan joomla-fontawesome.min.css einfach ins SCSS reingepastet.
//$wa->useStyle('fontawesome');
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>"<?php echo $color_mode_theme; ?>>

<head>
   <astroid:include type="head-meta" /> <!-- document meta -->
   <jdoc:include type="head" /> <!-- joomla head -->
   <astroid:include type="head-styles" /> <!-- head styles -->
   <astroid:include type="head-scripts" /> <!-- head scripts -->
		<?php $document->include('ghsvs.favicons', ['template' => $this->template]); ?>
</head> <!-- document head -->

<body class="<?php echo $document->getBodyClass(); ?>">
   <?php $document->include('document.body'); ?>
   <!-- body and layout -->
   <astroid:include type="body-scripts" /> <!-- body scripts -->
</body> <!-- document body -->

</html> <!-- document end -->
