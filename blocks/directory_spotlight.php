<?php

declare(strict_types=1);

/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * wgFileManager module for xoops
 *
 * @copyright    2021 XOOPS Project (https://xoops.org)
 * @license      GPL 2.0 or later
 * @package      wgfilemanager
 * @author       Goffy - Wedega - Email:webmaster@wedega.com - Website:https://xoops.wedega.com
 */

use XoopsModules\Wgfilemanager;
use XoopsModules\Wgfilemanager\Helper;
use XoopsModules\Wgfilemanager\Constants;

require_once \XOOPS_ROOT_PATH . '/modules/wgfilemanager/include/common.php';

/**
 * Function show block
 * @param  $options
 * @return array
 */
function b_wgfilemanager_directory_spotlight_show($options)
{
    $block       = [];
    $typeBlock   = $options[0];
    $limit       = $options[1];
    $lenghtTitle = $options[2];
    $helper      = Helper::getInstance();
    $directoryHandler = $helper->getHandler('Directory');
    $crDirectory = new \CriteriaCompo();
    \array_shift($options);
    \array_shift($options);
    \array_shift($options);

    if (\count($options) > 0 && (int)$options[0] > 0) {
        $crDirectory->add(new \Criteria('id', '(' . \implode(',', $options) . ')', 'IN'));
        $limit = 0;
    }

    $crDirectory->setSort('id');
    $crDirectory->setOrder('DESC');
    $crDirectory->setLimit($limit);
    $directoryAll = $directoryHandler->getAll($crDirectory);
    unset($crDirectory);
    if (\count($directoryAll) > 0) {
        foreach (\array_keys($directoryAll) as $i) {
            /**
             * If you want to use the parameter for limits you have to adapt the line where it should be applied
             * e.g. change
             *     $block[$i]['title'] = $directoryAll[$i]->getVar('art_title');
             * into
             *     $myTitle = $directoryAll[$i]->getVar('art_title');
             *     if ($limit > 0) {
             *         $myTitle = \substr($myTitle, 0, (int)$limit);
             *     }
             *     $block[$i]['title'] =  $myTitle;
             */
            $block[$i]['id'] = $directoryAll[$i]->getVar('id');
            $block[$i]['name'] = \htmlspecialchars($directoryAll[$i]->getVar('name'), ENT_QUOTES | ENT_HTML5);
        }
    }

    return $block;

}

/**
 * Function edit block
 * @param  $options
 * @return string
 */
function b_wgfilemanager_directory_spotlight_edit($options)
{
    $helper = Helper::getInstance();
    $directoryHandler = $helper->getHandler('Directory');
    $GLOBALS['xoopsTpl']->assign('wgfilemanager_upload_url', \WGFILEMANAGER_UPLOAD_URL);
    $form = \_MB_WGFILEMANAGER_DISPLAY_SPOTLIGHT . ' : ';
    $form .= "<input type='hidden' name='options[0]' value='".$options[0]."' >";
    $form .= "<input type='text' name='options[1]' size='5' maxlength='255' value='" . $options[1] . "' >&nbsp;<br>";
    $form .= \_MB_WGFILEMANAGER_TITLE_LENGTH . " : <input type='text' name='options[2]' size='5' maxlength='255' value='" . $options[2] . "' ><br><br>";
    \array_shift($options);
    \array_shift($options);
    \array_shift($options);

    $crDirectory = new \CriteriaCompo();
    $crDirectory->add(new \Criteria('id', 0, '!='));
    $crDirectory->setSort('id');
    $crDirectory->setOrder('ASC');
    $directoryAll = $directoryHandler->getAll($crDirectory);
    unset($crDirectory);
    $form .= \_MB_WGFILEMANAGER_DIRECTORY_TO_DISPLAY . "<br><select name='options[]' multiple='multiple' size='5'>";
    $form .= "<option value='0' " . (!\in_array(0, $options) && !\in_array('0', $options) ? '' : "selected='selected'") . '>' . \_MB_WGFILEMANAGER_ALL_DIRECTORY . '</option>';
    foreach (\array_keys($directoryAll) as $i) {
        $dir_id = $directoryAll[$i]->getVar('id');
        $form .= "<option value='" . $dir_id . "' " . (!\in_array($dir_id, $options) ? '' : "selected='selected'") . '>' . $directoryAll[$i]->getVar('name') . '</option>';
    }
    $form .= '</select>';

    return $form;

}
