<?php
namespace GHSVS\Template\KoerperGhsvs\Site\Helper;

\defined('_JEXEC') or die;

use Joomla\CMS\Uri\Uri;

abstract class TemplateHelper
{
  public static function Test() {
    return 'Test';
  }
	/*
		Aktueller Seitenlink mit Query ?cookiehint=set.
	*/
  public static function getCookiehintLink() : string
	{
		$currentPath = Uri::getInstance()->getPath();

		if (\strpos($currentPath, '/') === 0)
		{
			$currentPath = \substr_replace($currentPath, '', 0, 1);
		}
		return Uri::root() . $currentPath . '?cookiehint=set';
  }
}
