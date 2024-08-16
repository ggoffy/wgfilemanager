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

$op     = Request::getString('op', 'list');
$fileId = Request::getInt('file_id');

// get download vars
$fileObj = $fileHandler->get($fileId);
// check permissions
$permDownload = $permissionsHandler->getPermDownloadFileFromDir($fileObj->getVar('directory_id'));
if (!$permDownload) {
    \redirect_header('index.php?op=list', 3, \_MA_WGFILEMANAGER_NO_PERM_DOWNLOAD);
}
$fileName = $fileObj->getVar('name');
$fileMimetype = $fileObj->getVar('mimetype');
$fileSize = $fileObj->getVar('size');
$dirObj = $directoryHandler->get($fileObj->getVar('directory_id'));
$file = \WGFILEMANAGER_REPO_PATH . $dirObj->getVar('fullpath') . '/' . $fileName;
if (!\file_exists($file)) {
    \redirect_header('index.php?op=list', 3, \_MA_WGFILEMANAGER_FILE_ERROR_DONOTEXIST);
}

$fp = fopen($file, 'rb');
header('Content-type: ' . $fileMimetype);
header('Content-Length: ' . $fileSize);
header('Content-Disposition: attachment; filename=' . $fileName);
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
fpassthru($fp);



