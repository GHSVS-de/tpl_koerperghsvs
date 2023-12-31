<?php

/**
 * @package   Astroid Framework
 * @author    Astroid Framework https://astroidframe.work
 * @copyright Copyright (C) 2023 AstroidFrame.work.
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */

defined('_JEXEC') or die;
$cookieLogin = $this->user->get('cookieLogin');
if (!empty($cookieLogin) || $this->user->get('guest')) {
   echo $this->loadTemplate('login'); // The user is not logged in or needs to provide a password.
} else {
   echo $this->loadTemplate('logout');  // The user is already logged in.
}
