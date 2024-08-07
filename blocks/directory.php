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
function b_wgfilemanager_directory_show($options)
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

    switch ($typeBlock) {
        case 'last':
        default:
            // For the block: directory last
            $crDirectory->setSort('date_created');
            $crDirectory->setOrder('DESC');
            break;
        case 'new':
            // For the block: directory new
            // new since last week: 7 * 24 * 60 * 60 = 604800
            $crDirectory->add(new \Criteria('date_created', \time() - 604800, '>='));
            $crDirectory->add(new \Criteria('date_created', \time(), '<='));
            $crDirectory->setSort('date_created');
            $crDirectory->setOrder('ASC');
            break;
        case 'hits':
            // For the block: directory hits
            $crDirectory->setSort('dir_hits');
            $crDirectory->setOrder('DESC');
            break;
        case 'top':
            // For the block: directory top
            $crDirectory->setSort('dir_top');
            $crDirectory->setOrder('ASC');
            break;
        case 'random':
            // For the block: directory random
            $crDirectory->setSort('RAND()');
            break;
    }

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
function b_wgfilemanager_directory_edit($options)
{
    $GLOBALS['xoopsTpl']->assign('wgfilemanager_upload_url', \WGFILEMANAGER_UPLOAD_URL);
    $form = \_MB_WGFILEMANAGER_DISPLAY . ' : ';
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

    /**
     * If you want to filter your results by e.g. a category used in yourdirectory
     * then you can activate the following code, but you have to change it according your category
     */
    /*
    $helper = Helper::getInstance();
    $directoryHandler = $helper->getHandler('Directory');
    $directoryAll = $directoryHandler->getAll($crDirectory);
    unset($crDirectory);
    $form .= \_MB_WGFILEMANAGER_DIRECTORY_TO_DISPLAY . "<br><select name='options[]' multiple='multiple' size='5'>";
    $form .= "<option value='0' " . (!\in_array(0, $options) && !\in_array('0', $options) ? '' : "selected='selected'") . '>' . \_MB_WGFILEMANAGER_ALL_DIRECTORY . '</option>';
    foreach (\array_keys($directoryAll) as $i) {
        $dir_id = $directoryAll[$i]->getVar('id');
        $form .= "<option value='" . $dir_id . "' " . (!\in_array($dir_id, $options) ? '' : "selected='selected'") . '>' . $directoryAll[$i]->getVar('name') . '</option>';
    }
    $form .= '</select>';

    */
    return $form;

}
