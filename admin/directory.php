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

use Xmf\Request;
use XoopsModules\Wgfilemanager;
use XoopsModules\Wgfilemanager\Constants;
use XoopsModules\Wgfilemanager\Common;

require __DIR__ . '/header.php';
// Get all request values
$op    = Request::getCmd('op', 'list');
$dirId = Request::getInt('id');
$start = Request::getInt('start');
$limit = Request::getInt('limit', $helper->getConfig('adminpager'));
$GLOBALS['xoopsTpl']->assign('start', $start);
$GLOBALS['xoopsTpl']->assign('limit', $limit);

switch ($op) {
    case 'list':
    default:
        // Define Stylesheet
        $GLOBALS['xoTheme']->addStylesheet($style, null);
        $templateMain = 'wgfilemanager_admin_directory.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('directory.php'));
        $adminObject->addItemButton(\_AM_WGFILEMANAGER_ADD_DIRECTORY, 'directory.php?op=new');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        $GLOBALS['xoopsTpl']->assign('wgfilemanager_url', \WGFILEMANAGER_URL);
        $GLOBALS['xoopsTpl']->assign('wgfilemanager_upload_url', \WGFILEMANAGER_UPLOAD_URL);
        $directoryCount = $directoryHandler->getCountDirectory();
        $GLOBALS['xoopsTpl']->assign('directory_count', $directoryCount);
        // Table view directory
        if ($directoryCount > 0) {
            $directoryAll = $directoryHandler->getAllDirectory($start, $limit);
            foreach (\array_keys($directoryAll) as $i) {
                $directory = $directoryAll[$i]->getValuesDir();
                $GLOBALS['xoopsTpl']->append('directory_list', $directory);
                unset($directory);
            }
            // Display Navigation
            if ($directoryCount > $limit) {
                require_once \XOOPS_ROOT_PATH . '/class/pagenav.php';
                $pagenav = new \XoopsPageNav($directoryCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav());
            }
        } else {
            if (1 === Request::getInt('createbasic')) {
                //creation of basic directory tried already once but failed
                echo \_MA_WGFILEMANAGER_DIRECTORY_BASIC_FAILED;
                die;
            }
            //create basic directory
            $directoryObj = $directoryHandler->create();
            $directoryObj->setVar('parent_id', 0);
            $directoryObj->setVar('name', \_MA_WGFILEMANAGER_DIRECTORY_BASICNAME);
            $directoryObj->setVar('description', '');
            $directoryObj->setVar('fullpath', '\\');
            $directoryObj->setVar('weight', 1);
            $directoryObj->setVar('date_created', time());
            $uidCurrent = \is_object($GLOBALS['xoopsUser']) ? $GLOBALS['xoopsUser']->uid() : 0;
            $directoryObj->setVar('submitter', $uidCurrent);
            // Insert Data
            if ($directoryHandler->insert($directoryObj)) {
                \redirect_header('directory.php?op=list&amp;createbasic=1', 0);
            } else {

            }
            $GLOBALS['xoopsTpl']->assign('error', \_AM_WGFILEMANAGER_THEREARENT_DIRECTORY);
        }
        break;
    case 'new':
        $templateMain = 'wgfilemanager_admin_directory.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('directory.php'));
        $adminObject->addItemButton(\_AM_WGFILEMANAGER_LIST_DIRECTORY, 'directory.php', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Form Create
        $directoryObj = $directoryHandler->create();
        $form = $directoryObj->getForm();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'clone':
        $templateMain = 'wgfilemanager_admin_directory.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('directory.php'));
        $adminObject->addItemButton(\_AM_WGFILEMANAGER_LIST_DIRECTORY, 'directory.php', 'list');
        $adminObject->addItemButton(\_AM_WGFILEMANAGER_ADD_DIRECTORY, 'directory.php?op=new');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Request source
        $dirIdSource = Request::getInt('id_source');
        // Get Form
        $directoryObjSource = $directoryHandler->get($dirIdSource);
        $directoryObj = $directoryObjSource->xoopsClone();
        $form = $directoryObj->getForm();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'save':
        // Security Check
        if (!$GLOBALS['xoopsSecurity']->check()) {
            \redirect_header('directory.php', 3, \implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if ($dirId > 0) {
            $directoryObj = $directoryHandler->get($dirId);
        } else {
            $directoryObj = $directoryHandler->create();
        }
        $dirParentId    = Request::getInt('parent_id');
        $dirParentIdOld = Request::getInt('parent_id_old');
        $dirName        = Request::getString('name');
        $dirNameOld     = Request::getString('name_old');
        $dirDescription = Request::getText('description');
        $dirWeight      = Request::getInt('weight');
        $moveDir        = false;
        $renameDir      = false;
        if ($dirId > 1) {
            $moveDir   = $dirParentId !== $dirParentIdOld;
            $renameDir = $dirName !== $dirNameOld;
        }
        // get full path
        $dirBasePath = DS;
        $dirFullPath = $dirBasePath;
        if ($dirParentId > 0) {
            $path = $directoryHandler->getFullPath($dirParentId);
            if ('' !== $path) {
                $dirBasePath .= $path . DS;
            }
            $dirFullPath = $dirBasePath . \mb_strtolower($dirName);
        }
        $dirFullPathOld = '';
        if ($moveDir) {
            $dirBasePathOld = DS;
            if ($dirParentIdOld > 0) {
                $dirBasePathOld .= $directoryHandler->getFullPath($dirParentIdOld);
                $dirBasePathOld .= DS;
            }
            $dirFullPathOld = $dirBasePathOld . \mb_strtolower($dirNameOld);
        }
        //check whether directory exist
        $dirExists = $directoryHandler->existDirectory($dirFullPath);
        //if new or move dir or rename dir then check that folder doesn't exist
        if ((0 === $dirId || $moveDir || $renameDir) && $dirExists) {
            $templateMain = 'wgfilemanager_admin_directory.tpl';
            $directoryObj->setVar('parent_id', $dirParentId);
            $directoryObj->setVar('name', $dirName);
            $directoryObj->setVar('description', $dirDescription);
            $directoryObj->setVar('weight', $dirWeight);
            $form = $directoryObj->getForm();
            $GLOBALS['xoopsTpl']->assign('form', $form->render());
            $GLOBALS['xoopsTpl']->assign('error', \_MA_WGFILEMANAGER_DIRECTORY_ERROR_EXISTS);
        } else {
            // Set Vars
            $directoryObj->setVar('parent_id', $dirParentId);
            $directoryObj->setVar('name', $dirName);
            $directoryObj->setVar('description', $dirDescription);
            $directoryObj->setVar('fullpath', $dirFullPath);
            $directoryObj->setVar('weight', $dirWeight);
            $directoryDate_createdObj = \DateTime::createFromFormat(\_SHORTDATESTRING, Request::getString('date_created'));
            $directoryObj->setVar('date_created', $directoryDate_createdObj->getTimestamp());
            $directoryObj->setVar('submitter', Request::getInt('submitter'));
            // Insert Data
            if ($directoryHandler->insert($directoryObj)) {
                if ($moveDir) {
                    $directoryHandler->moveDirectory($dirFullPathOld, $dirFullPath);
                } else if ($renameDir) {
                    $directoryHandler->renameDirectory($dirBasePath . $dirNameOld, $dirFullPath);
                } else if (!$dirExists) {
                    $directoryHandler->createDirectory($dirFullPath);
                }
                $newDirId = $directoryObj->getNewInsertedId();
                $permId = isset($_REQUEST['id']) ? $dirId : $newDirId;
                $grouppermHandler = \xoops_getHandler('groupperm');
                $mid = $GLOBALS['xoopsModule']->getVar('mid');
                if ('directory' === $helper->getConfig('permission_type')) {
                    // Permission to view_directory
                    $grouppermHandler->deleteByModule($mid, 'wgfilemanager_view_directory', $permId);
                    if (isset($_POST['groups_view_directory'])) {
                        foreach ($_POST['groups_view_directory'] as $onegroupId) {
                            $grouppermHandler->addRight('wgfilemanager_view_directory', $permId, $onegroupId, $mid);
                        }
                    }
                    // Permission to submit_directory
                    $grouppermHandler->deleteByModule($mid, 'wgfilemanager_submit_directory', $permId);
                    if (isset($_POST['groups_submit_directory'])) {
                        foreach ($_POST['groups_submit_directory'] as $onegroupId) {
                            $grouppermHandler->addRight('wgfilemanager_submit_directory', $permId, $onegroupId, $mid);
                        }
                    }
                    // Permission to approve_directory
                    $grouppermHandler->deleteByModule($mid, 'wgfilemanager_approve_directory', $permId);
                    if (isset($_POST['groups_approve_directory'])) {
                        foreach ($_POST['groups_approve_directory'] as $onegroupId) {
                            $grouppermHandler->addRight('wgfilemanager_approve_directory', $permId, $onegroupId, $mid);
                        }
                    }
                }
                \redirect_header('directory.php?op=list&amp;start=' . $start . '&amp;limit=' . $limit, 2, \_AM_WGFILEMANAGER_FORM_OK);
            }
            $GLOBALS['xoopsTpl']->assign('error', $directoryObj->getHtmlErrors());
        }
        break;
    case 'edit':
        $templateMain = 'wgfilemanager_admin_directory.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('directory.php'));
        $adminObject->addItemButton(\_AM_WGFILEMANAGER_ADD_DIRECTORY, 'directory.php?op=new');
        $adminObject->addItemButton(\_AM_WGFILEMANAGER_LIST_DIRECTORY, 'directory.php', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Get Form
        $directoryObj = $directoryHandler->get($dirId);
        $directoryObj->start = $start;
        $directoryObj->limit = $limit;
        $form = $directoryObj->getForm();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'delete':
        $templateMain = 'wgfilemanager_admin_directory.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('directory.php'));
        $directoryObj = $directoryHandler->get($dirId);
        $dirName = $directoryObj->getVar('name');
        if (isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                \redirect_header('directory.php', 3, \implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            $dirFullPath = $directoryObj->getVar('fullpath');
            if ($directoryHandler->delete($directoryObj)) {
                if ($directoryHandler->deleteDirectory($dirFullPath)) {
                    if ($directoryHandler->deleteSubDirData($dirId)) {
                        \redirect_header('directory.php', 3, \_AM_WGFILEMANAGER_FORM_DELETE_OK);
                    } else {
                        \redirect_header('directory.php', 3, \_MA_WGFILEMANAGER_DIRECTORY_ERROR_DELETE_SUBDIRDATA);
                    }
                } else {
                    \redirect_header('directory.php', 3, \_MA_WGFILEMANAGER_DIRECTORY_ERROR_DELETE);
                }

            } else {
                $GLOBALS['xoopsTpl']->assign('error', $directoryObj->getHtmlErrors());
            }
        } else {
            $confirmText = \sprintf(\_MA_WGFILEMANAGER_DIRECTORY_DELETE_SINGLE, $dirName);
            if ($directoryHandler->dirIsParent($dirId)) {
                $confirmText = \sprintf(\_MA_WGFILEMANAGER_DIRECTORY_DELETE_ISPARENT, $dirName);
            }
            $customConfirm = new Common\Confirm(
                ['ok' => 1, 'id' => $dirId, 'start' => $start, 'limit' => $limit, 'op' => 'delete'],
                $_SERVER['REQUEST_URI'],
                $confirmText);
            $form = $customConfirm->getFormConfirm();
            $GLOBALS['xoopsTpl']->assign('form', $form->render());
        }
        break;
}
require __DIR__ . '/footer.php';
