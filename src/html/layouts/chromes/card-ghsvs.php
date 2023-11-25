<?php

/**
 * @package   Astroid Framework
 * @author    Astroid Framework https://astroidframe.work
 * @copyright Copyright (C) 2023 AstroidFrame.work.
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */

defined('_JEXEC') or die;
extract($displayData);

$moduleTag     = $params->get('module_tag', 'div');
$headerTag     = htmlspecialchars($params->get('header_tag', 'h5'), ENT_COMPAT, 'UTF-8');
$bootstrapSize = (int) $params->get('bootstrap_size', 0);

// Temporarily store header class in variable
$headerClass = $params->get('header_class');
$headerClass = $headerClass ? ' class="module-title' . htmlspecialchars($headerClass, ENT_COMPAT, 'UTF-8') . '"' : ' class="module-title"';

$content = trim($module->content);

$moduleClass = htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_COMPAT, 'UTF-8');

if (!empty($content)) :
?>
    <<?php echo $moduleTag; ?> class="card-ghsvs <?php echo $moduleClass; ?>">
        <?php
        echo '<div class="card-layout">';
        echo '<div class="card-body">';
        ?>
        <?php
        if ($module->showtitle != 0) :
        ?>
            <<?php
                echo $headerTag . $headerClass . '>' . $module->title;
                ?></<?php
                    echo $headerTag;
                    ?>> <?php
                    endif;
                        ?> <?php
                            echo $content;
                            ?> <?php
                                echo '</div>';
                                echo '</div>';
                                ?> </<?php
                                        echo $moduleTag;
                                        ?>> <?php
                                        endif;
                                            ?>
