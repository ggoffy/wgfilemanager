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

require __DIR__ . '/header.php';

// Template Index
$templateMain = 'wgfilemanager_admin_permissions.tpl';
$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('permissions.php'));

$op      = Request::getCmd('op', 'global');
$permDir = 'directory' === $helper->getConfig('permission_type');
// Get Form
require_once \XOOPS_ROOT_PATH . '/class/xoopsform/grouppermform.php';
\xoops_load('XoopsFormLoader');
$permTableForm = new \XoopsSimpleForm('', 'fselperm', 'permissions.php', 'post');
$formSelect = new \XoopsFormSelect('', 'op', $op);
$formSelect->setExtra('onchange="document.fselperm.submit()"');
$formSelect->addOption('global', \_MA_WGFILEMANAGER_PERM_GLOBAL);
if ($permDir) {
    //$formSelect->addOption('approve_directory', \_MA_WGFILEMANAGER_PERM_APPROVE . ' ' . _MA_WGFILEMANAGER_DIRECTORY);
    $formSelect->addOption('submit_directory', \_MA_WGFILEMANAGER_PERM_DIR_SUBMIT);
    $formSelect->addOption('view_directory', \_MA_WGFILEMANAGER_PERM_DIR_VIEW);
    $formSelect->addOption('upload_directory', \_MA_WGFILEMANAGER_PERM_FILE_UPLOAD_TO_DIR);
    $formSelect->addOption('download_directory', \_MA_WGFILEMANAGER_PERM_FILE_DOWNLOAD_FROM_DIR);
}
$permTableForm->addElement($formSelect);
$permTableForm->display();
switch ($op) {
    case 'global':
    default:
        $formTitle = \_MA_WGFILEMANAGER_PERM_GLOBAL;
        $permName = 'wgfilemanager_global';
        $permDesc = \_MA_WGFILEMANAGER_PERM_GLOBAL_DESC;
        $globalPerms = [Constants::PERM_GLOBAL_SUBMIT => \_MA_WGFILEMANAGER_PERM_GLOBAL_SUBMIT,
                        Constants::PERM_GLOBAL_VIEW => \_MA_WGFILEMANAGER_PERM_GLOBAL_VIEW,
                        Constants::PERM_GLOBAL_DOWNLOAD => \_MA_WGFILEMANAGER_PERM_GLOBAL_DOWNLOAD];
        break;
    /*case 'approve_directory':
        $formTitle = \_MA_WGFILEMANAGER_PERM_APPROVE;
        $permName = 'wgfilemanager_approve_directory';
        $permDesc = \_MA_WGFILEMANAGER_PERM_APPROVE_DESC . ' ' . _MA_WGFILEMANAGER_DIRECTORY;
        $handler = $helper->getHandler('directory');
        break;*/
    case 'submit_directory':
        $formTitle = \_MA_WGFILEMANAGER_PERM_DIR_SUBMIT;
        $permName = 'wgfilemanager_submit_directory';
        $permDesc = \_MA_WGFILEMANAGER_PERM_DIR_SUBMIT_DESC;
        $handler = $helper->getHandler('directory');
        break;
    case 'view_directory':
        $formTitle = \_MA_WGFILEMANAGER_PERM_DIR_VIEW;
        $permName = 'wgfilemanager_view_directory';
        $permDesc = \_MA_WGFILEMANAGER_PERM_DIR_VIEW_DESC;
        $handler = $helper->getHandler('directory');
        break;
    case 'upload_directory':
        $formTitle = \_MA_WGFILEMANAGER_PERM_FILE_UPLOAD_TO_DIR;
        $permName = 'wgfilemanager_upload_directory';
        $permDesc = \_MA_WGFILEMANAGER_PERM_FILE_UPLOAD_TO_DIR_DESC;
        $handler = $helper->getHandler('directory');
        break;
    case 'download_directory':
        $formTitle = \_MA_WGFILEMANAGER_PERM_FILE_DOWNLOAD_FROM_DIR;
        $permName = 'wgfilemanager_download_directory';
        $permDesc = \_MA_WGFILEMANAGER_PERM_FILE_DOWNLOAD_FROM_DIR_DESC;
        $handler = $helper->getHandler('directory');
        break;
}
$moduleId = $xoopsModule->getVar('mid');
$permform = new \XoopsGroupPermForm($formTitle, $moduleId, $permName, $permDesc, 'admin/permissions.php');
$permFound = false;
if ($op === 'global') {
    foreach ($globalPerms as $gPermId => $gPermName) {
        $permform->addItem($gPermId, $gPermName);
    }
    $GLOBALS['xoopsTpl']->assign('form', $permform->render());
    $permFound = true;
}
if ('approve_directory' === $op || 'submit_directory' === $op || 'view_directory' === $op || 'upload_directory' === $op || 'download_directory' === $op) {
    $directoryCount = $directoryHandler->getCountDirectory();
    if ($directoryCount > 0) {
        $directoryAll = $directoryHandler->getAllDirectory(0, 'name');
        foreach (\array_keys($directoryAll) as $i) {
            $permform->addItem($directoryAll[$i]->getVar('id'), $directoryAll[$i]->getVar('name'));
        }
        $GLOBALS['xoopsTpl']->assign('form', $permform->render());
    }
    $permFound = true;
}
unset($permform);
if (true !== $permFound) {
    \redirect_header('permissions.php', 3, \_MA_WGFILEMANAGER_NO_PERMISSIONS_SET);
    exit();
}

require __DIR__ . '/footer.php';
