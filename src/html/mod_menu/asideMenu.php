<?php
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Uri\Uri;
use Joomla\String\StringHelper;

if (!$list)
{
	return;
}

Factory::getDocument()->getWebAssetManager()->useScript('bootstrap.modal');

$uri = Uri::getInstance()->getPath();

if ($tagId = $params->get('tag_id', ''))
{
	$id = $tagId;
}
else
{
	$id = 'navbar-' . $module->id;
}

$modalId = 'modal-' . $module->id;

$moduleSubHeader = $params->get('moduleSubHeader', '');

$levelPrefix = Text::_('TPL_MODAL_MENUE_LEVEL_PREFIX');

#echo ' 4654sd48sa7d98sD81s8d71dsa <pre>' . print_r(reset($list), true) . '</pre>';exit;

$class_sfx = $class_sfx ? ' ' . $class_sfx : '';

#Bisschen plump, mit der Annahme, dass das asideManu mit Erste Ebene=2 konfiguriert usw.
$firstItem = reset($list);
$firstItemParent = $firstItem->getParent();
$parentTitle = $firstItemParent->title;
$modalHeadline = 'Menü <i>' . $parentTitle . '</i>';
array_unshift($list, $firstItemParent);
#echo ' 4654sd48sa7d98sD81s8d71dsa <pre>' . print_r($parentTitle , true) . '</pre>';exit;
foreach ($list as $item)
{

	/* Collect attributes like aria-* and others for the type subfiles.
	Can also be a SPAN attribute in case of headings. */
	$item->aAttributes = [];
	$item->aAttributes['class'] = 'list-group-item list-group-item-action item-'
		. $item->id . ' level-' . $item->level . ' aType' . ucfirst($item->type);
	$aClass = [];
	$itemParams = $item->getParams();

	/* Die geben wohl die einleitenden &nbsp; mit einer ESC-Folge ein(?)
	Im Quellcode kommt aber '   Thomas Boyken' raus. trim() hilft nichts.
	str_replace('&nbsp;', ...) hilft nix
	Wenn man das dann mit einem json_encode ausgibt, kommt man auf
	\u00a0\u00a0\u00a0Thomas Boyken und damit dann endlich auf:
	*/
	$item->title = StringHelper::trim($item->title, "\u{00a0}");

	if ($item->anchor_title)
	{
		$item->aAttributes['title'] = $item->anchor_title;
	}

	if ($item->anchor_css)
	{
		$aClass[] = $item->anchor_css;
	}

	if ($item->browserNav == 1)
	{
		$item->aAttributes['target'] = '_blank';
		$item->aAttributes['rel'] = 'noopener noreferrer';

		if ($item->anchor_rel == 'nofollow')
		{
			$attributes['rel'] .= ' nofollow';
		}
	}

	// At the moment only headings are used as dropdwon SPANs.
	if ($item->deeper)
	{
		$aClass[] = 'deeper';
	}

	if ($item->id == $default_id)
	{
		$aClass[] = 'default';
	}

	// $active_id kommt aus mod_menu.php.
	if (
		$item->id == $active_id
		|| ($item->type === 'alias'
			&& $itemParams->get('aliasoptions') == $active_id)
	) {
		// Hier umgebaut für koerper. Ich will nur die current.active rot.
		// Exclude articles in category.
		if ($uri === $item->flink)
		{
			$item->aAttributes['aria-current'] = 'page';
			$aClass[] = 'current active';
		}

		// $aClass[] = 'active';
	}

	// $path kommt aus mod_menu.php. Ist tree-Array.
	// Hier umgebaut für koerper. Ich will nur die current.active rot.
	if (in_array($item->id, $path))
	{
		//$aClass[] = 'active';
	}
	elseif ($item->type === 'alias')
	{
		$aliasToId = $itemParams->get('aliasoptions');

		if (count($path) > 0 && $aliasToId == $path[count($path) - 1])
		{
			//$aClass[] = 'active';
		}
		elseif (in_array($aliasToId, $path))
		{
			$aClass[] = 'alias-parent-active';
		}
	}

	if ($item->parent)
	{
		$aClass[] = 'parent';
	}

	// Just indent because I'm too lazy to build nested.
	$item->prefix = str_repeat($levelPrefix, ($item->level - 1));

	if ($aClass)
	{
		$item->aAttributes['class'] .= ' ' . implode(' ', array_unique($aClass));
	}
} ?>
<div class="asideMenu">
	<!-- Button trigger modal -->
	<div class="div4modalButton" >
		<button type="button" class="btn btn-xs btn-warning" data-bs-toggle="modal" data-bs-target="#<?php echo $modalId ; ?>">
			<span class="icon-list-view" aria-hidden="true"></span>
			<?php #echo $parentTitle; ?>
			<span class="icon-chevron-down" aria-hidden="true"></span>
		</button>
	</div>

	<!-- Modal -->
	<div id="<?php echo $modalId; ?>" class="modal fade" tabindex="-1" role="dialog"
		aria-labelledby="<?php echo $modalId; ?>Title" aria-hidden="true">
		<div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
			<div class="modal-content bg-modal">
				<div class="modal-header">
					<p class="modal-title h3"
						id="<?php echo $modalId; ?>Title">
						<?php echo Text::_($modalHeadline); ?>
					</p>
					<?php echo LayoutHelper::render('ghsvs.closeButtonTop'); ?>
				</div><!--/modal-header-->
				<div class="modal-body">
					<div class="<?php echo 'list-group' . $class_sfx; ?>">
						<?php foreach ($list as &$item)
	{
		$item->title = $item->prefix . $item->title;

		switch ($item->type)
							{
								case 'separator':
								case 'component':
								case 'heading':
								case 'url':
									require ModuleHelper::getLayoutPath(
										'mod_menu',
										'ghsvsDefault_' . $item->type
									);
									break;
								default:
									require ModuleHelper::getLayoutPath(
										'mod_menu',
										'ghsvsDefault_url'
									);
									break;
							}
	} ?>
					</div><!--/list-group-->
				</div><!--/modal-body-->
				<div class="modal-footer">
					<?php echo LayoutHelper::render('ghsvs.closeButton'); ?>
				</div><!--/modal-footer-->
			</div><!--/modal-content-->
		</div><!--/modal-dialog-->
	</div><!--/#<?php echo $modalId; ?>-->
</div><!--/.asideMenu-->
