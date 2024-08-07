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
$GLOBALS['xoopsOption']['template_main'] = 'wgfilemanager_directory.tpl';
require_once \XOOPS_ROOT_PATH . '/header.php';

$op    = Request::getCmd('op', 'list');
$dirId = Request::getInt('id');
$start = Request::getInt('start');
$limit = Request::getInt('limit', $helper->getConfig('userpager'));
$GLOBALS['xoopsTpl']->assign('start', $start);
$GLOBALS['xoopsTpl']->assign('limit', $limit);

// Define Stylesheet
$GLOBALS['xoTheme']->addStylesheet($style, null);
// Paths
$GLOBALS['xoopsTpl']->assign('xoops_icons32_url', \XOOPS_ICONS32_URL);
$GLOBALS['xoopsTpl']->assign('wgfilemanager_url', \WGFILEMANAGER_URL);
// Keywords
$keywords = [];
// Breadcrumbs
$xoBreadcrumbs[] = ['title' => \_MA_WGFILEMANAGER_INDEX, 'link' => 'index.php'];
// Permissions
$permEdit = $permissionsHandler->getPermGlobalSubmit();
$GLOBALS['xoopsTpl']->assign('permEdit', $permEdit);
$GLOBALS['xoopsTpl']->assign('showItem', $dirId > 0);

switch ($op) {
    case 'show':
    case 'list':
    default:
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_WGFILEMANAGER_DIRECTORY_LIST];
        $crDirectory = new \CriteriaCompo();
        if ($dirId > 0) {
            $crDirectory->add(new \Criteria('id', $dirId));
        }
        $directoryCount = $directoryHandler->getCount($crDirectory);
        $GLOBALS['xoopsTpl']->assign('directoryCount', $directoryCount);
        if (0 === $dirId) {
            $crDirectory->setStart($start);
            $crDirectory->setLimit($limit);
        }
        $directoryAll = $directoryHandler->getAll($crDirectory);
        if ($directoryCount > 0) {
            $directoryList = [];
            $dirName = '';
            // Get All Directory
            foreach (\array_keys($directoryAll) as $i) {
                $directoryList[$i] = $directoryAll[$i]->getValuesDir();
                $dirName = $directoryAll[$i]->getVar('name');
                $keywords[$i] = $dirName;
            }
            $GLOBALS['xoopsTpl']->assign('directory_list', $directoryList);
            unset($directoryList);
            // Display Navigation
            if ($directoryCount > $limit) {
                require_once \XOOPS_ROOT_PATH . '/class/pagenav.php';
                $pagenav = new \XoopsPageNav($directoryCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav());
            }
            $GLOBALS['xoopsTpl']->assign('table_type', $helper->getConfig('table_type'));
            $GLOBALS['xoopsTpl']->assign('panel_type', $helper->getConfig('panel_type'));
            $GLOBALS['xoopsTpl']->assign('divideby', $helper->getConfig('divideby'));
            $GLOBALS['xoopsTpl']->assign('numb_col', $helper->getConfig('numb_col'));
            if ('show' == $op && '' != $dirName) {
                $GLOBALS['xoopsTpl']->assign('xoops_pagetitle', \strip_tags($dirName . ' - ' . $GLOBALS['xoopsModule']->getVar('name')));
            }
        }
        break;
    case 'save':
        // Security Check
        if (!$GLOBALS['xoopsSecurity']->check()) {
            \redirect_header('directory.php', 3, \implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        // Check permissions
        if (!$permissionsHandler->getPermGlobalSubmit()) {
            \redirect_header('directory.php?op=list', 3, \_NOPERM);
        }
        if ($dirId > 0) {
            $directoryObj = $directoryHandler->get($dirId);
        } else {
            $directoryObj = $directoryHandler->create();
        } $dirParentId    = Request::getInt('parent_id');
        $dirParentIdOld = Request::getInt('parent_id_old');
        $dirName        = Request::getString('name');
        $dirNameOld    = Request::getString('name_old');
        $dirDescription = Request::getText('description');
        $moveDir        = false;
        $renameDir      = false;
        if ($dirId > 0) {
            $moveDir   = $dirParentId !== $dirParentIdOld;
            $renameDir = $dirName !== $dirNameOld;
        }
        // get full path
        $dirBasePath = DS;
        if ($dirParentId > 0) {
            $dirBasePath .= $directoryHandler->getFullPath($dirParentId);
            $dirBasePath .= DS;
        }
        $dirFullPath = $dirBasePath . mb_strtolower($dirName);
        if ($moveDir) {
            $dirBasePathOld = DS;
            if ($dirParentIdOld > 0) {
                $dirBasePathOld .= $directoryHandler->getFullPath($dirParentIdOld);
                $dirBasePathOld .= DS;
            }
            $dirFullPathOld = $dirBasePathOld . mb_strtolower($dirNameOld);
        }
        //check whether directory exist
        $dirExists = $directoryHandler->existDirectory($dirFullPath);
        //if new or move dir or rename dir then check that folder doesn't exist
        if ((0 === $dirId || $moveDir || $renameDir) && $dirExists) {
            $templateMain = 'wgfilemanager_admin_directory.tpl';
            $directoryObj->setVar('parent_id', $dirParentId);
            $directoryObj->setVar('name', $dirName);
            $directoryObj->setVar('description', $dirDescription);
            $form = $directoryObj->getForm();
            $GLOBALS['xoopsTpl']->assign('form', $form->render());
            $GLOBALS['xoopsTpl']->assign('error', \_MA_WGFILEMANAGER_DIRECTORY_ERROR_EXISTS);
        } else {
// Set Vars
            $directoryObj->setVar('parent_id', $dirParentId);
            $directoryObj->setVar('name', $dirName);
            $directoryObj->setVar('description', $dirDescription);
            $directoryObj->setVar('fullpath', $dirFullPath);
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
                \redirect_header('directory.php?op=list&amp;start=' . $start . '&amp;limit=' . $limit, 2, \_AM_WGFILEMANAGER_FORM_OK);
            }
            $GLOBALS['xoopsTpl']->assign('error', $directoryObj->getHtmlErrors());
        }
        // Get Form Error
        $GLOBALS['xoopsTpl']->assign('error', $directoryObj->getHtmlErrors());
        $form = $directoryObj->getForm();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'new':
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_WGFILEMANAGER_DIRECTORY_ADD];
        // Check permissions
        if (!$permissionsHandler->getPermGlobalSubmit()) {
            \redirect_header('directory.php?op=list', 3, \_NOPERM);
        }
        // Form Create
        $directoryObj = $directoryHandler->create();
        $form = $directoryObj->getForm();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'edit':
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_WGFILEMANAGER_DIRECTORY_EDIT];
        // Check permissions
        if (!$permissionsHandler->getPermGlobalSubmit()) {
            \redirect_header('directory.php?op=list', 3, \_NOPERM);
        }
        // Check params
        if (0 == $dirId) {
            \redirect_header('directory.php?op=list', 3, \_MA_WGFILEMANAGER_INVALID_PARAM);
        }
        // Get Form
        $directoryObj = $directoryHandler->get($dirId);
        $directoryObj->start = $start;
        $directoryObj->limit = $limit;
        $form = $directoryObj->getForm();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'clone':
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_WGFILEMANAGER_DIRECTORY_CLONE];
        // Check permissions
        if (!$permissionsHandler->getPermGlobalSubmit()) {
            \redirect_header('directory.php?op=list', 3, \_NOPERM);
        }
        // Request source
        $dirIdSource = Request::getInt('id_source');
        // Check params
        if (0 == $dirIdSource) {
            \redirect_header('directory.php?op=list', 3, \_MA_WGFILEMANAGER_INVALID_PARAM);
        }
        // Get Form
        $directoryObjSource = $directoryHandler->get($dirIdSource);
        $directoryObj = $directoryObjSource->xoopsClone();
        $form = $directoryObj->getForm();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'delete':
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_WGFILEMANAGER_DIRECTORY_DELETE];
        // Check permissions
        if (!$permissionsHandler->getPermGlobalSubmit()) {
            \redirect_header('directory.php?op=list', 3, \_NOPERM);
        }
        // Check params
        if (0 == $dirId) {
            \redirect_header('directory.php?op=list', 3, \_MA_WGFILEMANAGER_INVALID_PARAM);
        }
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

// Keywords
wgfilemanagerMetaKeywords($helper->getConfig('keywords') . ', ' . \implode(',', $keywords));
unset($keywords);

// Description
wgfilemanagerMetaDescription(\_MA_WGFILEMANAGER_DIRECTORY_DESC);
$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', \WGFILEMANAGER_URL.'/directory.php');
$GLOBALS['xoopsTpl']->assign('wgfilemanager_upload_url', \WGFILEMANAGER_UPLOAD_URL);

require __DIR__ . '/footer.php';
