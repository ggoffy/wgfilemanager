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
// Get all request values
$op    = Request::getCmd('op', 'list');
$dirId = Request::getInt('dir_id');
$start = Request::getInt('start');
$limit = Request::getInt('limit', $helper->getConfig('userpager'));

$GLOBALS['xoopsOption']['template_main'] = 'wgfilemanager_index.tpl';
require_once \XOOPS_ROOT_PATH . '/header.php';
// Define Stylesheet
$GLOBALS['xoTheme']->addStylesheet($style, null);
$GLOBALS['xoTheme']->addStylesheet(\WGFILEMANAGER_URL . '/assets/css/default.css');
// Paths
$GLOBALS['xoopsTpl']->assign('wgfilemanager_icon_bi_url', \WGFILEMANAGER_ICONS_URL . '/bootstrap/');
//preferences
echo 'table_type:'.$helper->getConfig('table_type');
echo 'panel_type:'.$helper->getConfig('panel_type');
$GLOBALS['xoopsTpl']->assign('table_type', $helper->getConfig('table_type'));
$GLOBALS['xoopsTpl']->assign('panel_type', $helper->getConfig('panel_type'));
// Keywords
$keywords = [];
//get param list
$params = '&amp;dir_id=' . $dirId;
$params .= '&amp;start=' . $start;
$params .= '&amp;limit=' . $limit;
$GLOBALS['xoopsTpl']->assign('params', $params);

$cookieName = $GLOBALS['xoopsConfig']['usercookie'] . '_wgf_indexstyle';

switch ($op) {
    case 'list':
    default:
    // handle cookies
    $cookieIndexstyle = Request::getString($cookieName, 'none', 'COOKIE');
    if ('none' === $cookieIndexstyle) {
        $cookieIndexstyle = Constants::COOKIE_STYLE_DEFAULT;
        xoops_setcookie($cookieName, $cookieIndexstyle, time() + 60 * 60 * 24 * 30);
    } else {
        $cookieIndexstyle = $_COOKIE[$cookieName];
    }
    $GLOBALS['xoopsTpl']->assign('wgfindexstyle', $cookieIndexstyle);
    $GLOBALS['xoopsTpl']->assign('styledefault', Constants::COOKIE_STYLE_DEFAULT);
    $GLOBALS['xoopsTpl']->assign('stylegrouped', Constants::COOKIE_STYLE_GROUPED);
    $GLOBALS['xoopsTpl']->assign('stylecard', Constants::COOKIE_STYLE_CARD);

    // Breadcrumbs
    if ($dirId > 0) {
        $xoBreadcrumbs[] = ['title' => \_MA_WGFILEMANAGER_INDEX, 'link' => 'index.php'];
        $dirArray = $directoryHandler->getDirListBreadcrumb($dirId);
        $dirListBreadcrumb = array_reverse($dirArray, true);
        foreach ($dirListBreadcrumb as $key => $value) {
            if ($key == array_key_last($dirListBreadcrumb)) {
                $xoBreadcrumbs[] = ['title' => $value];
            } else {
                $xoBreadcrumbs[] = ['title' => $value, 'link' => 'index.php?dir_id=' . $key];
            }
        }
    } else {
        $xoBreadcrumbs[] = ['title' => \_MA_WGFILEMANAGER_INDEX];
    }

    // Paths
    $GLOBALS['xoopsTpl']->assign('xoops_icons32_url', \XOOPS_ICONS32_URL);
    $GLOBALS['xoopsTpl']->assign('wgfilemanager_url', \WGFILEMANAGER_URL);

    //get permissions
    $GLOBALS['xoopsTpl']->assign('permEdit', $permissionsHandler->getPermSubmit());
    $GLOBALS['xoopsTpl']->assign('permDownload', $permissionsHandler->getPermDownload());
    $GLOBALS['xoopsTpl']->assign('permUpload', $permissionsHandler->getPermUpload());

    $dirList = $directoryHandler->getDirList(0, $dirId);
    $GLOBALS['xoopsTpl']->assign('dir_list', $dirList);
    $GLOBALS['xoopsTpl']->assign('dirId', $dirId);

    $crFile = new \CriteriaCompo();
    $crFile->add(new \Criteria('directory_id', $dirId));
    $fileCount = $fileHandler->getCount($crFile);

    $fileList = [];
    $crFile->setStart($start);
    $crFile->setLimit($limit);
    $crFile->setSort('name');
    $crFile->setOrder('ASC');
    if ($fileCount > 0) {
        $fileAll = $fileHandler->getAll($crFile);
        foreach (\array_keys($fileAll) as $i) {
            $fileList[$i] = $fileAll[$i]->getValuesFile();
        }
    }
    $GLOBALS['xoopsTpl']->assign('file_list', $fileList);
    // Display Navigation
    if ($fileCount > $limit) {
        require_once \XOOPS_ROOT_PATH . '/class/pagenav.php';
        $pagenav = new \XoopsPageNav($fileCount, $limit, $start, 'start', 'op=list&amp;limit=' . $limit . '&amp;dir_id=' . $dirId);
        $GLOBALS['xoopsTpl']->assign('pagenavFile', $pagenav->renderNav());
    }
    break;

    case 'setstyle':
        // set cookies and reload
        $styleType = Request::getString('style');
        xoops_setcookie($cookieName, $styleType, time() + 60 * 60 * 24 * 30);

        \redirect_header('index.php?op=list' . $params, 0 , '');
        break;
}

// Keywords
wgfilemanagerMetaKeywords($helper->getConfig('keywords') . ', ' . \implode(',', $keywords));
unset($keywords);
// Description
wgfilemanagerMetaDescription($helper->getConfig('metadescription'));
$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', \WGFILEMANAGER_URL.'/index.php');
$GLOBALS['xoopsTpl']->assign('xoops_icons32_url', \XOOPS_ICONS32_URL);
$GLOBALS['xoopsTpl']->assign('wgfilemanager_upload_url', \WGFILEMANAGER_UPLOAD_URL);
require __DIR__ . '/footer.php';
