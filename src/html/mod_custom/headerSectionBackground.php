<?php
/*
GHSVS 2023-07-31.
Das Hintergrundbild wird auf die gesamte #headerSection angewendet.
Weiters enthält das Modul im Normalfall h1 und h2 Site-Titel (im Editor eingegeben).
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Uri\Uri;

$modId = 'mod-custom' . $module->id;

if ($params->get('backgroundimage'))
{
	// Das Bild wird "globaler" eingesetzt und nicht nur hinter das eigentliche Modul!
	Factory::getApplication()->getDocument()->getWebAssetManager()->addInlineStyle(
		'.astroid-container{background-image: url("' . Uri::root(true) . '/' . HTMLHelper::_('cleanImageURL', $params->get('backgroundimage'))->url . '");}',
		['name' => $modId]
	);
} ?>
<div id="<?php echo $modId; ?>" class="mod-custom custom siteTitle">
    <?php echo $module->content; ?>
</div>
