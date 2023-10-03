<?php
/*
GHSVS 2023-07
 */
// No direct access.
defined('_JEXEC') or die;
use Joomla\CMS\Language\Text;

extract($displayData);

$template = Astroid\Framework::getTemplate();
$document = Astroid\Framework::getDocument();
$params = $template->getParams();
$color_mode = $template->getColorMode();

$mode = $params->get('header_horizontal_menu_mode', 'center');
#echo ' 4654sd48sa7d98sD81s8d71dsa <pre>' . print_r($params, true) . '</pre>';exit;
#echo ' 4654sd48sa7d98sD81s8d71dsa <pre>' . print_r($mode, true) . '</pre>';exit;
$block_1_type = $params->get('header_block_1_type', 'blank');
$block_1_position = $params->get('header_block_1_position', '');
$block_1_custom = $params->get('header_block_1_custom', '');
$block_2_type = $params->get('header_block_2_type', 'blank');
$block_2_position = $params->get('header_block_2_position', '');
$block_2_custom = $params->get('header_block_2_custom', '');
$header_menu = $params->get('header_menu', 'jnone');
#echo ' 4654sd48sa7d98sD81s8d71dsa <pre>' . print_r($header_menu, true) . '</pre>';exit;
$header_breakpoint = $params->get('header_breakpoint', 'jnone');
$enable_offcanvas = $params->get('enable_offcanvas', FALSE);
$header_mobile_menu = $params->get('header_mobile_menu', '');
$offcanvas_animation = $params->get('offcanvas_animation', 'st-effect-1');
$offcanvas_direction = $params->get('offcanvas_direction', 'offcanvasDirLeft');
$offcanvas_position = $params->get('offcanvas_position', 'offcanvasRight');
$offcanvas_togglevisibility = $params->get('offcanvas_togglevisibility', 'd-block');
$class = ['astroid-header', 'astroid-horizontal-header', 'astroid-horizontal-' . $mode . '-header'];
$navClass = ['nav', 'astroid-nav', 'd-none', 'd-'.$header_breakpoint.'-flex'];
$navWrapperClass = ['align-self-center', 'px-2', 'd-none', 'd-'.$header_breakpoint.'-block'];
?>
<!-- header starts -->
<header data-megamenu data-megamenu-class=".has-megamenu" data-megamenu-content-class=".megamenu-container" data-dropdown-arrow="<?php echo $params->get('dropdown_arrow', 0) ? 'true' : 'false'; ?>" data-header-offset="true" data-transition-speed="<?php echo $params->get('dropdown_animation_speed', 300); ?>" data-megamenu-animation="<?php echo $params->get('dropdown_animation_type', 'fade'); ?>" data-easing="<?php echo $params->get('dropdown_animation_ease', 'linear'); ?>" data-astroid-trigger="<?php echo $params->get('dropdown_trigger', 'hover'); ?>" data-megamenu-submenu-class=".nav-submenu,.nav-submenu-static" id="astroid-header" class="<?php echo implode(' ', $class); ?>">
	<div class="d-flex flex-column flex-sm-row justify-content-sm-between">

		<div class="header-left-section d-flex flex-column flex-sm-row justify-content-sm-start">
			<?php $document->include('logo_normal'); ?>

			<?php if ($block_2_type != 'blank')
			{ ?>
			<div class="align-self-center">
				<?php
				// Hier im gedachten Normalfall ein custom module mit den Seitenüberschriften h1 und h2.
				if ($block_2_type == 'position')
				{ ?>
				<div class="siteTitle text-center text-sm-start d-sm-flex justify-content-sm-start align-items-sm-center pe-sm-2">
					<?php echo $document->position($block_2_position, 'xhtml'); ?>
				</div><!--/.siteTitle-->
				<?php
				} else if ($block_2_type == 'custom')
				{
					echo '<div class="d-flex justify-content-start align-items-center">';
					echo $block_2_custom;
					echo '</div>';
				} ?>
			</div>
			<?php
			} ?>
		</div><!--/.header-left-section -->

		<?php # Klasse .navbar letztlich nur, damit Bootstrap-Variablen für .navbar-toggler etc. generiert werden. ?>
		<div class="header-right-section d-flex justify-content-end navbar">
			<?php if (!empty($header_mobile_menu))
			{ ?>
			<div class="align-self-center" data-offcanvas="#astroid-mobilemenu"
				data-effect="mobilemenu-slide">
				<button aria-label="<?php echo Text::_('GHSVS_MOBILEMENU_TOGGLE'); ?>"
					class="navbar-toggler" type="button">
					<span class="navbar-toggler-icon"></span>
					<!--/ <span class="icon-menu fa-2x"></span>
					<span aria-hidden="true" class="svgSpan svg-lg svg-2x"><?php echo Text::_('GHSVS_SVG_MOBILEMENU_BUTTON'); ?></span><span class="togglerLabel d-none"><?php echo Text::_('GHSVS_MOBILEMENU_MENU'); ?></span>
					-->
				</button>
			</div>
			<?php
			} ?>
		</div><!--/.header-right-section -->

	</div><!--/justify-content-between -->
</header>
<!-- header ends -->
