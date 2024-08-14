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
if (!\defined('XOOPS_ICONS32_PATH')) {
    \define('XOOPS_ICONS32_PATH', \XOOPS_ROOT_PATH . '/Frameworks/moduleclasses/icons/32');
}
if (!\defined('XOOPS_ICONS32_URL')) {
    \define('XOOPS_ICONS32_URL', \XOOPS_URL . '/Frameworks/moduleclasses/icons/32');
}
\define('WGFILEMANAGER_DIRNAME', 'wgfilemanager');
\define('WGFILEMANAGER_PATH', \XOOPS_ROOT_PATH . '/modules/' . \WGFILEMANAGER_DIRNAME);
\define('WGFILEMANAGER_URL', \XOOPS_URL . '/modules/' . \WGFILEMANAGER_DIRNAME);
\define('WGFILEMANAGER_ICONS_PATH', \WGFILEMANAGER_PATH . '/assets/icons');
\define('WGFILEMANAGER_ICONS_URL', \WGFILEMANAGER_URL . '/assets/icons');
\define('WGFILEMANAGER_IMAGE_PATH', \WGFILEMANAGER_PATH . '/assets/images');
\define('WGFILEMANAGER_IMAGE_URL', \WGFILEMANAGER_URL . '/assets/images');
\define('WGFILEMANAGER_UPLOAD_PATH', \XOOPS_UPLOAD_PATH . '/' . \WGFILEMANAGER_DIRNAME);
\define('WGFILEMANAGER_UPLOAD_URL', \XOOPS_UPLOAD_URL . '/' . \WGFILEMANAGER_DIRNAME);
\define('WGFILEMANAGER_REPO_PATH', \WGFILEMANAGER_UPLOAD_PATH . '/repository');
\define('WGFILEMANAGER_REPO_URL', \WGFILEMANAGER_UPLOAD_URL . '/repository');
\define('WGFILEMANAGER_ADMIN', \WGFILEMANAGER_URL . '/admin/index.php');
$localLogo = \WGFILEMANAGER_IMAGE_URL . '/wedega_logo.png';
// Module Information
$copyright = "<a href='https://xoops.wedega.com' title='XOOPS Project on Wedega' target='_blank'><img src='" . $localLogo . "' alt='XOOPS Project on Wedega' ></a>";
require_once \XOOPS_ROOT_PATH . '/class/xoopsrequest.php';
require_once \WGFILEMANAGER_PATH . '/include/functions.php';
