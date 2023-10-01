<?php
/*
GHSVS 2023-07-31.
Das Hintergrundbild wird auf die gesamte #headerSection angewendet.
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Uri\Uri;

$modId = 'mod-custom' . $module->id;

if ($params->get('backgroundimage'))
{
    $wa = Factory::getApplication()->getDocument()->getWebAssetManager();
    $wa->addInlineStyle('
#headerSectionssss, .astroid-container{background-image: url("' . Uri::root(true) . '/' . HTMLHelper::_('cleanImageURL', $params->get('backgroundimage'))->url . '");}
', ['name' => $modId]);
} ?>
<div id="<?php echo $modId; ?>" class="mod-custom custom">
    <?php echo $module->content; ?>
</div>
