<?php

declare(strict_types=1);


namespace XoopsModules\Wgfilemanager;

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

use XoopsModules\Wgfilemanager;
use XoopsModule;

\defined('XOOPS_ROOT_PATH') || die('Restricted access');

/**
 * Class Object PermissionsHandler
 */
class PermissionsHandler extends \XoopsPersistableObjectHandler
{
    /**
     * Constructor
     *
     */
    public function __construct()
    {
    }


    /******************************************
     * Global permissions
    /*******************************************/


    /**
     * @private function getPermGlobal
     * returns right for given perm
     * @param $constantPerm
     * @return bool
     */
    private function getPermGlobal($constantPerm)
    {
        global $xoopsUser;

        $moduleDirName = \basename(\dirname(__DIR__));
        $mid = XoopsModule::getByDirname($moduleDirName)->mid();
        $currentuid = 0;
        if (isset($xoopsUser) && \is_object($xoopsUser)) {
            if ($xoopsUser->isAdmin($mid)) {
                return true;
            }
            $currentuid = $xoopsUser->uid();
        }
        $grouppermHandler = \xoops_getHandler('groupperm');

        $memberHandler = \xoops_getHandler('member');
        if (0 === $currentuid) {
            $my_group_ids = [\XOOPS_GROUP_ANONYMOUS];
        } else {
            $my_group_ids = $memberHandler->getGroupsByUser($currentuid);
        }
        switch ($constantPerm) {
            //case Constants::PERM_GLOBAL_APPROVE:
            case Constants::PERM_GLOBAL_SUBMIT:
            case Constants::PERM_GLOBAL_VIEW:
            case Constants::PERM_GLOBAL_DOWNLOAD:
            //case Constants::PERM_GLOBAL_UPLOAD:
                $permName = 'wgfilemanager_global';
                break;
            case 0:
            default:
                $permName = '';
                break;
        }
        return $grouppermHandler->checkRight($permName, $constantPerm, $my_group_ids, $mid);

    }

    /**
     * @public function permGlobalApprove
     * returns right for global approve
     *
     * @return bool
     */
    /*public function getPermGlobalApprove()
    {
        return $this->getPermGlobal(Constants::PERM_GLOBAL_APPROVE);
    }*/

    /**
     * @public function permGlobalSubmit
     * returns right for global submit
     *
     * @return bool
     */
    public function getPermGlobalSubmit()
    {
        return $this->getPermGlobal(Constants::PERM_GLOBAL_SUBMIT);
    }

    /**
     * @public function permGlobalView
     * returns right for global view
     *
     * @return bool
     */
    public function getPermGlobalView()
    {
        return $this->getPermGlobal(Constants::PERM_GLOBAL_VIEW);
    }

    /**
     * @public function getPermGlobalDownload
     * returns right for global download
     *
     * @return bool
     */
    public function getPermGlobalDownload()
    {
        return $this->getPermGlobal(Constants::PERM_GLOBAL_DOWNLOAD);
    }



    /******************************************
     * Permissions for directories
    /*******************************************/

    /**
     * @private function getPermGlobal
     * returns right for given perm
     * @param $constantPerm
     * @return bool
     */
    private function getPermDirectory($constantPerm, $dirId)
    {
        global $xoopsUser;

        $moduleDirName = \basename(\dirname(__DIR__));
        $mid = XoopsModule::getByDirname($moduleDirName)->mid();
        $currentuid = 0;
        if (isset($xoopsUser) && \is_object($xoopsUser)) {
            if ($xoopsUser->isAdmin($mid)) {
                return true;
            }
            $currentuid = $xoopsUser->uid();
        }
        $grouppermHandler = \xoops_getHandler('groupperm');

        $memberHandler = \xoops_getHandler('member');
        if (0 === $currentuid) {
            $my_group_ids = [\XOOPS_GROUP_ANONYMOUS];
        } else {
            $my_group_ids = $memberHandler->getGroupsByUser($currentuid);
        }
        switch ($constantPerm) {
            //case Constants::PERM_DIRECTORY_APPROVE:
            case Constants::PERM_DIRECTORY_SUBMIT:
                $permName = 'wgfilemanager_submit_directory';
                break;
            case Constants::PERM_DIRECTORY_VIEW:
                $permName = 'wgfilemanager_view_directory';
                break;
            case Constants::PERM_FILE_DOWNLOAD_FROM_DIR:
                $permName = 'wgfilemanager_download_directory';
                break;
            case Constants::PERM_FILE_UPLOAD_TO_DIR:
                $permName = 'wgfilemanager_upload_directory';
                break;
            case 0:
            default:
                $permName = '';
                break;
        }

        return $grouppermHandler->checkRight($permName, $dirId, $my_group_ids, $mid);

    }
    /**
     * @public function getPermApproveDirectory
     * returns right for approve directory
     *
     * param int $dirId
     * @return bool
     */
    /*public function getPermApproveDirectory($dirId)
    {

        if ($this->getPermGlobalApprove()) {
            return true;
        }
        return $this->getPermDirectory(Constants::PERM_DIRECTORY_APPROVE, $dirId);

    }*/

    /**
     * @public function getPermSubmitDirectory
     * returns right for creating/editing directory
     *
     * param int $dirId
     * @return bool
     */
    public function getPermSubmitDirectory($dirId)
    {

        if ($this->getPermGlobalSubmit()) {
            return true;
        }
        return $this->getPermDirectory(Constants::PERM_DIRECTORY_SUBMIT, $dirId);

    }

    /**
     * @public function getPermViewDirectory
     * returns right for view directory
     *
     * param int $dirId
     * @return bool
     */
    public function getPermViewDirectory($dirId)
    {

        if ($this->getPermGlobalView()) {
            return true;
        }
        return $this->getPermDirectory(Constants::PERM_DIRECTORY_VIEW, $dirId);

    }

    /******************************************
     * Permissions for files
    /*******************************************/

    /**
     * @public function getPermDownloadDirectory
     * returns right for downloading files from directory
     *
     * param int $dirId
     * @return bool
     */
    public function getPermDownloadFileFromDir($dirId)
    {
        if ($this->getPermGlobalDownload()) {
            return true;
        }
        return $this->getPermDirectory(Constants::PERM_FILE_DOWNLOAD_FROM_DIR, $dirId);

    }

    /**
     * @public function getPermUploadDirectory
     * returns right for uploading file to directory
     *
     * param int $dirId
     * @return bool
     */
    public function getPermUploadFileToDir($dirId)
    {
        if ($this->getPermGlobalSubmit()) {
            return true;
        }
        return $this->getPermDirectory(Constants::PERM_FILE_UPLOAD_TO_DIR, $dirId);

    }

}
