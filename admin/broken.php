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

// Define Stylesheet
$GLOBALS['xoTheme']->addStylesheet($style, null);
$templateMain = 'wgfilemanager_admin_broken.tpl';
$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('broken.php'));

// Check table file
$start = Request::getInt('startFile');
$limit = Request::getInt('limitFile', $helper->getConfig('adminpager'));
$crFile = new \CriteriaCompo();
$crFile->add(new \Criteria('status', Constants::STATUS_BROKEN));
$fileCount = $fileHandler->getCount($crFile);
$GLOBALS['xoopsTpl']->assign('file_count', $fileCount);
$GLOBALS['xoopsTpl']->assign('file_result', \sprintf(\_AM_WGFILEMANAGER_BROKEN_RESULT, 'File'));
$crFile->setStart($start);
$crFile->setLimit($limit);
if ($fileCount > 0) {
    $fileAll = $fileHandler->getAll($crFile);
    foreach (\array_keys($fileAll) as $i) {
        $file['table'] = 'File';
        $file['key'] = 'id';
        $file['keyval'] = $fileAll[$i]->getVar('id');
        $file['main'] = $fileAll[$i]->getVar('directory_id');
        $GLOBALS['xoopsTpl']->append('file_list', $file);
    }
    // Display Navigation
    if ($fileCount > $limit) {
        require_once \XOOPS_ROOT_PATH . '/class/pagenav.php';
        $pagenav = new \XoopsPageNav($fileCount, $limit, $start, 'startFile', 'op=list&limitFile=' . $limit);
        $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav());
    }
} else {
    $GLOBALS['xoopsTpl']->assign('nodataFile', \sprintf(\_AM_WGFILEMANAGER_BROKEN_NODATA, 'File'));
}
unset($crFile);

require __DIR__ . '/footer.php';
