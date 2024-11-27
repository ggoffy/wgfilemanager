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
 * @since        1.0
 * @min_xoops    2.5.9
 * @author       Goffy - Wedega - Email:webmaster@wedega.com - Website:https://xoops.wedega.com
 */

use Xmf\Request;
use XoopsModules\Wgfilemanager;
//use XoopsModules\Wgfilemanager\Constants;
use XoopsModules\Wgfilemanager\Common;
use Xmf\Database\TableLoad;
use Xmf\Yaml;

require __DIR__ . '/header.php';
// Get all request values
$op     = Request::getCmd('op', 'list');
$mimeId = Request::getInt('id');
$start  = Request::getInt('start');
$limit  = Request::getInt('limit', $helper->getConfig('adminpager'));
$GLOBALS['xoopsTpl']->assign('start', $start);
$GLOBALS['xoopsTpl']->assign('limit', $limit);

switch ($op) {
    case 'list':
    default:
        // Define Stylesheet
        $GLOBALS['xoTheme']->addStylesheet($style, null);
        $templateMain = 'wgfilemanager_admin_mimetype.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('mimetype.php'));
        $adminObject->addItemButton(\_AM_WGFILEMANAGER_ADD_MIMETYPE, 'mimetype.php?op=new');
        $adminObject->addItemButton(\_AM_WGFILEMANAGER_LOAD_MIMETYPE, 'mimetype.php?op=load_default');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        $mimetypeCount = $mimetypeHandler->getCountMimetype();
        $mimetypeAll = $mimetypeHandler->getAllMimetype($start, $limit);
        $GLOBALS['xoopsTpl']->assign('mimetype_count', $mimetypeCount);
        $GLOBALS['xoopsTpl']->assign('wgfilemanager_url', \WGFILEMANAGER_URL);
        $GLOBALS['xoopsTpl']->assign('wgfilemanager_upload_url', \WGFILEMANAGER_UPLOAD_URL);
        // Table view mimetype
        if ($mimetypeCount > 0) {
            foreach (\array_keys($mimetypeAll) as $i) {
                $mimetype = $mimetypeAll[$i]->getValuesMimetype();
                $GLOBALS['xoopsTpl']->append('mimetype_list', $mimetype);
                unset($mimetype);
            }
            // Display Navigation
            if ($mimetypeCount > $limit) {
                require_once \XOOPS_ROOT_PATH . '/class/pagenav.php';
                $pagenav = new \XoopsPageNav($mimetypeCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav());
            }
        } else {
            $GLOBALS['xoopsTpl']->assign('error', \_AM_WGFILEMANAGER_THEREARENT_MIMETYPE);
        }
        break;
    case 'new':
        $templateMain = 'wgfilemanager_admin_mimetype.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('mimetype.php'));
        $adminObject->addItemButton(\_AM_WGFILEMANAGER_LIST_MIMETYPE, 'mimetype.php', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Form Create
        $mimetypeObj = $mimetypeHandler->create();
        $form = $mimetypeObj->getFormMimetype();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'clone':
        $templateMain = 'wgfilemanager_admin_mimetype.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('mimetype.php'));
        $adminObject->addItemButton(\_AM_WGFILEMANAGER_LIST_MIMETYPE, 'mimetype.php', 'list');
        $adminObject->addItemButton(\_AM_WGFILEMANAGER_ADD_MIMETYPE, 'mimetype.php?op=new');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Request source
        $mimeIdSource = Request::getInt('id_source');
        // Get Form
        $mimetypeObjSource = $mimetypeHandler->get($mimeIdSource);
        $mimetypeObj = $mimetypeObjSource->xoopsClone();
        $form = $mimetypeObj->getFormMimetype();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'save':
        // Security Check
        if (!$GLOBALS['xoopsSecurity']->check()) {
            \redirect_header('mimetype.php', 3, \implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if ($mimeId > 0) {
            $mimetypeObj = $mimetypeHandler->get($mimeId);
        } else {
            $mimetypeObj = $mimetypeHandler->create();
        }
        // Set Vars
        $mimetypeObj->setVar('extension', Request::getString('extension'));
        $mimetypeObj->setVar('mimetype', Request::getString('mimetype'));
        $mimetypeObj->setVar('desc', Request::getString('desc'));
        $mimetypeObj->setVar('admin', Request::getInt('admin'));
        $mimetypeObj->setVar('user', Request::getInt('user'));
        $mimetypeObj->setVar('class', Request::getInt('class'));
        $mimetypeDate_createdObj = \DateTime::createFromFormat(\_SHORTDATESTRING, Request::getString('date_created'));
        $mimetypeObj->setVar('date_created', $mimetypeDate_createdObj->getTimestamp());
        $mimetypeObj->setVar('submitter', Request::getInt('submitter'));
        // Insert Data
        if ($mimetypeHandler->insert($mimetypeObj)) {
                \redirect_header('mimetype.php?op=list&amp;start=' . $start . '&amp;limit=' . $limit, 2, \_AM_WGFILEMANAGER_FORM_OK);
        }
        // Get Form
        $GLOBALS['xoopsTpl']->assign('error', $mimetypeObj->getHtmlErrors());
        $form = $mimetypeObj->getFormMimetype();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'edit':
        $templateMain = 'wgfilemanager_admin_mimetype.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('mimetype.php'));
        $adminObject->addItemButton(\_AM_WGFILEMANAGER_ADD_MIMETYPE, 'mimetype.php?op=new');
        $adminObject->addItemButton(\_AM_WGFILEMANAGER_LIST_MIMETYPE, 'mimetype.php', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Get Form
        $mimetypeObj = $mimetypeHandler->get($mimeId);
        $mimetypeObj->start = $start;
        $mimetypeObj->limit = $limit;
        $form = $mimetypeObj->getFormMimetype();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'delete':
        $templateMain = 'wgfilemanager_admin_mimetype.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('mimetype.php'));
        $mimetypeObj = $mimetypeHandler->get($mimeId);
        $mimeExtension = $mimetypeObj->getVar('extension');
        if (isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                \redirect_header('mimetype.php', 3, \implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($mimetypeHandler->delete($mimetypeObj)) {
                \redirect_header('mimetype.php', 3, \_AM_WGFILEMANAGER_FORM_DELETE_OK);
            } else {
                $GLOBALS['xoopsTpl']->assign('error', $mimetypeObj->getHtmlErrors());
            }
        } else {
            $customConfirm = new Common\Confirm(
                ['ok' => 1, 'id' => $mimeId, 'start' => $start, 'limit' => $limit, 'op' => 'delete'],
                $_SERVER['REQUEST_URI'],
                \sprintf(\_AM_WGFILEMANAGER_FORM_SURE_DELETE, $mimeExtension));
            $form = $customConfirm->getFormConfirm();
            $GLOBALS['xoopsTpl']->assign('form', $form->render());
        }
        break;
    case 'load_default':
        $templateMain = 'wgfilemanager_admin_mimetype.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('mimetype.php'));
        if (isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                \redirect_header('mimetype.php', 3, \implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($mimetypeHandler->getCountMimetype() > 0 && !$mimetypeHandler->deleteAll()) {
                $GLOBALS['xoopsTpl']->assign('error', $mimetypeHandler->getHtmlErrors());
            }
            $tabledata = Yaml::readWrapped(\WGFILEMANAGER_PATH . '/testdata/english/wgfilemanager_mimetype.yml');
            TableLoad::truncateTable('wgfilemanager_mimetype');
            TableLoad::loadTableFromArray('wgfilemanager_mimetype', $tabledata);
            //\redirect_header('mimetype.php', 3, \_AM_WGFILEMANAGER_LOAD_MIMETYPE_OK);
        } else {
            $customConfirm = new Common\Confirm(
                ['ok' => 1, 'id' => $mimeId, 'start' => $start, 'limit' => $limit, 'op' => 'load_default'],
                $_SERVER['REQUEST_URI'],\_AM_WGFILEMANAGER_MIMETYPE_LOAD_DEFAULT);
            $form = $customConfirm->getFormConfirm();
            $GLOBALS['xoopsTpl']->assign('form', $form->render());
        }
        break;
}

require __DIR__ . '/footer.php';
