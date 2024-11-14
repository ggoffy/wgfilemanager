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

if ($helper->getConfig('show_breadcrumbs') && \count($xoBreadcrumbs) > 0) {
    $GLOBALS['xoopsTpl']->assign('xoBreadcrumbs', $xoBreadcrumbs);
}

// Description
wgfilemanagerMetaDescription((string)$helper->getConfig('metadescription'));
// 
$GLOBALS['xoopsTpl']->assign('admin', \WGFILEMANAGER_ADMIN);

if ($helper->getConfig('show_copyright')) {
    $GLOBALS['xoopsTpl']->assign('copyright', $copyright);
}
// 
require_once \XOOPS_ROOT_PATH . '/footer.php';
