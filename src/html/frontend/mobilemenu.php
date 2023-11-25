<?php
/*
GHSVS 2023-07
 */
use Joomla\CMS\Factory;
use GHSVS\Template\KoerperGhsvs\Site\Helper\TemplateHelper;

defined('_JEXEC') or die;
extract($displayData);

$params = Astroid\Framework::getTemplate()->getParams();
$document = Astroid\Framework::getDocument();
$wa = Factory::getApplication()->getDocument()->getWebAssetManager();

$header = $params->get('header', TRUE);
$header_mobile_menu = $params->get('header_mobile_menu', '');
if (!$header) {
   return;
}
if (empty($header_mobile_menu)) {
   return;
}

$dir = 'right';
$header = $params->get('header', TRUE);
$header_mode = $params->get('header_mode', 'horizontal');
$mode = $params->get('header_sidebar_menu_mode', 'left');
$dir = $header ? ($header_mode == 'sidebar' ? $mode : $dir) : $dir;

$wa->registerAndUseScript('astroid.offcanvas', 'astroid/offcanvas.min.js', ['relative' => true, 'version' => 'auto'], [], ['jquery']);
$wa->registerAndUseScript('astroid.mobilemenu', 'astroid/mobilemenu.min.js', ['relative' => true, 'version' => 'auto'], [], ['jquery']);
?>
<div class="astroid-mobilemenu d-none d-init dir-<?php echo $dir; ?>" data-class-prefix="astroid-mobilemenu" id="astroid-mobilemenu">
   <div class="burger-menu-button active">
      <button aria-label="Mobile Menu Toggle" type="button" class="button close-offcanvas offcanvas-close-btn">
         <span class="box">
            <span class="inner"></span>
         </span>
      </button>
   </div>
   <?php
	 //Astroid\Component\Menu::getMobileMenu($header_mobile_menu);

// Bugfix für Redim-Plugin-URL, das sonst immer auf Startseite führt.
ob_start();
Astroid\Component\Menu::getMobileMenu($header_mobile_menu);
$mobileMenuHTML = ob_get_clean();

if (!empty($mobileMenuHTML))
{
	$searchFor = '"?cookiehint=set"';

	if (strpos($mobileMenuHTML, $searchFor) !== false)
	{
		$mobileMenuHTML = str_replace(
			$searchFor,
			'"' . TemplateHelper::getCookiehintLink() . '"',
			$mobileMenuHTML
		);
	}
	echo $mobileMenuHTML;
}

   ?>
</div>
<?php
$style = '.mobilemenu-slide.astroid-mobilemenu{visibility:visible;-webkit-transform:translate3d(' . ($dir == 'left' ? '-' : '') . '100%, 0, 0);transform:translate3d(' . ($dir == 'left' ? '-' : '') . '100%, 0, 0);}.mobilemenu-slide.astroid-mobilemenu-open .mobilemenu-slide.astroid-mobilemenu {visibility:visible;-webkit-transform:translate3d(0, 0, 0);transform:translate3d(0, 0, 0);}.mobilemenu-slide.astroid-mobilemenu::after{display:none;}';
$wa->addInlineStyle($style);
