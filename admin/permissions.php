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

$op         = Request::getCmd('op', 'global');
$permFolder = 'folder' === $helper->getConfig('permission_type');
// Get Form
require_once \XOOPS_ROOT_PATH . '/class/xoopsform/grouppermform.php';
\xoops_load('XoopsFormLoader');
$permTableForm = new \XoopsSimpleForm('', 'fselperm', 'permissions.php', 'post');
$formSelect = new \XoopsFormSelect('', 'op', $op);
$formSelect->setExtra('onchange="document.fselperm.submit()"');
$formSelect->addOption('global', \_MA_WGFILEMANAGER_PERMISSIONS_GLOBAL);
if ($permFolder) {
    $formSelect->addOption('approve_directory', \_MA_WGFILEMANAGER_PERMISSIONS_APPROVE . ' Directory');
    $formSelect->addOption('submit_directory', \_MA_WGFILEMANAGER_PERMISSIONS_SUBMIT . ' Directory');
    $formSelect->addOption('view_directory', \_MA_WGFILEMANAGER_PERMISSIONS_VIEW . ' Directory');
}
$permTableForm->addElement($formSelect);
$permTableForm->display();
switch ($op) {
    case 'global':
    default:
        $formTitle = \_MA_WGFILEMANAGER_PERMISSIONS_GLOBAL;
        $permName = 'wgfilemanager_ac';
        $permDesc = \_MA_WGFILEMANAGER_PERMISSIONS_GLOBAL_DESC;
        $globalPerms = ['4' => \_MA_WGFILEMANAGER_PERMISSIONS_GLOBAL_4, '8' => \_MA_WGFILEMANAGER_PERMISSIONS_GLOBAL_8, '16' => \_MA_WGFILEMANAGER_PERMISSIONS_GLOBAL_16 ];
        break;
    case 'approve_directory':
        $formTitle = \_MA_WGFILEMANAGER_PERMISSIONS_APPROVE;
        $permName = 'wgfilemanager_approve_directory';
        $permDesc = \_MA_WGFILEMANAGER_PERMISSIONS_APPROVE_DESC . ' Directory';
        $handler = $helper->getHandler('directory');
        break;
    case 'submit_directory':
        $formTitle = \_MA_WGFILEMANAGER_PERMISSIONS_SUBMIT;
        $permName = 'wgfilemanager_submit_directory';
        $permDesc = \_MA_WGFILEMANAGER_PERMISSIONS_SUBMIT_DESC . ' Directory';
        $handler = $helper->getHandler('directory');
        break;
    case 'view_directory':
        $formTitle = \_MA_WGFILEMANAGER_PERMISSIONS_VIEW;
        $permName = 'wgfilemanager_view_directory';
        $permDesc = \_MA_WGFILEMANAGER_PERMISSIONS_VIEW_DESC . ' Directory';
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
if ('approve_directory' === $op || 'submit_directory' === $op || 'view_directory' === $op) {
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
