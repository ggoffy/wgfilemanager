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

/**
 * Interface  Constants
 */
interface Constants
{
    // Constants for tables
    /*
    public const TABLE_DIRECTORY = 0;
    public const TABLE_FILE      = 1;
    public const TABLE_MIMETYPE  = 2;
    */

    // Constants for status
    public const STATUS_NONE      = 0;
    //public const STATUS_OFFLINE   = 1;
    public const STATUS_SUBMITTED = 2;
    public const STATUS_APPROVED  = 3;
    public const STATUS_BROKEN    = 4;

    // Constants for permissions
    public const PERM_GLOBAL_VIEW            = 1;
    public const PERM_GLOBAL_SUBMIT          = 2;
    //public const PERM_GLOBAL_APPROVE       = 3;
    public const PERM_GLOBAL_DOWNLOAD        = 4;
    //public const PERM_GLOBAL_UPLOAD        = 5;
    public const PERM_DIRECTORY_VIEW         = 6;
    public const PERM_DIRECTORY_SUBMIT       = 7;
    //public const PERM_DIRECTORY_APPROVE    = 8;
    public const PERM_FILE_DOWNLOAD_FROM_DIR = 9;
    public const PERM_FILE_UPLOAD_TO_DIR     = 10;

    // Constants for file name handling
    public const FILE_HANDLENAME_ORIGINAL = 1;
    public const FILE_HANDLENAME_UNIQUE   = 2;

    // Constants for mime type category
    public const MIMETYPE_CAT_NONE  = 0;
    public const MIMETYPE_CAT_IMAGE = 1;
    public const MIMETYPE_CAT_PDF   = 2;

    // Constants for cookies
    public const COOKIE_STYLE_DEFAULT = 'DEFAULT';
    public const COOKIE_STYLE_GROUPED = 'GROUPED';
    public const COOKIE_STYLE_CARD    = 'CARD';
    public const COOKIE_STYLE_CARDBIG = 'CARDBIG';

    public const COOKIE_NOPREVIEW = 0;
    public const COOKIE_PREVIEW   = 1;
}
